<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Artículos Educativos</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col items-center text-gray-800">

    <header class="w-full bg-white shadow-md p-4 flex justify-between items-center relative rounded-b-lg">
        <h1 class="text-3xl font-extrabold text-blue-600 ml-4 md:ml-8">Artículos Educativos</h1>
        <div>
            <button onclick="location.href='index.html'" 
                class="bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg shadow hover:bg-gray-400 transition">
                Volver
            </button>
        </div>
    </header>

    <main class="flex-grow w-full max-w-4xl p-4 md:p-8 mt-8">
        <div id="lista-articulos">
            <?php include 'listar_articulos.php'; ?>
        </div>
    </main>

    <footer class="w-full bg-gray-800 text-white p-6 text-center mt-auto rounded-t-lg shadow-inner">
        <p class="mb-2">📞 Teléfono: <span class="font-semibold">+506 1234-5678</span> | ✉️ Correo: <span
                class="font-semibold">saludmental@ficticio.com</span></p>
        <p class="mb-2">🌐 Redes: <span class="font-semibold">@SaludMentalCR</span> en Instagram, Facebook y Twitter</p>
        <p class="text-gray-400 text-sm">© 2025 Salud Mental. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
