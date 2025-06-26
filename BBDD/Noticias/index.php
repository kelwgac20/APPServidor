<?php
require_once "conexion.php";
require_once "session.php";

// Parámetros de paginación
$noticiasPorPagina = 1;
$pagina = isset($_GET['pagina']) ? max(1, (int)$_GET['pagina']) : 1;
$offset = ($pagina - 1) * $noticiasPorPagina;

// Filtro por categoría (opcional)
$categoriaSeleccionada = $_GET['categoria'] ?? '';

// Contar total de noticias
if ($categoriaSeleccionada) {
    $stmtTotal = $pdo->prepare("SELECT COUNT(*) FROM noticias WHERE categoria = ?");
    $stmtTotal->execute([$categoriaSeleccionada]);
} else {
    $stmtTotal = $pdo->query("SELECT COUNT(*) FROM noticias");
}
$totalNoticias = $stmtTotal->fetchColumn();
$totalPaginas = ceil($totalNoticias / $noticiasPorPagina);

// Obtener noticia actual
if ($categoriaSeleccionada) {
    $stmt = $pdo->prepare("SELECT n.*, u.nombre 
                           FROM noticias n
                           LEFT JOIN usuarios u ON n.user_id = u.id
                           WHERE n.categoria = ?
                           ORDER BY fecha DESC
                           LIMIT $noticiasPorPagina OFFSET $offset");
    $stmt->execute([$categoriaSeleccionada]);
} else {
    $stmt = $pdo->query("SELECT n.*, u.nombre 
                         FROM noticias n
                         LEFT JOIN usuarios u ON n.user_id = u.id
                         ORDER BY fecha DESC
                         LIMIT $noticiasPorPagina OFFSET $offset");
}
$noticias = $stmt->fetchAll(PDO::FETCH_ASSOC);
$usuarioActualId = $_SESSION['usuario_id'] ?? null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Noticias</title>
    <link rel="stylesheet" href="CSS/styles.css">
</head>
<body>
<?php require_once "partials/header.php"; ?>
<div id="main">
    <h1>Últimas noticias<?= $categoriaSeleccionada ? " de " . htmlspecialchars($categoriaSeleccionada) : "" ?></h1>

    <?php if (!empty($noticias)): ?>
        <?php foreach ($noticias as $noticia): ?>
            <div class="tarjeta">
                <h2><?= htmlspecialchars($noticia['titulo']) ?></h2>
                <?php if (!empty($noticia['foto']) && file_exists($noticia['foto'])): ?>
                    <img src="<?= htmlspecialchars($noticia['foto']) ?>" alt="Imagen noticia" style="max-width: 300px">
                <?php endif; ?>
                <p><?= nl2br(htmlspecialchars($noticia['descripcion'])) ?></p>
                <small>
                    <strong>Autor:</strong> <?= htmlspecialchars($noticia['nombre'] ?? 'Desconocido') ?> |
                    <strong>Categoría:</strong> <?= htmlspecialchars($noticia['categoria']) ?> |
                    <strong>Fecha:</strong> <?= $noticia['fecha'] ?>
                </small>
                <br>

                <!-- Mostrar botones si el usuario es el autor -->
                <?php if ($usuarioActualId && $usuarioActualId == $noticia['user_id']): ?>
                    <a href="editar_noticia.php?id=<?= $noticia['id'] ?>">✏️ Editar</a> |
                    <a href="eliminar_noticia.php?id=<?= $noticia['id'] ?>&foto=<?= urlencode($noticia['foto']) ?>"
                       onclick="return confirm('¿Estás seguro de eliminar esta noticia?')">❌ Eliminar</a>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>

        <!-- Navegación entre noticias -->
        <div style="margin-top: 20px; display: flex; justify-content: space-between;">
            <?php if ($pagina > 1): ?>
                <a href="?pagina=<?= $pagina - 1 ?>&categoria=<?= urlencode($categoriaSeleccionada) ?>">⬅ Anterior</a>
            <?php else: ?>
                <span></span>
            <?php endif; ?>

            <?php if ($pagina < $totalPaginas): ?>
                <a href="?pagina=<?= $pagina + 1 ?>&categoria=<?= urlencode($categoriaSeleccionada) ?>">Siguiente ➡</a>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <p>No se encontraron noticias.</p>
    <?php endif; ?>
</div>
<?php require_once "partials/footer.php"; ?>
</body>
</html>
