<?php
$articulos = [
    [
        'titulo' => '¿Qué es la autoevaluación emocional?',
        'resumen' => 'La autoevaluación emocional es una herramienta para conocer tu estado de ánimo...',
        'autor' => 'Equipo Salud Mental',
        'fecha' => '2025-08-21'
    ],
    [
        'titulo' => 'Técnicas para manejar la ansiedad',
        'resumen' => 'Respiración profunda, meditación y ejercicio pueden ayudarte a controlar la ansiedad.',
        'autor' => 'Psic. Sofía Méndez',
        'fecha' => '2025-08-20'
    ],
    [
        'titulo' => 'Importancia de pedir ayuda',
        'resumen' => 'Buscar apoyo profesional es un acto de valentía y autocuidado.',
        'autor' => 'Equipo Salud Mental',
        'fecha' => '2025-08-19'
    ]
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Artículos Educativos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-100 to-blue-200 min-h-screen flex flex-col items-center text-gray-800">

    <header class="w-full bg-white shadow-md p-4 flex justify-between items-center rounded-b-2xl">
        <h1 class="text-3xl font-extrabold text-blue-700 ml-2">Artículos Educativos</h1>
        <button onclick="location.href='index.php'"
            class="flex items-center gap-2 bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-5 rounded-xl shadow transition">
            <span class="material-icons">arrow_back</span>
            Volver
        </button>
    </header>

    <main class="flex-grow w-full max-w-5xl p-4 md:p-8 mt-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($articulos as $art): ?>
                <div class="bg-white rounded-2xl shadow-lg p-6 flex flex-col justify-between hover:shadow-2xl transition">
                    <div>
                        <h2 class="text-xl font-bold text-blue-600 mb-2"><?php echo htmlspecialchars($art['titulo']); ?></h2>
                        <p class="text-gray-700 mb-4"><?php echo htmlspecialchars($art['resumen']); ?></p>
                    </div>
                    <div class="flex items-center justify-between mt-4">
                        <span class="text-sm text-gray-500"><?php echo htmlspecialchars($art['autor']); ?></span>
                        <span class="text-xs text-gray-400"><?php echo htmlspecialchars($art['fecha']); ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <footer class="w-full bg-white text-gray-500 p-6 text-center mt-auto rounded-t-2xl shadow-inner">
        © 2025 Plataforma Emocional. Todos los derechos reservados.
    </footer>
</body>
</html>
