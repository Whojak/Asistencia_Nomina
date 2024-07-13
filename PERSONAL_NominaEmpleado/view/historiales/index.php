<?php
// Incluye el archivo del modelo de asistencia
require_once("../../config/conexion.php");
require_once("../../models/Asistencia.php");

// Verifica si la sesión ya está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica si el usuario ha iniciado sesión y tiene un employee_id
if (!isset($_SESSION["id"])) {
    die("No hay sesión activa o no se ha proporcionado un employee_id.");
}

// Obtiene el employee_id de la sesión
$employee_id = $_SESSION["id"];


// Crea una instancia del modelo Assistance
$assistance = new Assistance();

// Obtiene las asistencias del empleado
try {
    $asistencias = $assistance->get_asistencia_employee_id($employee_id);
    
} catch (Exception $e) {
    die("Error en la consulta: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de Asistencias</title>
</head>
<body>
    <h1>Historial de Asistencias</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Employee ID</th>
                <th>Time Entry</th>
                <th>Time Exit</th>
                <th>Work Completed</th>
                <th>Time to Recover</th>
                <th>Break Completed</th>
                <th>Additional Time</th>
                <th>Delay Breaks</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($asistencias)): ?>
                <?php foreach ($asistencias as $asistencia): ?>
                    <tr>
                        <td><?php echo $asistencia['id']; ?></td>
                        <td><?php echo $asistencia['employee_id']; ?></td>
                        <td><?php echo $asistencia['time_entry']; ?></td>
                        <td><?php echo $asistencia['time_exit']; ?></td>
                        <td><?php echo $asistencia['work_completed']; ?></td>
                        <td><?php echo $asistencia['time_to_recover']; ?></td>
                        <td><?php echo $asistencia['break_completed']; ?></td>
                        <td><?php echo $asistencia['additional_time']; ?></td>
                        <td><?php echo $asistencia['dealy_breaks']; ?></td>
                        <td><?php echo $asistencia['date']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="10">No se encontraron asistencias.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
