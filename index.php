<?php
// ==========================
// index.php
// Página de inicio
//   ╱|、
//  (˚ˎ 。7  
//  |、˜〵          
//  じしˍ,)ノ
// ==========================

session_start();
$logueado = isset($_SESSION['usuario']);
$nombre = $logueado ? $_SESSION['usuario'] : '';
$tipo = $logueado ? $_SESSION['tipo'] : '';

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido - Plataforma Emocional</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #6dd5fa, #2980b9);
            text-align: center;
            color: #fff;
        }
        header {
            padding: 20px;
            background: rgba(0,0,0,0.3);
        }
        .navbar {
            width: 100%;
            box-sizing: border-box; 
            background: #23272f;
            color: #fff;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 10px 24px;
            gap: 18px;
            font-size: 1rem;
            overflow-x: auto; 
        }
        .navbar a {
            color: #fff;
            text-decoration: none;
            margin-left: 18px;
            font-weight: 600;
            transition: color 0.2s;
        }
        .navbar a:hover {
            color: #6dd5fa;
        }
        .navbar .bienvenida {
            margin-right: auto;
            font-weight: 600;
            color: #6dd5fa;
        }
        .container {
            margin-top: 100px;
            flex: 1;
        }
        .btn {
            background: #fff;
            color: #2980b9;
            padding: 15px 30px;
            margin: 10px;
            text-decoration: none;
            border-radius: 8px;
            font-size: 18px;
            transition: 0.3s;
            display: inline-block;
        }
        .btn:hover {
            background: #2980b9;
            color: #fff;
        }
        footer {
            padding: 24px 20px 20px 20px;
            background: rgba(0,0,0,0.3);
            border-radius: 1rem 1rem 0 0;
            box-shadow: 0 -2px 8px rgba(0,0,0,0.1);
            font-size: 16px;
        }
        .font-semibold {
            font-weight: 600;
        }
        .text-gray-400 {
            color: #d1d5db;
        }
        .text-sm {
            font-size: 14px;
        }
        @media (max-width: 600px) {
            .container {
                margin-top: 40px;
            }
            .btn {
                width: 90%;
                margin: 10px auto;
                font-size: 16px;
            }
            footer {
                font-size: 14px;
                padding: 16px 8px 12px 8px;
            }
            .navbar {
                flex-direction: column;
                align-items: flex-start;
                font-size: 0.97rem;
                padding: 10px 8px;
                gap: 8px;
            }
            .navbar a {
                margin-left: 0;
            }
        }
    </style>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <?php if ($logueado): ?>
        <div class="navbar">
            <span class="bienvenida">¡Bienvenido, <?php echo htmlspecialchars($nombre); ?>!</span>
            <a href="miperfil.php">Mi Perfil</a>
            <?php if (strtolower($tipo) == 'psicologo'): ?>
                <a href="panelpsicologo.php">Panel Psicólogo</a>
            <?php endif; ?>
            <a href="logout.php">Cerrar sesión</a>
        </div>
    <?php endif; ?>

    <header>
        <h1>Bienvenido a la Plataforma de Apoyo Emocional</h1>
    </header>

    <div class="container">
        <h2>Tu espacio seguro para el bienestar emocional</h2>
        <?php if (!$logueado): ?>
            <a href="registro.php" class="btn">Registrarse</a>
            <a href="login.php" class="btn">Iniciar Sesión</a>
        <?php endif; ?>
    </div>
    <?php if ($logueado): ?>
        <div class="w-full max-w-6xl mx-auto mt-12 mb-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Contenido Educativo -->
                <a href="articulosAutoevaluacion.php" class="group relative flex flex-col items-start p-8 rounded-3xl overflow-hidden transition-all duration-300 ease-in-out transform hover:-translate-y-2 hover:shadow-xl bg-teal-400 text-white">
                    <div class="absolute inset-0 bg-white opacity-10 blur-3xl rounded-full"></div>
                    <div class="flex items-center justify-center p-3 rounded-full bg-white bg-opacity-20 backdrop-filter backdrop-blur-sm">
                        <span class="material-icons text-3xl">school</span>
                    </div>
                    <h3 class="mt-4 text-xl font-bold">Contenido Educativo</h3>
                    <p class="mt-1 text-sm text-white text-opacity-80">Accede rápidamente a este módulo.</p>
                    <div class="absolute bottom-4 right-4 text-white text-opacity-80 transition-transform duration-300 group-hover:translate-x-1">
                        <span class="material-icons">chevron_right</span>
                    </div>
                </a>
                <!-- Chat en vivo -->
                <a href="chat.html" class="group relative flex flex-col items-start p-8 rounded-3xl overflow-hidden transition-all duration-300 ease-in-out transform hover:-translate-y-2 hover:shadow-xl bg-green-400 text-white">
                    <div class="absolute inset-0 bg-white opacity-10 blur-3xl rounded-full"></div>
                    <div class="flex items-center justify-center p-3 rounded-full bg-white bg-opacity-20 backdrop-filter backdrop-blur-sm">
                        <span class="material-icons text-3xl">chat</span>
                    </div>
                    <h3 class="mt-4 text-xl font-bold">Chat en vivo</h3>
                    <p class="mt-1 text-sm text-white text-opacity-80">Accede rápidamente a este módulo.</p>
                    <div class="absolute bottom-4 right-4 text-white text-opacity-80 transition-transform duration-300 group-hover:translate-x-1">
                        <span class="material-icons">chevron_right</span>
                    </div>
                </a>
                <!-- Citas programadas -->
                <a href="appointments.html" class="group relative flex flex-col items-start p-8 rounded-3xl overflow-hidden transition-all duration-300 ease-in-out transform hover:-translate-y-2 hover:shadow-xl bg-blue-400 text-white">
                    <div class="absolute inset-0 bg-white opacity-10 blur-3xl rounded-full"></div>
                    <div class="flex items-center justify-center p-3 rounded-full bg-white bg-opacity-20 backdrop-filter backdrop-blur-sm">
                        <span class="material-icons text-3xl">event_note</span>
                    </div>
                    <h3 class="mt-4 text-xl font-bold">Citas programadas</h3>
                    <p class="mt-1 text-sm text-white text-opacity-80">Accede rápidamente a este módulo.</p>
                    <div class="absolute bottom-4 right-4 text-white text-opacity-80 transition-transform duration-300 group-hover:translate-x-1">
                        <span class="material-icons">chevron_right</span>
                    </div>
                </a>
                <!-- Recursos guardados -->
                <a href="resources.html" class="group relative flex flex-col items-start p-8 rounded-3xl overflow-hidden transition-all duration-300 ease-in-out transform hover:-translate-y-2 hover:shadow-xl bg-purple-400 text-white">
                    <div class="absolute inset-0 bg-white opacity-10 blur-3xl rounded-full"></div>
                    <div class="flex items-center justify-center p-3 rounded-full bg-white bg-opacity-20 backdrop-filter backdrop-blur-sm">
                        <span class="material-icons text-3xl">bookmark</span>
                    </div>
                    <h3 class="mt-4 text-xl font-bold">Recursos guardados</h3>
                    <p class="mt-1 text-sm text-white text-opacity-80">Accede rápidamente a este módulo.</p>
                    <div class="absolute bottom-4 right-4 text-white text-opacity-80 transition-transform duration-300 group-hover:translate-x-1">
                        <span class="material-icons">chevron_right</span>
                    </div>
                </a>
                <!-- Autoevaluaciones -->
                <a href="auto.html" class="group relative flex flex-col items-start p-8 rounded-3xl overflow-hidden transition-all duration-300 ease-in-out transform hover:-translate-y-2 hover:shadow-xl bg-pink-400 text-white">
                    <div class="absolute inset-0 bg-white opacity-10 blur-3xl rounded-full"></div>
                    <div class="flex items-center justify-center p-3 rounded-full bg-white bg-opacity-20 backdrop-filter backdrop-blur-sm">
                        <span class="material-icons text-3xl">psychology</span>
                    </div>
                    <h3 class="mt-4 text-xl font-bold">Autoevaluaciones</h3>
                    <p class="mt-1 text-sm text-white text-opacity-80">Accede a tus autoevaluaciones y recursos.</p>
                    <div class="absolute bottom-4 right-4 text-white text-opacity-80 transition-transform duration-300 group-hover:translate-x-1">
                        <span class="material-icons">chevron_right</span>
                    </div>
                </a>
            </div>
        </div>
    <?php endif; ?>

    <footer>
        <p class="mb-2">📞 Teléfono: <span class="font-semibold">+506 1234-5678</span> | ✉️ Correo: <span class="font-semibold">saludmental@ficticio.com</span></p>
        <p class="mb-2">🌐 Redes: <span class="font-semibold">@SaludMentalCR</span> en Instagram, Facebook y Twitter</p>
        <p class="text-gray-400 text-sm">© 2025 Salud Mental. Todos los derechos reservados.</p>
    </footer>
</body>
</html>