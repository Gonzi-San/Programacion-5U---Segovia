<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $conexion->real_escape_string($_POST['nombre']);
    $fecha_falta = $conexion->real_escape_string($_POST['fecha_falta']);
    $comentario = $conexion->real_escape_string($_POST['comentario']);

    $sql = "INSERT INTO deudores (nombre, fecha_falta, debe_proximo, comentario) 
            VALUES ('$nombre', '$fecha_falta', TRUE, '$comentario')";

    if ($conexion->query($sql) === TRUE) {
        header("Location: index.php"); // Redirigir al listado
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
}
$conexion->close();
?>