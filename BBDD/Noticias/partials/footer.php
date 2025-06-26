<?php
session_start(); // Asegura que haya sesión activa
$nombreUsuario = $_SESSION['nombre'] ?? null;

// Categorías dinámicas (si quieres incluirlas en el footer también)
require_once "conexion.php";
$stmt = $pdo->query("SELECT DISTINCT categoria FROM noticias ORDER BY categoria ASC");
$categoriasFooter = $stmt->fetchAll(PDO::FETCH_COLUMN);
?>

<footer style="background-color: #2c3e50; color: white; padding: 1rem; text-align: center;">
    <div style="margin-bottom: 0.5rem;">
        <a href="index.php" style="color: #ecf0f1; margin: 0 1rem; text-decoration: none;">Inicio</a>

        <?php if ($nombreUsuario): ?>
            <a href="anadir_noticia.php" style="color: #ecf0f1; margin: 0 1rem; text-decoration: none;">➕ Añadir Noticias</a>
        <?php endif; ?>

        <?php foreach ($categoriasFooter as $cat): ?>
            <a href="index.php?categoria=<?= urlencode($cat) ?>" style="color: #ecf0f1; margin: 0 1rem; text-decoration: none;">
                <?= htmlspecialchars($cat) ?>
            </a>
        <?php endforeach; ?>
    </div>

    <div style="font-size: 0.9rem;">
        &copy; 2025 Max Design_Studio
        <?php if ($nombreUsuario): ?>
            — 👤 <?= htmlspecialchars($nombreUsuario) ?>
        <?php endif; ?>
    </div>
</footer>
