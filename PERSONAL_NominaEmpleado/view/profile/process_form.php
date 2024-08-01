<?php
session_start();
$employee_id_session = $_SESSION['id']; // ID de empleado desde la sesión
$date = $_POST['date']; // Fecha ingresada en el formulario

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_id = $_POST["employee_id"];
    $data = [
        "time_entry" => $_POST["time_entry"],
        "time_exit" => $_POST["time_exit"],
        "work_completed" => $_POST["work_completed"],
        "time_to_recover" => $_POST["time_to_recover"],
        "break_completed" => $_POST["break_completed"],
        "additional_time" => $_POST["additional_time"],
        "dealy_breaks" => $_POST["dealy_breaks"],
        "lunch_time" => $_POST["lunch_time"],
        "remaining_lunch_hour" => $_POST["remaining_lunch_hour"]
    ];

    $action = $_POST['action']; // Obtener la acción del botón presionado

    $ch = curl_init();

    if ($action === 'update') {
         // Verificar si el registro con el ID de empleado y la fecha ya existe
         $url_check = "http://127.0.0.1:8000/api/assistence/{$employee_id_session}/{$date}";
         curl_setopt($ch, CURLOPT_URL, $url_check);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
         $response_check = curl_exec($ch);
 
         if ($response_check === FALSE) {
             die('Error occurred while checking existence: ' . curl_error($ch));
         }
 
         $existing_record = json_decode($response_check, true);
 
     
             // Si el registro existe, hacer una solicitud PUT para actualizarlo
             $url_update = "http://127.0.0.1:8000/api/assistence/{$employee_id_session}/{$date}";
             curl_setopt($ch, CURLOPT_URL, $url_update);
             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
             curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
             curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
             curl_setopt($ch, CURLOPT_HTTPHEADER, [
                 'Content-Type: application/json'
             ]);
             $response = curl_exec($ch);
             $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
 
             if ($response === FALSE) {
                 die('Error occurred during update: ' . curl_error($ch));
             }
 
             if ($http_code != 200) {
                 die('Error: Received HTTP code ' . $http_code);
             }
 
             echo "<h3>Respuesta del servidor (Actualización):</h3>";
        
    } elseif ($action === 'insert') {
        // Si el registro no existe, hacer una solicitud POST para insertarlo
        $data['employee_id'] = $employee_id_session;
        $data['date'] = $date;

        $url_insert = 'http://127.0.0.1:8000/api/assistence';
        curl_setopt($ch, CURLOPT_URL, $url_insert);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $response = curl_exec($ch);

        if ($response === FALSE) {
            die('Error occurred during insertion: ' . curl_error($ch));
        }

        echo "<h3>Respuesta del servidor (Inserción):</h3>";
    } else {
        echo "Acción no reconocida.";
    }

    curl_close($ch);

    $result = json_decode($response, true);
    echo "<pre>";
    print_r($result);
    echo "</pre>";
}
?>
