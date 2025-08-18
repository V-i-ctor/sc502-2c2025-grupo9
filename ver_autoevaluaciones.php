<?php
session_start();
require_once "app/config/db.php"; 

$id_usuario = $_SESSION['id_usuario'] ?? 1;

// Consultar los últimos 10 registros del usuario
$sql = "SELECT fecha, estado_emocional, puntaje, recomendacion 
        FROM autoevaluaciones 
        WHERE id_usuario = ? 
        ORDER BY fecha DESC 
        LIMIT 10";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();
$resultados = $result->fetch_all(MYSQLI_ASSOC);

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-4 text-gray-700">
  <?php if (count($resultados) > 0): ?>
    <table class="min-w-full bg-white shadow rounded">
      <thead>
        <tr class="bg-gray-200">
          <th class="px-4 py-2 text-left">Fecha</th>
          <th class="px-4 py-2 text-left">Estado</th>
          <th class="px-4 py-2 text-left">Motivación (1-5)</th>
          <th class="px-4 py-2 text-left">Recomendación</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($resultados as $r): ?>
          <tr class="border-t">
            <td class="px-4 py-2"><?= $r['fecha'] ?></td>
            <td class="px-4 py-2"><?= $r['estado_emocional'] ?></td>
            <td class="px-4 py-2"><?= $r['puntaje'] ?></td>
            <td class="px-4 py-2"><?= $r['recomendacion'] ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p>No tienes autoevaluaciones previas.</p>
  <?php endif; ?>
</body>
</html>
