<?php
// Definir los parámetros
$year = 2024;
$employee_id = 26;
$month = 8;
$week = 2;

// URL de la API
$url_work_hours = "http://127.0.0.1:8000/api/assistence/work-hours/$year/$employee_id";
$url_annual_hours = "http://127.0.0.1:8000/api/assistence/annual-hours/$employee_id/$year";
$url_weekly_hours = "http://127.0.0.1:8000/api/assistence/weekly-hours/$employee_id/$year/$month";
$url_daily_details = "http://127.0.0.1:8000/api/assistence/daily-details/$employee_id/$year/$month/$week";

// Función para realizar las solicitudes a la API
function getApiData($url) {
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
    return json_decode($response, true);
}

// Obtener los datos de la API
$data_work_hours = getApiData($url_work_hours);
$data_annual_hours = getApiData($url_annual_hours);
$data_weekly_hours = getApiData($url_weekly_hours);
$data_daily_details = getApiData($url_daily_details);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de Asistencia</title>
</head>
<body>
    <!-- Tabla de horas por mes -->
    <h2>Horas Trabajadas por Mes</h2>
    <table border="1">
        <tr>
            <th>Mes</th>
            <th>Total Horas</th>
        </tr>
        <?php if (isset($data_work_hours['work_hours']) && is_array($data_work_hours['work_hours'])): ?>
            <?php foreach ($data_work_hours['work_hours'] as $work_hour): ?>
                <tr>
                    <td><?php echo $work_hour['mes']; ?></td>
                    <td><?php echo $work_hour['total_horas']; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="2">No hay datos disponibles.</td></tr>
        <?php endif; ?>
    </table>

    <!-- Tabla de horas anuales -->
    <h2>Total de Horas Anuales</h2>
    <table border="1">
        <tr>
            <th>Año</th>
            <th>Total Horas Anuales</th>
        </tr>
        <tr>
            <td><?php echo $data_annual_hours['anio'] ?? 'N/A'; ?></td>
            <td><?php echo $data_annual_hours['total_horas_anuales'] ?? 'N/A'; ?></td>
        </tr>
    </table>

    <!-- Tabla de horas semanales -->
    <h2>Horas Trabajadas por Semana</h2>
    <table border="1">
        <tr>
            <th>Semana del Mes</th>
            <th>Total Horas</th>
        </tr>
        <?php if (isset($data_weekly_hours['semanas']) && is_array($data_weekly_hours['semanas'])): ?>
            <?php foreach ($data_weekly_hours['semanas'] as $weekly_hour): ?>
                <tr>
                    <td><?php echo $weekly_hour['semana_del_mes']; ?></td>
                    <td><?php echo $weekly_hour['total_horas']; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="2">No hay datos disponibles.</td></tr>
        <?php endif; ?>
    </table>

   <!-- Tabla de detalles diarios -->
<h2>Detalles Diarios por Semana</h2>
<table border="1">
    <tr>
        <th>Fecha</th>
        <th>Entrada</th>
        <th>Salida</th>
        <th>Horas Completadas</th>
        <th>Tiempo por Recuperar</th>
        <th>Pausas Completadas</th>
        <th>Tiempo Adicional</th>
        <th>Pausas con Retraso</th>
        <th>Tiempo de Almuerzo</th>
        <th>Justificación</th>

    </tr>
    <?php if (isset($data_daily_details['details']) && is_array($data_daily_details['details'])): ?>
        <?php foreach ($data_daily_details['details'] as $daily_detail): ?>
            <tr>
                <td><?php echo $daily_detail['date']; ?></td>
                <td><?php echo $daily_detail['time_entry']; ?></td>
                <td><?php echo $daily_detail['time_exit']; ?></td>
                <td><?php echo $daily_detail['work_completed']; ?></td>
                <td><?php echo $daily_detail['time_to_recover']; ?></td>
                <td><?php echo $daily_detail['break_completed']; ?></td>
                <td><?php echo $daily_detail['additional_time']; ?></td>
                <td><?php echo $daily_detail['dealy_breaks']; ?></td>
                <td><?php echo $daily_detail['lunch_time']; ?></td>
                <td><?php echo $daily_detail['justificacion']; ?></td>
               
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="11">No hay datos disponibles.</td></tr>
    <?php endif; ?>
</table>

</body>
</html>
