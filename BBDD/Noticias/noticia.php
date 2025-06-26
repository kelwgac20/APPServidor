<?php
require_once "conexion.php";
require_once "session.php";

// Obtenemos el ID actual y la categoría (opcional)
$idActual = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$categoria = $_GET['categoria'] ?? null;

// Obtenemos la noticia actual
if ($categoria) {
    $stmt = $pdo->prepare("SELECT * FROM noticias WHERE id = ? AND categoria = ?");
    $stmt->execute([$idActual, $categoria]);
} else {
    $stmt = $pdo->prepare("SELECT * FROM noticias WHERE id = ?");
    $stmt->execute([$idActual]);
}

$noticia = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$noticia) {
    echo "<h1>Noticia no encontrada</h1>";
    exit;
}

// Siguiente noticia
if ($categoria) {
    $stmtNext = $pdo->prepare("SELECT id FROM noticias WHERE id > ? AND categoria = ? ORDER BY id ASC LIMIT 1");
    $stmtNext->execute([$idActual, $categoria]);

    $stmtPrev = $pdo->prepare("SELECT id FROM noticias WHERE id < ? AND categoria = ? ORDER BY id DESC LIMIT 1");
    $stmtPrev->execute([$idActual, $categoria]);
} else {
    $stmtNext = $pdo->prepare("SELECT id FROM noticias WHERE id > ? ORDER BY id ASC LIMIT 1");
    $stmtNext->execute([$idActual]);

    $stmtPrev = $pdo->prepare("SELECT id FROM noticias WHERE id < ? ORDER BY id DESC LIMIT 1");
    $stmtPrev->execute([$idActual]);
}

$siguiente = $stmtNext->fetchColumn();
$anterior = $stmtPrev->fetchColumn();

// Autor
$stmtAutor = $pdo->prepare("SELECT nombre FROM usuario WHERE id = ?");
$stmtAutor->execute([$noticia['user_id']]);
$autor = $stmtAutor->fetchColumn() ?: 'Desconocido';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($noticia['titulo']) ?></title>
    <link rel="stylesheet" href="CSS/styles.css">
</head>
<body>
<?php require_once "partials/header.php"; ?>

<div id="main">
    <div class="tarjeta">
        <h1><?= htmlspecialchars($noticia['titulo']) ?></h1>
        <?php if (!empty($noticia['foto']) && file_exists($noticia['foto'])): ?>
            <img src="<?= htmlspecialchars($noticia['foto']) ?>" style="max-width: 100%;">
        <?php endif; ?>
        <p><strong>Categoría:</strong> <?= htmlspecialchars($noticia['categoria']) ?></p>
        <p><strong>Fecha:</strong> <?= htmlspecialchars($noticia['fecha']) ?></p>
        <p><strong>Autor:</strong> <?= htmlspecialchars($autor) ?></p>
        <p><?= nl2br(htmlspecialchars($noticia['descripcion'])) ?></p>
    </div>

    <!-- Navegación -->
    <div style="margin-top: 2rem; display: flex; justify-content: space-between;">
        <?php if ($anterior): ?>
            <a href="noticia.php?id=<?= $anterior ?><?= $categoria ? '&categoria=' . urlencode($categoria) : '' ?>">⬅ Anterior</a>
        <?php else: ?>
            <span></span>
        <?php endif; ?>

        <?php if ($siguiente): ?>
            <a href="noticia.php?id=<?= $siguiente ?><?= $categoria ? '&categoria=' . urlencode($categoria) : '' ?>">Siguiente ➡</a>
        <?php endif; ?>
    </div>
</div>

<?php require_once "partials/footer.php"; ?>
</body>
</html>
