<?php
require_once __DIR__ . '/app/config/db.php';


$id = $_GET['id'];
$sql = "DELETE FROM videos WHERE id_video=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: listar_videos.php");
    exit;
} else {
    echo "Error al eliminar: " . $conn->error;
}
