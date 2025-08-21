<?php
require_once __DIR__ . '/app/config/db.php';

$id = $_GET['id'];
$sql = "SELECT * FROM videos WHERE id_video=$id";
$result = $conn->query($sql);
$video = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $autor = $_POST['autor'];
    $url_video = $_POST['url_video'];

    $sql = "UPDATE videos 
            SET titulo='$titulo', descripcion='$descripcion', autor='$autor', url_video='$url_video' 
            WHERE id_video=$id";

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
    <title>Editar Video</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col items-center text-gray-800">

    <header class="w-full bg-white shadow-md p-4 flex justify-between items-center relative rounded-b-lg mb-8">
        <h1 class="text-3xl font-extrabold text-green-600 ml-4 md:ml-8">Editar Video</h1>
        <div>
            <button onclick="location.href='listar_videos.php'" 
                class="bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg shadow hover:bg-gray-400 transition">
                Volver
            </button>
        </div>
    </header>

    <main class="w-full max-w-2xl p-6 bg-white rounded-xl shadow-md">
        <form method="post" class="flex flex-col gap-4">
            <label class="font-semibold">Título:</label>
            <input type="text" name="titulo" value="<?= htmlspecialchars($video['titulo']) ?>" required
                class="border rounded px-3 py-2 w-full">

            <label class="font-semibold">Descripción:</label>
            <textarea name="descripcion" class="border rounded px-3 py-2 w-full"><?= htmlspecialchars($video['descripcion']) ?></textarea>

            <label class="font-semibold">Autor:</label>
            <input type="text" name="autor" value="<?= htmlspecialchars($video['autor']) ?>"
                class="border rounded px-3 py-2 w-full">

            <label class="font-semibold">URL Video:</label>
            <input type="text" name="url_video" value="<?= htmlspecialchars($video['url_video']) ?>"
                class="border rounded px-3 py-2 w-full">

            <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded shadow hover:bg-green-600 transition">
                Actualizar
            </button>
        </form>
    </main>

</body>
</html>
