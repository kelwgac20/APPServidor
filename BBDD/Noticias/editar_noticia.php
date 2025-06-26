<?php
require_once "conexion.php";
require_once "session.php";

// Si accede por GET, mostrar formulario
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener datos de la noticia
    $stmt = $pdo->prepare("SELECT * FROM noticias WHERE id = ?");
    $stmt->execute([$id]);
    $noticia = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$noticia) {
        echo "Noticia no encontrada.";
        exit;
    }

    // Obtener todas las categorías disponibles
    $stmtCat = $pdo->query("SELECT DISTINCT categoria FROM noticias ORDER BY categoria ASC");
    $categorias = $stmtCat->fetchAll(PDO::FETCH_COLUMN);
}

// Si se envió el formulario (POST)
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $categoria = $_POST['categoria'];
    $fotoAntigua = $_POST['fotoAntigua'];

    $nuevaRutaFoto = $fotoAntigua;

    // Si se subió una nueva foto
    if (!empty($_FILES['foto']['name'])) {
        $foto = $_FILES['foto'];
        $rutaFoto = "fotos/" . basename($foto['name']);
        move_uploaded_file($foto['tmp_name'], $rutaFoto);
        $nuevaRutaFoto = $rutaFoto;

        // Eliminar la antigua si es diferente
        if ($fotoAntigua && file_exists($fotoAntigua)) {
            unlink($fotoAntigua);
        }
    }

    // Actualizar noticia
    $stmt = $pdo->prepare("UPDATE noticias SET titulo = ?, descripcion = ?, categoria = ?, foto = ? WHERE id = ?");
    $stmt->execute([$titulo, $descripcion, $categoria, $nuevaRutaFoto, $id]);

    header("Location: index.php");
    exit;
} else {
    echo "Acceso inválido.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Noticia</title>
    <link rel="stylesheet" href="CSS/styles.css">
</head>
<body>
<?php require_once "partials/header.php"; ?>
<div id="main" class="tarjeta">
    <h1>✏️ Editar Noticia</h1>
    <form action="editar_noticia.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $noticia['id'] ?>">
        <input type="hidden" name="fotoAntigua" value="<?= htmlspecialchars($noticia['foto']) ?>">

        <label for="titulo">Título:</label>
        <input type="text" name="titulo" value="<?= htmlspecialchars($noticia['titulo']) ?>" required><br>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" rows="6" required><?= htmlspecialchars($noticia['descripcion']) ?></textarea><br>

        <label for="categoria">Categoría:</label>
        <select name="categoria" required>
            <?php foreach ($categorias as $cat): ?>
                <option value="<?= htmlspecialchars($cat) ?>" <?= $cat === $noticia['categoria'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cat) ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <?php if (!empty($noticia['foto']) && file_exists($noticia['foto'])): ?>
            <p>Imagen actual:</p>
            <img src="<?= $noticia['foto'] ?>" alt="Imagen actual" style="max-width: 200px;"><br>
        <?php endif; ?>

        <label for="foto">Cambiar imagen (opcional):</label>
        <input type="file" name="foto" accept="image/*"><br><br>

        <input type="submit" value="💾 Guardar Cambios">
    </form>
</div>
<?php require_once "partials/footer.php"; ?>
</body>
</html>
