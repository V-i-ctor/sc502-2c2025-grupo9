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

    <footer>
        <p class="mb-2">📞 Teléfono: <span class="font-semibold">+506 1234-5678</span> | ✉️ Correo: <span class="font-semibold">saludmental@ficticio.com</span></p>
        <p class="mb-2">🌐 Redes: <span class="font-semibold">@SaludMentalCR</span> en Instagram, Facebook y Twitter</p>
        <p class="text-gray-400 text-sm">© 2025 Salud Mental. Todos los derechos reservados.</p>
    </footer>
</body>
</html>