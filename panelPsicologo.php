<?php
// ==========================
// panelPsicologo.php
// Panel de control del psicólogo
//   ╱|、
//  (˚ˎ 。7
//  |、˜〵
//  じしˍ,)ノ
// ==========================

session_start();
if (!isset($_SESSION['id_usuario']) || strtolower($_SESSION['tipo']) != 'psicologo') {
    header("Location: login.php");
    exit();
}

$id_psicologo = $_SESSION['id_usuario'];

$conexion = new mysqli("localhost", "root", "", "salud_mental");if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$sql = "SELECT u.ID_Usuario, u.Nombre, u.Correo, u.FotoPerfil
        FROM PACIENTES_PSICOLOGO p
        INNER JOIN USUARIOS u ON p.ID_Paciente = u.ID_Usuario
        WHERE p.ID_Psicologo = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id_psicologo);
$stmt->execute();
$result = $stmt->get_result();

$pacientes = [];
while ($row = $result->fetch_assoc()) {
    $pacientes[] = $row;
}
$stmt->close();
$conexion->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Psicólogo</title>
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
        .panel-container {
            flex: 1 0 auto;
            max-width: 800px;
            margin: 40px auto;
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 4px 24px rgba(44,62,80,0.10);
            padding: 32px 24px;
        }
        h2 {
            color: #2980b9;
            margin-bottom: 18px;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 18px;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #e0eafc;
            text-align: left;
        }
        th {
            background: #e0eafc;
            color: #2980b9;
        }
        .foto-paciente {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #6dd5fa;
            background: #e0eafc;
        }
        .btn-historial {
            background: linear-gradient(90deg, #2980b9 0%, #6dd5fa 100%);
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 8px 18px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s;
            text-decoration: none;
            display: inline-block;
        }
        .btn-historial:hover {
            background: linear-gradient(90deg, #1f5f87 0%, #2980b9 100%);
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
        @media (max-width: 800px) {
            .panel-container {
                padding: 18px 6px;
                max-width: 98vw;
            }
            table, th, td {
                font-size: 0.97rem;
            }
            .foto-paciente {
                width: 36px;
                height: 36px;
            }
        }
    </style>
</head>
<body>
    <div class="panel-container">
        <h2>Pacientes Asignados</h2>
        <table>
            <tr>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
            <?php if (count($pacientes) > 0): ?>
                <?php foreach ($pacientes as $p): ?>
                <tr>
                    <td>
                        <img src="img/<?php echo htmlspecialchars($p['FotoPerfil'] ?: 'default.png'); ?>" alt="Foto" class="foto-paciente">
                    </td>
                    <td><?php echo htmlspecialchars($p['Nombre']); ?></td>
                    <td><?php echo htmlspecialchars($p['Correo']); ?></td>
                    <td>
                        <a href="historialEmocional.php?id_paciente=<?php echo $p['ID_Usuario']; ?>" class="btn-historial">Ver historial</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" style="text-align:center;color:#888;">No hay pacientes asignados.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
    <div class="volver">
        <a href="miperfil.php">Volver a mi perfil</a>
    </div>
    <footer class="footer-custom">
        <p class="mb-2">📞 Teléfono: <span class="font-semibold">+506 1234-5678</span> | ✉️ Correo: <span class="font-semibold">saludmental@ficticio.com</span></p>
        <p class="mb-2">🌐 Redes: <span class="font-semibold">@SaludMentalCR</span> en Instagram, Facebook y Twitter</p>
        <p class="footer-copy">© 2025 Salud Mental. Todos los derechos reservados.</p>
    </footer>
</body>
</html>