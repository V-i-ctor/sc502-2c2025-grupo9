<?php
require_once __DIR__ . '/app/config/db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    die("Artículo no especificado.");
}

$sql = "SELECT * FROM articulos WHERE id_articulo = $id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    die("Artículo no encontrado.");
}

$articulo = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($articulo['titulo']) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col items-center text-gray-800">

<header class="w-full bg-white shadow-md p-4 flex justify-between items-center rounded-b-lg">
    <h1 class="text-3xl font-extrabold text-blue-600 ml-4 md:ml-8"><?= htmlspecialchars($articulo['titulo']) ?></h1>
    <div>
        <button onclick="location.href='listar_articulos.php'" 
            class="bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg shadow hover:bg-gray-400 transition">
            Volver
        </button>
    </div>
</header>

<main class="flex-grow w-full max-w-2xl p-6 mt-8 bg-white rounded-xl shadow-md">
    <p class="mb-4 text-gray-600 font-semibold">Autor: <?= htmlspecialchars($articulo['autor']) ?></p>
    <p class="mb-6"><?= nl2br(htmlspecialchars($articulo['contenido'])) ?></p>
    <?php if (!empty($articulo['imagen_url'])): ?>
        <img src="<?= htmlspecialchars($articulo['imagen_url']) ?>" alt="Imagen del artículo" class="rounded-lg shadow-md">
    <?php endif; ?>
</main>

    <footer class="w-full bg-gray-800 text-white p-6 text-center mt-auto rounded-t-lg shadow-inner">
        <p class="mb-2">📞 Teléfono: <span class="font-semibold">+506 1234-5678</span> | ✉️ Correo: <span
                class="font-semibold">saludmental@ficticio.com</span></p>
        <p class="mb-2">🌐 Redes: <span class="font-semibold">@SaludMentalCR</span> en Instagram, Facebook y Twitter</p>
        <p class="text-gray-400 text-sm">© 2025 Salud Mental. Todos los derechos reservados.</p>
    </footer>

</body>
</html>
