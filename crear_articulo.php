<?php
require_once __DIR__ . '/app/config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $resumen = $_POST['resumen'];
    $contenido = $_POST['contenido'];
    $imagen = $_POST['imagen_url'];
    $autor = $_POST['autor'];

    $sql = "INSERT INTO articulos (titulo, resumen, contenido, imagen_url, autor) 
            VALUES ('$titulo', '$resumen', '$contenido', '$imagen', '$autor')";

    if ($conn->query($sql) === TRUE) {
        header("Location: listar_articulos.php");
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
    <title>Crear Nuevo Artículo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col items-center text-gray-800">

    <header class="w-full bg-white shadow-md p-4 flex justify-between items-center rounded-b-lg">
        <h1 class="text-3xl font-extrabold text-blue-600 ml-4 md:ml-8">Nuevo Artículo</h1>
        <div>
            <button onclick="location.href='listar_articulos.php'" 
                class="bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg shadow hover:bg-gray-400 transition">
                Volver
            </button>
        </div>
    </header>

    <main class="flex-grow w-full max-w-2xl p-6 mt-8 bg-white rounded-xl shadow-md">
        <form method="post" class="flex flex-col gap-4">
            
            <label class="font-semibold">Título:</label>
            <input type="text" name="titulo" required class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">

            <label class="font-semibold">Resumen:</label>
            <textarea name="resumen" rows="3" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>

            <label class="font-semibold">Contenido:</label>
            <textarea name="contenido" rows="5" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>

            <label class="font-semibold">Imagen URL:</label>
            <input type="text" name="imagen_url" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">

            <label class="font-semibold">Autor:</label>
            <input type="text" name="autor" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">

            <button type="submit" class="bg-blue-500 text-white font-semibold py-3 px-6 rounded-lg shadow hover:bg-blue-600 transition mt-4">
                Guardar Artículo
            </button>
        </form>
    </main>

    <footer class="w-full bg-gray-800 text-white p-6 text-center mt-auto rounded-t-lg shadow-inner">
        <p class="text-gray-400 text-sm">© 2025 Salud Mental. Todos los derechos reservados.</p>
    </footer>

</body>
</html>
