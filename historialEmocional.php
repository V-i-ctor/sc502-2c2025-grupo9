<?php
// ==========================
// historialEmocional.php
//Registro de emociones del usuario con filtro de fecha
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

if (isset($_GET['id_paciente']) && strtolower($_SESSION['tipo']) == 'psicologo') {
    $id_usuario = intval($_GET['id_paciente']);
}

$conexion = new mysqli("localhost", "root", "", "salud_mental");if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$desde = isset($_GET['desde']) ? $_GET['desde'] : '';
$hasta = isset($_GET['hasta']) ? $_GET['hasta'] : '';

$sql = "SELECT fecha, estado_emocional, puntaje, recomendacion 
        FROM autoevaluaciones 
        WHERE id_usuario = ?";

$params = [$id_usuario];
$types = "i";

if ($desde) {
    $sql .= " AND DATE(fecha) >= ?";
    $params[] = $desde;
    $types .= "s";
}
if ($hasta) {
    $sql .= " AND DATE(fecha) <= ?";
    $params[] = $hasta;
    $types .= "s";
}
$sql .= " ORDER BY fecha DESC";

$stmt = $conexion->prepare($sql);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

$registros = [];
while ($row = $result->fetch_assoc()) {
    $registros[] = $row;
}
$stmt->close();
$conexion->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial Emocional</title>
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
        .historial-container {
            flex: 1 0 auto;
            max-width: 700px;
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
        form.filtros {
            margin-bottom: 18px;
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            align-items: center;
            justify-content: center;
        }
        form.filtros label {
            color: #2980b9;
            font-weight: 500;
        }
        form.filtros input[type="date"] {
            padding: 6px 10px;
            border: 1px solid #d0d7de;
            border-radius: 6px;
            font-size: 1rem;
            background: #f8fafc;
        }
        form.filtros button {
            background: linear-gradient(90deg, #2980b9 0%, #6dd5fa 100%);
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 8px 18px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s;
        }
        form.filtros button:hover {
            background: linear-gradient(90deg, #1f5f87 0%, #2980b9 100%);
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
        @media (max-width: 700px) {
            .historial-container {
                padding: 18px 6px;
                max-width: 98vw;
            }
            table, th, td {
                font-size: 0.97rem;
            }
        }
    </style>
</head>
<body>
    <div class="historial-container">
        <h2>Historial Emocional</h2>
        <form class="filtros" method="get">
            <label>Desde: <input type="date" name="desde" value="<?php echo htmlspecialchars($desde); ?>"></label>
            <label>Hasta: <input type="date" name="hasta" value="<?php echo htmlspecialchars($hasta); ?>"></label>
            <button type="submit">Filtrar</button>
        </form>
        <table>
            <tr>
                <th>Fecha</th>
                <th>Estado emocional</th>
                <th>Puntaje</th>
                <th>Recomendación</th>
            </tr>
            <?php if (count($registros) > 0): ?>
                <?php foreach ($registros as $r): ?>
                <tr>
                    <td><?php echo date('d/m/Y', strtotime($r['fecha'])); ?></td>
                    <td><?php echo htmlspecialchars($r['estado_emocional']); ?></td>
                    <td><?php echo htmlspecialchars($r['puntaje']); ?></td>
                    <td><?php echo htmlspecialchars($r['recomendacion']); ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" style="text-align:center;color:#888;">No hay registros para mostrar.</td>
                </tr>
            <?php endif; ?>
        </table>
        <div class="volver">
            <a href="miperfil.php">Volver a mi perfil</a>
        </div>
    </div>
    <footer class="footer-custom">
        <p class="mb-2">📞 Teléfono: <span class="font-semibold">+506 1234-5678</span> | ✉️ Correo: <span class="font-semibold">saludmental@ficticio.com</span></p>
        <p class="mb-2">🌐 Redes: <span class="font-semibold">@SaludMentalCR</span> en Instagram, Facebook y Twitter</p>
        <p class="footer-copy">© 2025 Salud Mental. Todos los derechos reservados.</p>
    </footer>
</body>
</html>