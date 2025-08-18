<?php
session_start();

// ID de usuario (ejemplo: sacado de sesión, 1 para pruebas)
$id_usuario = $_SESSION['id_usuario'] ?? 1; 

// Incluir conexión
require_once __DIR__ . '/app/config/db.php';

// Recibir datos del formulario
$estado = $_POST['estado_emocional'] ?? '';
$puntaje = $_POST['puntaje'] ?? '';
$recomendacion = $_POST['recomendacion'] ?? '';

if ($estado && $puntaje && $recomendacion) {
    // Preparar consulta
    $stmt = $conn->prepare("INSERT INTO autoevaluaciones (id_usuario, estado_emocional, puntaje, recomendacion) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isis", $id_usuario, $estado, $puntaje, $recomendacion);

    if ($stmt->execute()) {

    header("Location: formularioAutoevaluacion.html?success=1");
    exit;

    } else {
        echo "Error al guardar: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
