<?php
require 'clase.php';

$imagenNombre = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ruta de destino para guardar imágenes
    $carpetaDestino = "images/";
    $nombreImagen = basename($_FILES["imagen"]["name"]);
    $rutaImagen = $carpetaDestino . $nombreImagen;

    // Guardar imagen si es válida
    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaImagen)) {
        $imagenNombre = $rutaImagen;
    } else {
        $imagenNombre = "images/default.png"; // Imagen por defecto si falla
    }

    $persona = new Persona(
        $_POST['nombre'],
        $_POST['email'],
        $_POST['empleo'],
        $_POST['titulacion'],
        $_POST['comentario'],
        $imagenNombre
    );
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Datos del Usuario</title>
    <style>
        .tarjeta {
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 12px;
            padding: 20px;
            margin: 20px auto;
            text-align: center;
            box-shadow: 2px 2px 10px rgba(0,0,0,0.1);
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }

        .avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-image: url('<?php echo htmlspecialchars($persona->getImagen()); ?>');
            background-size: cover;
            background-position: center;
            margin: 0 auto 15px auto;
            border: 3px solid #555;
        }

        .info {
            text-align: left;
        }
    </style>
</head>
<body>

<div class="tarjeta">
    <div class="avatar"></div>
    <h3><?= htmlspecialchars($persona->getNombre()) ?></h3>
    <div class="info">
        <p><strong>Email:</strong> <?= htmlspecialchars($persona->getEmail()) ?></p>
        <p><strong>Empleo:</strong> <?= htmlspecialchars($persona->getEmpleo()) ?></p>
        <p><strong>Titulación:</strong> <?= htmlspecialchars($persona->getTitulacion()) ?></p>
        <p><strong>Comentario:</strong><br><?= nl2br(htmlspecialchars($persona->getComentario())) ?></p>
    </div>
</div>

</body>
</html>
