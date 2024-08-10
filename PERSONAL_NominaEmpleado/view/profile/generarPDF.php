<?php

use Dompdf\Dompdf;
use Dompdf\Options;

session_start();

function generarYDescargarPDF() {
    global $employeeId;

    // Verifica que todas las variables de sesión estén definidas
    if (isset($_SESSION['time_entry'], $_SESSION['time_exit'], $_SESSION['work_completed'], $_SESSION['time_to_recover'], $_SESSION['break_completed'], $_SESSION['additional_time'], $_SESSION['daily_breaks'], $_SESSION['lunch_time'], $_SESSION['justificacion'], $_SESSION['token'])) {
        
        // Contenido del PDF
        $content = "
            <h1>Detalles del Registro</h1>
            <p><strong>ID de Empleado:</strong> $employeeId</p>
            <p><strong>Fecha:</strong> " . date('Y-m-d') . "</p>
            <p><strong>Hora de Entrada:</strong> " . $_SESSION['time_entry'] . "</p>
            <p><strong>Hora de Salida:</strong> " . $_SESSION['time_exit'] . "</p>
            <p><strong>Trabajo Completado:</strong> " . $_SESSION['work_completed'] . "</p>
            <p><strong>Tiempo a Recuperar:</strong> " . $_SESSION['time_to_recover'] . "</p>
            <p><strong>Receso Completado:</strong> " . $_SESSION['break_completed'] . "</p>
            <p><strong>Tiempo Adicional:</strong> " . $_SESSION['additional_time'] . "</p>
            <p><strong>Pausas Diarias:</strong> " . $_SESSION['daily_breaks'] . "</p>
            <p><strong>Tiempo de Almuerzo:</strong> " . $_SESSION['lunch_time'] . "</p>
            <p><strong>Justificación:</strong> " . $_SESSION['justificacion'] . "</p>
            <p><strong>Token:</strong> " . $_SESSION['token'] . "</p>
        ";

        // Cargar el autoload de Composer y la clase DOMPDF
        require __DIR__ . '/../../vendor/autoload.php';
        
        // Crear una instancia de DOMPDF
        $options = new Options();
        $options->set('isRemoteEnabled', true); // Habilitar la carga de imágenes remotas si es necesario
        $dompdf = new Dompdf($options);

        // Cargar el contenido en el objeto DOMPDF
        $dompdf->loadHtml($content);

        // Renderizar el contenido como PDF
        $dompdf->render();

        // Enviar el PDF al navegador para que se descargue
        $dompdf->stream('registro.pdf', array("Attachment" => 0));
    } else {
        echo "No se encontraron todos los datos necesarios en la sesión.";
    }
}

// Generar el PDF cuando se acceda a esta página
generarYDescargarPDF();

?>
