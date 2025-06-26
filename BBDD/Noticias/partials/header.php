<?php
session_start(); // Asegúrate de que la sesión esté activa

require_once __DIR__ . '/../conexion.php';

// Obtener nombre del usuario si está logueado
$nombreUsuario = $_SESSION['nombre'] ?? null;

// Obtener categorías para el menú
$stmt = $pdo->query("SELECT DISTINCT categoria FROM noticias ORDER BY categoria ASC");
$categoriasMenu = $stmt->fetchAll(PDO::FETCH_COLUMN);
?>

<header>
    <nav style="padding: 1rem 2rem; background-color: #2c3e50; color: white; display: flex; gap: 2rem; align-items: center; justify-content: space-between;">
        <div style="display: flex; gap: 2rem; align-items: center;">
            <a href="index.php" style="color: white; text-decoration: none;">Inicio</a>

            <?php if ($nombreUsuario): ?>
                <a href="anadir_noticia.php" style="color: white; text-decoration: none;">➕ Añadir noticia</a>
            <?php endif; ?>

            <div class="dropdown" style="position: relative;">
                <button class="dropdown-toggle" style="background: none; border: none; color: white; cursor: pointer; font-weight: 500;">Categorías ▼</button>
                <div class="dropdown-content" style="display: none; position: absolute; top: 100%; left: 0; background: white; min-width: 180px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2); z-index: 999;">
                    <a href="index.php" style="display: block; padding: 10px 15px; text-decoration: none; color: #2c3e50;">Todas</a>
                    <?php foreach ($categoriasMenu as $cat): ?>
                        <a href="index.php?categoria=<?= urlencode($cat) ?>" style="display: block; padding: 10px 15px; text-decoration: none; color: #2c3e50;"><?= htmlspecialchars($cat) ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Usuario conectado -->
        <div>
            <?php if ($nombreUsuario): ?>
                <span style="margin-right: 1rem;">👤 <?= htmlspecialchars($nombreUsuario) ?></span>
                <a href="logout.php" style="color: #ecf0f1; text-decoration: underline;">Cerrar sesión</a>
            <?php else: ?>
                <a href="login.php" style="color: white; text-decoration: underline;">Iniciar sesión</a>
            <?php endif; ?>
        </div>
    </nav>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggle = document.querySelector('.dropdown-toggle');
            const content = document.querySelector('.dropdown-content');

            toggle.addEventListener('click', () => {
                content.style.display = content.style.display === 'block' ? 'none' : 'block';
            });

            document.addEventListener('click', (e) => {
                if (!e.target.closest('.dropdown')) {
                    content.style.display = 'none';
                }
            });
        });
    </script>
</header>
