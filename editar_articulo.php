<?php
require_once __DIR__ . '/app/config/db.php';

$id = $_GET['id'];
$sql = "SELECT * FROM articulos WHERE id_articulo=$id";
$result = $conn->query($sql);
$articulo = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $resumen = $_POST['resumen'];
    $contenido = $_POST['contenido'];
    $imagen = $_POST['imagen_url'];
    $autor = $_POST['autor'];

    $sql = "UPDATE articulos 
            SET titulo='$titulo', resumen='$resumen', contenido='$contenido', imagen_url='$imagen', autor='$autor' 
            WHERE id_articulo=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: /sc502-2c2025-grupo9/listar_articulos.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Artículo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col items-center text-gray-800 p-4">

<header class="w-full max-w-4xl flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold">Editar Artículo</h1>
    <a href="/sc502-2c2025-grupo9/listar_articulos.php" class="bg-gray-300 text-gray-800 px-4 py-2 rounded shadow hover:bg-gray-400 transition">Volver</a>
</header>

<main class="w-full max-w-4xl bg-white p-6 rounded-xl shadow-md">
<form method="post" class="flex flex-col gap-4">
    <label>Título:
        <input type="text" name="titulo" value="<?= htmlspecialchars($articulo['titulo']) ?>" required class="w-full border px-3 py-2 rounded">
    </label>
    <label>Resumen:
        <textarea name="resumen" class="w-full border px-3 py-2 rounded"><?= htmlspecialchars($articulo['resumen']) ?></textarea>
    </label>
    <label>Contenido:
        <textarea name="contenido" class="w-full border px-3 py-2 rounded"><?= htmlspecialchars($articulo['contenido']) ?></textarea>
    </label>
    <label>URL:
        <input type="text" name="imagen_url" value="<?= htmlspecialchars($articulo['imagen_url']) ?>" class="w-full border px-3 py-2 rounded">
    </label>
    <label>Autor:
        <input type="text" name="autor" value="<?= htmlspecialchars($articulo['autor']) ?>" class="w-full border px-3 py-2 rounded">
    </label>
    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded shadow hover:bg-green-600 transition">Actualizar</button>
</form>
</main>
</body>
</html>
