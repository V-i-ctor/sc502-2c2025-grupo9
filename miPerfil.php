<?php
// ==========================
// miperfil.php
// Página de perfil del usuario
//   ╱|、
//  (˚ˎ 。7  
//  |、˜〵          
//  じしˍ,)ノ
// ==========================

session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

$id_usuario = $_SESSION['id_usuario'];

$conexion = new mysqli("localhost", "root", "", "salud_mental");if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$sql = "SELECT Nombre, Correo, Rol, FotoPerfil FROM USUARIOS WHERE ID_Usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$stmt->bind_result($nombre, $correo, $rol, $foto);
$stmt->fetch();
$stmt->close();
$conexion->close();

if (!$foto) $foto = "default.png";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Perfil - Plataforma Emocional</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #e0eafc 0%, #cfdef3 100%);
        }
        .perfil-container {
            flex: 1 0 auto;
            max-width: 420px;
            margin: 40px auto 0 auto;
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 4px 24px rgba(44,62,80,0.10);
            padding: 32px 24px 28px 24px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .perfil-foto {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 18px;
            border: 3px solid #6dd5fa;
            background: #e0eafc;
        }
        .perfil-nombre {
            font-size: 1.5rem;
            font-weight: bold;
            color: #2980b9;
        }
        .perfil-rol {
            color: #6dd5fa;
            font-weight: 600;
            margin-bottom: 10px;
        }
        .perfil-correo {
            color: #555;
            margin-bottom: 18px;
            word-break: break-all;
        }
        .btn-editar {
            background: linear-gradient(90deg, #2980b9 0%, #6dd5fa 100%);
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 10px 24px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            margin-bottom: 24px;
            transition: background 0.2s;
        }
        .btn-editar:hover {
            background: linear-gradient(90deg, #1f5f87 0%, #2980b9 100%);
        }
        .accesos {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-top: 10px;
            width: 100%;
        }
        .accesos a {
            background: #f8fafc;
            color: #2980b9;
            border-radius: 6px;
            padding: 12px;
            text-decoration: none;
            font-weight: 600;
            transition: background 0.2s, color 0.2s;
            box-shadow: 0 1px 4px rgba(44,62,80,0.04);
            display: block;
        }
        .accesos a:hover {
            background: #e0eafc;
            color: #1f5f87;
        }
        .volver {
            margin: 32px auto 0 auto;
            text-align: center;
        }
        .volver a {
            color: #2980b9;
            text-decoration: none;
            font-size: 1rem;
            transition: color 0.2s;
        }
        .volver a:hover {
            color: #1f5f87;
            text-decoration: underline;
        }
        .footer-custom {
            flex-shrink: 0;
            width: 100%;
            background: #23272f;
            color: #fff;
            text-align: center;
            padding: 24px 0 16px 0;
            position: relative;
            bottom: 0;
            left: 0;
            font-size: 1rem;
            letter-spacing: 0.5px;
            border-top-left-radius: 18px;
            border-top-right-radius: 18px;
            box-shadow: 0 -2px 16px rgba(44,62,80,0.10) inset;
        }
        .footer-custom .mb-2 {
            margin-bottom: 8px;
        }
        .footer-custom .font-semibold {
            font-weight: 600;
        }
        .footer-custom .footer-copy {
            color: #b0b7c3;
            font-size: 0.97em;
            margin-top: 8px;
        }
        @media (max-width: 500px) {
            .perfil-container {
                padding: 18px 6px 14px 6px;
                max-width: 98vw;
            }
            .perfil-nombre {
                font-size: 1.1rem;
            }
            .footer-custom {
                font-size: 0.95rem;
                padding: 16px 0 10px 0;
                border-top-left-radius: 10px;
                border-top-right-radius: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="perfil-container">
        <img src="img/<?php echo htmlspecialchars($foto); ?>" alt="Foto de perfil" class="perfil-foto">
        <div class="perfil-nombre"><?php echo htmlspecialchars($nombre); ?></div>
        <div class="perfil-rol"><?php echo ucfirst(htmlspecialchars($rol)); ?></div>
        <div class="perfil-correo"><?php echo htmlspecialchars($correo); ?></div>
        <button class="btn-editar" onclick="location.href='editar_perfil.php'">Editar datos</button>
        <div class="accesos">
            <a href="historialEmocional.php">Historial emocional</a>
            <a href="appointments.html">Citas programadas</a>
            <a href="resources.html">Recursos guardados</a>
            <?php if (strtolower($rol) == 'psicologo'): ?>
                <a href="panelPsicologo.php">Panel Psicólogo</a>
            <?php endif; ?>
        </div>
    </div>
    <div class="volver">
        <a href="index.php">Volver al inicio</a>
    </div>
    <footer class="footer-custom">
        <p class="mb-2">📞 Teléfono: <span class="font-semibold">+506 1234-5678</span> | ✉️ Correo: <span class="font-semibold">saludmental@ficticio.com</span></p>
        <p class="mb-2">🌐 Redes: <span class="font-semibold">@SaludMentalCR</span> en Instagram, Facebook y Twitter</p>
        <p class="footer-copy">© 2025 Salud Mental. Todos los derechos reservados.</p>
    </footer>
</body>
</html>