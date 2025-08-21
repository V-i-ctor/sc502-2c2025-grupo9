<?php
// ==========================
// login.php
// Inicio de sesión de usuarios
//   ╱|、
//  (˚ˎ 。7  
//  |、˜〵          
//  じしˍ,)ノ
// ==========================

session_start();
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $conexion = new mysqli("localhost", "root", "", "salud_mental");

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $sql = "SELECT * FROM usuarios WHERE correo = '$email'";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows == 1) {
        $usuario = $resultado->fetch_assoc();
        if (password_verify($password, $usuario['contrasena'])) {
            $_SESSION['usuario'] = $usuario['nombre'];
            $_SESSION['tipo'] = $usuario['rol'];
            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            header("Location: index.php");
            exit();
        } else {
            $mensaje = "Contraseña incorrecta.";
        }
    } else {
        $mensaje = "El correo no está registrado.";
    }

    $conexion->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión - Plataforma Emocional</title>
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
        .container {
            flex: 1 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        form {
            background: #fff;
            margin: 30px auto 0 auto;
            padding: 40px 32px 28px 32px;
            width: 100%;
            max-width: 400px;
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(44, 62, 80, 0.10);
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        h2 {
            color: #2980b9;
            margin-bottom: 10px;
        }
        input {
            width: 92%;
            margin: 0 auto;
            padding: 12px;
            border: 1px solid #d0d7de;
            border-radius: 6px;
            font-size: 1rem;
            background: #f8fafc;
            transition: border-color 0.2s;
        }
        input:focus {
            border-color: #2980b9;
            outline: none;
        }
        button {
            background: linear-gradient(90deg, #2980b9 0%, #6dd5fa 100%);
            color: #fff;
            padding: 14px 0;
            border: none;
            border-radius: 6px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s;
            margin-top: 10px;
        }
        button:hover {
            background: linear-gradient(90deg, #1f5f87 0%, #2980b9 100%);
        }
        .mensaje {
            margin-top: 18px;
            color: #e74c3c;
            font-weight: 500;
            min-height: 24px;
        }
        a {
            color: #2980b9;
            text-decoration: none;
            transition: color 0.2s;
        }
        a:hover {
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
            form {
                padding: 18px 8px 14px 8px;
                max-width: 98vw;
            }
            h2 {
                font-size: 1.2rem;
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
    <div class="container">
        <h2>Iniciar Sesión</h2>
        <form method="post" autocomplete="off">
            <input type="email" name="email" placeholder="Correo electrónico" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Ingresar</button>
        </form>
        <div class="mensaje"><?php echo $mensaje; ?></div>
        <p style="margin-top: 18px;">
            ¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a>
        </p>
        <p style="margin-top: 8px;">
            <a href="index.php">Volver al inicio</a>
        </p>
    </div>
    <footer class="footer-custom">
        <p class="mb-2">📞 Teléfono: <span class="font-semibold">+506 1234-5678</span> | ✉️ Correo: <span class="font-semibold">saludmental@ficticio.com</span></p>
        <p class="mb-2">🌐 Redes: <span class="font-semibold">@SaludMentalCR</span> en Instagram, Facebook y Twitter</p>
        <p class="footer-copy">© 2025 Salud Mental. Todos los derechos reservados.</p>
    </footer>
</body>
</html>