<?php
require_once __DIR__ . '/app/config/db.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Videos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col items-center text-gray-800">

    <header class="w-full bg-white shadow-md p-4 flex justify-between items-center relative rounded-b-lg mb-8">
        <h1 class="text-3xl font-extrabold text-green-600 ml-4 md:ml-8">Gestión de Videos</h1>
        <div>
            <button onclick="location.href='index.php'" 
                class="bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg shadow hover:bg-gray-400 transition">
                Volver
            </button>
        </div>
    </header>

    <main class="w-full max-w-4xl p-6">
        <div class="mb-6">
            <a href="crear_video.php" class="bg-green-500 text-white px-4 py-2 rounded shadow hover:bg-green-600 transition">
                ➕ Nuevo Video
            </a>
        </div>

        <?php
        $sql = "SELECT * FROM videos ORDER BY fecha_publicacion DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='bg-white p-6 rounded-xl shadow-md mb-6 hover:shadow-lg transition'>";
                echo "<h2 class='text-2xl font-bold mb-2'>" . htmlspecialchars($row['titulo']) . "</h2>";
                echo "<p class='mb-3'>" . htmlspecialchars($row['descripcion']) . "</p>";
                
                if (!empty($row['url_video'])) {
                    echo "<div class='mb-3'>";
                    echo "<iframe width='100%' height='360' src='" . htmlspecialchars($row['url_video']) . "' frameborder='0' allowfullscreen class='rounded'></iframe>";
                    echo "</div>";
                }

                echo "<div class='flex gap-4 text-blue-600 text-sm'>";
                echo "<a href='editar_video.php?id=" . $row['id_video'] . "' class='hover:underline'>✏ Editar</a>";
                echo "<a href='eliminar_video.php?id=" . $row['id_video'] . "' onclick='return confirm(\"¿Eliminar?\");' class='hover:underline'>🗑 Eliminar</a>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p class='text-gray-500'>No hay videos.</p>";
        }
        ?>
    </main>

</body>
</html>
