<?php
require_once "functions.php";
require_once "conexion.php";
require_once "session.php";

define('uploads_dir', 'uploads');

$tituloErr = $categoriaErr = $descripcionErr = $fotoErr = $insertaErr = "";
$titulo = $categoria = $descripcion = $insertaSuccess = "";
$errorGeneral = false;

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario_id']) || !isset($_SESSION['nombre'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['usuario_id'];
$nombre_usuario = $_SESSION['nombre'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Manejo de imagen
    $foto = null;
    if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] === UPLOAD_ERR_OK) {
        $fotoTmp = $_FILES["foto"]["tmp_name"];
        $fotoNombre = basename($_FILES["foto"]["name"]);
        $foto = uploads_dir . "/" . uniqid() . "-" . $fotoNombre;
        if (!is_dir(uploads_dir)) mkdir(uploads_dir, 0755, true);
        if (!move_uploaded_file($fotoTmp, $foto)) {
            $fotoErr = "❌ Hubo un error al subir la imagen.";
            $errorGeneral = true;
        }
    }

    // Validación de campos
    if (empty(trim($_POST["titulo"] ?? ""))) {
        $tituloErr = "Tienes que introducir un título";
        $errorGeneral = true;
    } else {
        $titulo = test_input($_POST["titulo"]);
    }

    if (empty(trim($_POST["categoria"] ?? ""))) {
        $categoriaErr = "Tienes que introducir una categoría";
        $errorGeneral = true;
    } else {
        $categoria = test_input($_POST["categoria"]);
        if (!$foto) {
            $foto = 'uploads/' . $categoria . '.jpg';
        }
    }

    if (empty(trim($_POST["descripcion"] ?? ""))) {
        $descripcionErr = "Tienes que introducir algún texto";
        $errorGeneral = true;
    } else {
        $descripcion = test_input($_POST["descripcion"]);
    }

    // Inserción en la base de datos
    if (!$errorGeneral) {
        try {
            $stmt = $pdo->prepare(
                "INSERT INTO noticias (titulo, descripcion, categoria, user_id, foto) 
                 VALUES (?, ?, ?, ?, ?)"
            );
            $stmt->execute([$titulo, $descripcion, $categoria, $user_id, $foto]);
            $insertaSuccess = "✅ Noticia insertada con éxito.";
            $titulo = $categoria = $descripcion = "";
        } catch (Exception $e) {
            $insertaErr = "❌ Error al guardar en la base de datos: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Añadir Noticia</title>
    <link rel="stylesheet" href="CSS/styles.css" />
</head>
<body>
    <?php require_once "partials/header.php"; ?>
    <div id="main">
        <?php if ($insertaSuccess): ?>
            <h2 class="success"><?= htmlspecialchars($insertaSuccess) ?></h2>
        <?php endif; ?>
        <?php if ($insertaErr): ?>
            <h2 class="error"><?= htmlspecialchars($insertaErr) ?></h2>
        <?php endif; ?>

        <h1>AÑADIR NOTICIA</h1>
        <form action="anadir_noticia.php" method="POST" enctype="multipart/form-data">
            <label for="titulo">Título de la noticia:</label>
            <input type="text" name="titulo" id="titulo" value="<?= htmlspecialchars($titulo) ?>">
            <span class="error">* <?= $tituloErr ?></span>
            <br>

            <label>Autor:</label>
            <input type="text" value="<?= htmlspecialchars($nombre_usuario) ?>" readonly>
            <input type="hidden" name="user_id" value="<?= $user_id ?>">
            <br>

            <label for="categoria">Categoría:</label>
            <select name="categoria" id="categoria">
                <option value="">-- Selecciona --</option>
                <option value="Noticias" <?= ($categoria === "Noticias") ? "selected" : "" ?>>Noticias</option>
                <option value="Curiosidades" <?= ($categoria === "Curiosidades") ? "selected" : "" ?>>Curiosidades</option>
                <option value="Deportes" <?= ($categoria === "Deportes") ? "selected" : "" ?>>Deportes</option>
                <option value="Tiempo" <?= ($categoria === "Tiempo") ? "selected" : "" ?>>Tiempo</option>
                <option value="Humor" <?= ($categoria === "Humor") ? "selected" : "" ?>>Humor</option>
                <option value="Variedades" <?= ($categoria === "Variedades") ? "selected" : "" ?>>Variedades</option>
            </select>
            <span class="error">* <?= $categoriaErr ?></span>
            <br>

            <label for="foto">Elige una imagen:</label>
            <input type="file" name="foto" id="foto" accept="image/*">
            <span class="error"><?= $fotoErr ?></span>
            <br>

            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" id="descripcion" placeholder="Contenido de la noticia"><?= htmlspecialchars($descripcion) ?></textarea>
            <span class="error">* <?= $descripcionErr ?></span>
            <br><br>

            <input type="submit" value="Enviar">
        </form>
    </div>
    <?php require_once "partials/footer.php"; ?>
</body>
</html>
