<?php
require_once __DIR__ . '/app/config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $autor = $_POST['autor'];
    $url_video = $_POST['url_video'];

    $sql = "INSERT INTO videos (titulo, descripcion, autor, url_video) 
            VALUES ('$titulo', '$descripcion', '$autor', '$url_video')";

    if ($conn->query($sql) === TRUE) {
        header("Location: listar_videos.php");
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
    <title>Nuevo Video</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col items-center text-gray-800">

    <header class="w-full bg-white shadow-md p-4 flex justify-between items-center relative rounded-b-lg mb-8">
        <h1 class="text-3xl font-extrabold text-blue-600 ml-4 md:ml-8">Nuevo Video</h1>
        <div>
            <button onclick="location.href='listar_videos.php'" 
                class="bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg shadow hover:bg-gray-400 transition">
                Volver
            </button>
        </div>
    </header>

    <main class="w-full max-w-2xl p-6 bg-white rounded-xl shadow-md">
        <form method="post" class="flex flex-col gap-4">
            <div>
                <label class="block font-semibold mb-1">Título</label>
                <input type="text" name="titulo" required 
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label class="block font-semibold mb-1">Descripción</label>
                <textarea name="descripcion" rows="4" 
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>
            </div>

            <div>
                <label class="block font-semibold mb-1">Autor</label>
                <input type="text" name="autor" 
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label class="block font-semibold mb-1">URL del Video</label>
                <input type="text" name="url_video" 
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <button type="submit" 
                class="bg-blue-500 text-white font-semibold py-3 px-6 rounded-lg shadow hover:bg-blue-600 transition">
                Guardar
            </button>
        </form>
    </main>

</body>
</html>
