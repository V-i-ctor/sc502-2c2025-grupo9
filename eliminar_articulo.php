<?php
require_once __DIR__ . '/app/config/db.php';

$id = $_GET['id'];
$sql = "DELETE FROM articulos WHERE id_articulo=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: /sc502-2c2025-grupo9/listar_articulos.php");
    exit;
} else {
    echo "Error al eliminar: " . $conn->error;
}
?>
