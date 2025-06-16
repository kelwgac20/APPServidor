<?php
// Conexión a la base de datos
$servidor = "localhost";
$usuario = "root";
$contrasena = ""; // Deja en blanco si no tienes contraseña en XAMPP
$baseDatos = "cursoNascor";

// Crear conexión
$conn = new mysqli($servidor, $usuario, $contrasena, $baseDatos);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL
$sql = "SELECT * FROM noticias ORDER BY fecha DESC";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Noticias - cursoNascor</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 20px;
        }
        .noticia {
            background: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 2px 2px 8px rgba(0,0,0,0.1);
        }
        .noticia h2 {
            margin-top: 0;
        }
        .fecha {
            color: gray;
            font-size: 0.9em;
        }
        .categoria {
            background: #222;
            color: #fff;
            padding: 3px 8px;
            border-radius: 5px;
            font-size: 0.8em;
            float: right;
        }
    </style>
</head>
<body>

    <h1>Últimas Noticias</h1>

    <?php if ($resultado->num_rows > 0): ?>
        <?php while($fila = $resultado->fetch_assoc()): ?>
            <div class="noticia">
                <span class="categoria"><?= htmlspecialchars($fila["categoria"]) ?></span>
                <h2><?= htmlspecialchars($fila["titulo"]) ?></h2>
                <p class="fecha"><?= $fila["fecha"] ?></p>
                <p><?= nl2br(htmlspecialchars($fila["descripcion"])) ?></p>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No hay noticias registradas.</p>
    <?php endif; ?>

    <?php $conn->close(); ?>
</body>
</html>
