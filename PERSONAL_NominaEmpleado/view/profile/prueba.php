<?php
$url = 'http://127.0.0.1:8000/api/assistence';

// Inicializar cURL
$ch = curl_init();

// Configurar opciones de cURL
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Ejecutar la solicitud GET
$response = curl_exec($ch);



session_start();
$employee_id_session = $_SESSION['id'];

echo $employee_id_session;


  // Función para obtener la fecha actual del sistema
  function getSystemDate() {
    return date('Y-m-d');
}



$system_date = getSystemDate();



if ($response === FALSE) {
    die('Error occurred: ' . curl_error($ch));
}

// Cerrar cURL
curl_close($ch);

// Decodificar y mostrar la respuesta
$data = json_decode($response, true);

if (is_array($data)) {
    echo '<table border="1">';
    echo '<tr>
            <th>ID</th>
            <th>ID del Empleado</th>
            <th>Hora de Entrada</th>
            <th>Hora de Salida</th>
            <th>Trabajo Completado</th>
            <th>Tiempo a Recuperar</th>
            <th>Receso Completado</th>
            <th>Tiempo Adicional</th>
            <th>Retrasos en los Recesos</th>
            <th>Tiempo de Almuerzo</th>
            <th>Tiempo de Almuerzo Restante</th>
            <th>Fecha</th>
          </tr>';
    
    foreach ($data as $item) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($item['id']) . '</td>';
        echo '<td>' . htmlspecialchars($item['employee_id']) . '</td>';
        echo '<td>' . htmlspecialchars($item['time_entry']) . '</td>';
        echo '<td>' . htmlspecialchars($item['time_exit']) . '</td>';
        echo '<td>' . htmlspecialchars($item['work_completed']) . '</td>';
        echo '<td>' . htmlspecialchars($item['time_to_recover']) . '</td>';
        echo '<td>' . htmlspecialchars($item['break_completed']) . '</td>';
        echo '<td>' . htmlspecialchars($item['additional_time']) . '</td>';
        echo '<td>' . htmlspecialchars($item['dealy_breaks']) . '</td>';
        echo '<td>' . htmlspecialchars($item['lunch_time']) . '</td>';
        echo '<td>' . htmlspecialchars($item['remaining_lunch_hour']) . '</td>';
        echo '<td>' . htmlspecialchars($item['date']) . '</td>';
        echo '</tr>';
    }
    
    echo '</table>';
} else {
    echo 'No se recibieron datos válidos de la API.';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Asistencia</title>
</head>
<body>
    <h2>Formulario de Asistencia</h2>
    <form action="process_form.php" method="post">
        <label for="employee_id">ID del Empleado:</label><br>
        <input type="number" id="employee_id" name="employee_id" required><br><br>

        <label for="time_entry">Hora de Entrada:</label><br>
        <input type="text" id="time_entry" name="time_entry" required><br><br>

        <label for="time_exit">Hora de Salida:</label><br>
        <input type="text" id="time_exit" name="time_exit" required><br><br>

        <label for="work_completed">Trabajo Completado:</label><br>
        <input type="text" id="work_completed" name="work_completed" required><br><br>

        <label for="time_to_recover">Tiempo a Recuperar:</label><br>
        <input type="text" id="time_to_recover" name="time_to_recover" required><br><br>

        <label for="break_completed">Receso Completado:</label><br>
        <input type="text" id="break_completed" name="break_completed" required><br><br>

        <label for="additional_time">Tiempo Adicional:</label><br>
        <input type="text" id="additional_time" name="additional_time" required><br><br>

        <label for="dealy_breaks">Retrasos en los Recesos:</label><br>
        <input type="text" id="dealy_breaks" name="dealy_breaks" required><br><br>

        <label for="lunch_time">Tiempo de Almuerzo:</label><br>
        <input type="text" id="lunch_time" name="lunch_time" required><br><br>

        <label for="remaining_lunch_hour">Tiempo de Almuerzo Restante:</label><br>
        <input type="text" id="remaining_lunch_hour" name="remaining_lunch_hour" required><br><br>

        <label for="date">Fecha:</label><br>
        <input type="text" id="date" name="date" required><br><br>

        <button type="submit" name="action" value="insert">Enviar</button>
        <button type="submit" name="action" value="update">Actualizar</button>
    </form>
</body>
</html>



