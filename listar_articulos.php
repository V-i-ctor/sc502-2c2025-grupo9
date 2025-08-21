<?php
require_once __DIR__ . '/app/config/db.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Artículos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col items-center text-gray-800 p-4">

<header class="w-full max-w-4xl flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold">Gestión de Artículos</h1>
    <div class="flex gap-2">
        <a href="/sc502-2c2025-grupo9/auto.html" class="bg-gray-300 text-gray-800 px-4 py-2 rounded shadow hover:bg-gray-400 transition">Volver</a>
        <a href="/sc502-2c2025-grupo9/crear_articulo.php" class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-600 transition">➕ Nuevo Artículo</a>
    </div>
</header>

<main class="w-full max-w-4xl">
<?php
$sql = "SELECT * FROM articulos ORDER BY fecha_publicacion DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='bg-white p-6 rounded-xl shadow-md mb-6 hover:shadow-lg transition'>";
        echo "<h2 class='text-2xl font-bold mb-2'>" . htmlspecialchars($row['titulo']) . "</h2>";
        echo "<p class='mb-3'>" . htmlspecialchars($row['resumen']) . "</p>";
        echo "<div class='flex gap-4 text-blue-600 text-sm'>";
        echo "<a href='ver_articulo.php?id=" . $row['id_articulo'] . "' class='hover:underline'>👁 Leer</a>";
        echo "<a href='editar_articulo.php?id=" . $row['id_articulo'] . "' class='hover:underline'>✏ Editar</a>";
        echo "<a href='eliminar_articulo.php?id=" . $row['id_articulo'] . "' onclick='return confirm(\"¿Eliminar?\");' class='hover:underline'>🗑 Eliminar</a>";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "<p class='text-gray-500'>No hay artículos.</p>";
}
?>
</main>
</body>
</html>
