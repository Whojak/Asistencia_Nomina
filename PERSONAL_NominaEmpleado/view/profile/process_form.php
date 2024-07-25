<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        "employee_id" => $_POST["employee_id"],
        "time_entry" => $_POST["time_entry"],
        "time_exit" => $_POST["time_exit"],
        "work_completed" => $_POST["work_completed"],
        "time_to_recover" => $_POST["time_to_recover"],
        "break_completed" => $_POST["break_completed"],
        "additional_time" => $_POST["additional_time"],
        "dealy_breaks" => $_POST["dealy_breaks"],
        "lunch_time" => $_POST["lunch_time"],
        "remaining_lunch_hour" => $_POST["remaining_lunch_hour"],
        "date" => $_POST["date"]
    ];

    $url = 'http://127.0.0.1:8000/api/assistence';

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);

    if ($response === FALSE) {
        die('Error occurred: ' . curl_error($ch));
    }

    curl_close($ch);

    $result = json_decode($response, true);
    echo "<h3>Respuesta del servidor:</h3>";
    echo "<pre>";
    print_r($result);
    echo "</pre>";
}
?>
