<?php
date_default_timezone_set('America/El_Salvador');

$tipoAccion = isset($_GET['tipoAccion']) ? $_GET['tipoAccion'] : '';
$action = isset($_GET['action']) ? $_GET['action'] : '';
$time = isset($_GET['time']) ? $_GET['time'] : '';
$pausasDiarias = isset($_GET['dailyPauses']) ? $_GET['dailyPauses'] : 0;

$entradaLog = '';

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
        break;
    case 'Salida':
        $tiempoRegistrado = date('H:i:s');
        $entradaLog = "Salida: $tiempoRegistrado";
        break;
    case 'Timer1':
        $tiempoInicial = '06:40:00';
        $tiempoDiferencia = calculateTimeDifference($tiempoInicial, $time);
        $entradaLog = "Horas de trabajo cumplidas: $tiempoDiferencia  Tiempo a reponer $time";
        break;
    case 'Timer2':
        $tiempoInicial = '20:00';
        $tiempoDiferencia = calculateTimeDifference($tiempoInicial, $time, true);
        $entradaLog = "Receso cumplido: $tiempoDiferencia  Tiempo adicional $time";
        break;
    case 'LunchTimer':
        $tiempoInicial = '60:00';
        $tiempoDiferencia = calculateTimeDifference($tiempoInicial, $time, true);   
        $entradaLog = "Tiempo de almuerzo: $tiempoDiferencia  Tiempo no cumplido de almuerzo: $time";       
        break;    
    case 'tiempoFinalizacion':
        $entradaLog = "Pausas diarias: $pausasDiarias";
        break;
    default:
        $entradaLog = "Acción no reconocida";
}

echo $entradaLog;
?>