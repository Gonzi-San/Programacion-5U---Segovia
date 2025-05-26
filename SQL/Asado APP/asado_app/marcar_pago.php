<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "UPDATE deudores SET debe_proximo = FALSE WHERE id = $id";
    $conexion->query($sql);
}
header("Location: index.php"); // Volver al listado
$conexion->close();
?>