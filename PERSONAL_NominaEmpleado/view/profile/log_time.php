<?php
date_default_timezone_set('America/El_Salvador');

$actionType = isset($_GET['actionType']) ? $_GET['actionType'] : '';
$action = isset($_GET['action']) ? $_GET['action'] : '';
$time = isset($_GET['time']) ? $_GET['time'] : '';
$dailyPauses = isset($_GET['dailyPauses']) ? $_GET['dailyPauses'] : 0;

$logEntry = '';

function calculateTimeDifference($startTime, $endTime, $isMinutesFormat = false) {
    if ($isMinutesFormat) {
        $start = DateTime::createFromFormat('i:s', $startTime);
        $end = DateTime::createFromFormat('i:s', $endTime);
    } else {
        $start = DateTime::createFromFormat('H:i:s', $startTime);
        $end = DateTime::createFromFormat('H:i:s', $endTime);
    }

    if (!$start || !$end) {
        return 'Invalid time format';
    }

    $interval = $start->diff($end);
    return $interval->format('%H:%I:%S');
}

switch ($actionType) {
    case 'Entrada':
        $loggedTime = date('H:i:s');
        $logEntry = "Entrada: $loggedTime";
        break;
    case 'Salida':
        $loggedTime = date('H:i:s');
        $logEntry = "Salida: $loggedTime";
        break;
    case 'Timer1':
        $initialTime = '06:40:00';
        $timeDifference = calculateTimeDifference($initialTime, $time);
        $logEntry = "Horas de trabajo cumplidas: $timeDifference  Tiempo a reponer $time";
        break;
    case 'Timer2':
        $initialTime = '20:00';
        $timeDifference = calculateTimeDifference($initialTime, $time, true);
        $logEntry = "Receso cumplido: $timeDifference  Tiempo adicional $time";
        break;
    case 'StopTimer':
        $logEntry = "Pausas diarias: $dailyPauses";
        break;
    default:
        $logEntry = "Acción no reconocida";
}

echo $logEntry;
?>
