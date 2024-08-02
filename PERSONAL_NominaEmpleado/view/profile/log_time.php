<?php
session_start(); // Inicia la sesión para acceder a las variables de sesión

date_default_timezone_set('America/El_Salvador');

$tipoAccion = isset($_GET['tipoAccion']) ? $_GET['tipoAccion'] : '';
$action = isset($_GET['action']) ? $_GET['action'] : '';
$time = isset($_GET['time']) ? $_GET['time'] : '';
$pausasDiarias = isset($_GET['dailyPauses']) ? $_GET['dailyPauses'] : 0;

$entradaLog = '';
$employeeId = isset($_SESSION['id']) ? $_SESSION['id'] : null; // Obtén el ID del empleado desde la sesión

function calculateTimeDifference($tiempoInicio, $tiempoFinal, $minutoFormato = false) {
    if ($minutoFormato) {
        $inicio = DateTime::createFromFormat('i:s', $tiempoInicio);
        $final = DateTime::createFromFormat('i:s', $tiempoFinal);
    } else {
        $inicio = DateTime::createFromFormat('H:i:s', $tiempoInicio);
        $final = DateTime::createFromFormat('H:i:s', $tiempoFinal);
    }

    if (!$inicio || !$final) {
        return 'Invalid time format';
    }

    $intervalo = $inicio->diff($final);
    return $intervalo->format('%H:%I:%S');
}

switch ($tipoAccion) {
    case 'Entrada':
        $tiempoRegistrado = date('H:i:s');
        $entradaLog = "Entrada: $tiempoRegistrado";

        // Insertar en la API si es entrada
        if ($employeeId) {
            // Guardar el time_entry en una variable de sesión
            $_SESSION['time_entry'] = $tiempoRegistrado;

            $data = [
                'employee_id' => $employeeId,
                'date' => date('Y-m-d'),
                'time_entry' => $tiempoRegistrado
            ];

            $ch = curl_init('http://127.0.0.1:8000/api/assistence');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Accept: application/json'
            ]);

            $response = curl_exec($ch);
            curl_close($ch);

            if ($response === false) {
                $entradaLog .= " - Error al registrar la asistencia.";
            }
        } else {
            $entradaLog .= " - ID de empleado no encontrado.";
        }
        break;
    
    case 'Salida':
        $tiempoRegistrado = date('H:i:s');
        $entradaLog = "Salida: $tiempoRegistrado";

        // Actualizar en la API si es salida
        if ($employeeId) {
            $fechaSistema = date('Y-m-d');
            $url = "http://127.0.0.1:8000/api/assistence/$employeeId/$fechaSistema";

            // Obtener el registro existente
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Accept: application/json'
            ]);

            $response = curl_exec($ch);
            $existingRecord = json_decode($response, true);
            curl_close($ch);

            if ($existingRecord && is_array($existingRecord)) {
                // Utilizar el time_entry de la sesión si existe, de lo contrario, mantener el existente
                $existingRecord['time_entry'] = isset($_SESSION['time_entry']) ? $_SESSION['time_entry'] : $existingRecord['time_entry'];

                // Guardar el time_exit en una variable de sesión
                $_SESSION['time_exit'] = $tiempoRegistrado;
                $existingRecord['time_exit'] = $tiempoRegistrado;

                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($existingRecord));
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    'Content-Type: application/json',
                    'Accept: application/json'
                ]);

                $response = curl_exec($ch);
                curl_close($ch);

                if ($response === false) {
                    $entradaLog .= " - Error al actualizar la salida.";
                }
            } else {
                $entradaLog .= " - Error al obtener el registro de asistencia.";
            }
        } else {
            $entradaLog .= " - ID de empleado no encontrado.";
        }
        break;

    case 'Timer1':
        $tiempoInicial = '06:40:00';
        $tiempoDiferencia = calculateTimeDifference($tiempoInicial, $time);
        $entradaLog = "Horas de trabajo cumplidas: $tiempoDiferencia  Tiempo a reponer: $time";

        // Guardar work_completed y time_to_recover en variables de sesión
        $_SESSION['work_completed'] = $tiempoDiferencia;
        $_SESSION['time_to_recover'] = $time;

        
        break;

    case 'Timer2':
        $tiempoInicial = '20:00';
        $tiempoDiferencia = calculateTimeDifference($tiempoInicial, $time, true);
        $entradaLog = "Receso cumplido: $tiempoDiferencia  Tiempo adicional $time";

        // Guardar break_completed y additional_time en variables de sesión
        $_SESSION['break_completed'] = $tiempoDiferencia;
        $_SESSION['additional_time'] = $time;

        break;

    case 'LunchTimer':
        $tiempoInicial = '60:00';
        $tiempoDiferencia = calculateTimeDifference($tiempoInicial, $time, true);   
        $entradaLog = "Tiempo de almuerzo realizado: $tiempoDiferencia ";

        // Guardar lunch_time en una variable de sesión
        $_SESSION['lunch_time'] = $tiempoDiferencia;

        break;

    case 'tiempoFinalizacion':
        $entradaLog = "Pausas diarias: $pausasDiarias";

        // Guardar daily_pauses en una variable de sesión
        $_SESSION['daily_breaks'] = $pausasDiarias;

        // Actualizar en la API al finalizar
        if ($employeeId) {
            $fechaSistema = date('Y-m-d');
            $url = "http://127.0.0.1:8000/api/assistence/$employeeId/$fechaSistema";

            // Obtener el registro existente
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Accept: application/json'
            ]);

            $response = curl_exec($ch);
            $existingRecord = json_decode($response, true);
            curl_close($ch);

            if ($existingRecord && is_array($existingRecord)) {
                // Mantener los datos de time_entry y time_exit sin cambios
                $existingRecord['time_entry'] = isset($_SESSION['time_entry']) ? $_SESSION['time_entry'] : $existingRecord['time_entry'];
                $existingRecord['time_exit'] = isset($_SESSION['time_exit']) ? $_SESSION['time_exit'] : $existingRecord['time_exit'];

                // Actualizar solo los campos de work_completed, time_to_recover, etc.
                $existingRecord['work_completed'] = $_SESSION['work_completed'];
                $existingRecord['time_to_recover'] = $_SESSION['time_to_recover'];
                $existingRecord['break_completed'] = $_SESSION['break_completed'];
                $existingRecord['additional_time'] = $_SESSION['additional_time'];
                $existingRecord['lunch_time'] = $_SESSION['lunch_time'];
                $existingRecord['dealy_breaks'] = $_SESSION['daily_breaks'];

                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($existingRecord));
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    'Content-Type: application/json',
                    'Accept: application/json'
                ]);

                $response = curl_exec($ch);
                curl_close($ch);

                if ($response === false) {
                    $entradaLog .= " - Error al actualizar los datos al finalizar.";
                }
            } else {
                $entradaLog .= " - Error al obtener el registro de asistencia.";
            }
        } else {
            $entradaLog .= " - ID de empleado no encontrado.";
        }
        break;

    default:
        $entradaLog = "Acción no reconocida";
}

echo $entradaLog;
?>
