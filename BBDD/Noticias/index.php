<?php
require_once "conexion.php";

$stmt = $pdo->query("SELECT * FROM noticias ORDER BY fecha DESC");
$noticias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
   <!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <title>Listado de noticias</title>
    <link rel="stylesheet" href="CSS/styles.css">
</head>
<body>
    <?php require_once "partials/header.php";?>
   <h1>Últimas noticias</h1>
   <?php foreach ($noticias as $noticia): ?>
       <div class="noticia">
           <h2><?= htmlspecialchars($noticia['titulo']) ?></h2>
           <small>Categoría: 
            <?= htmlspecialchars($noticia['categoria']) ?> 
           | Fecha: 
           <?= $noticia['fecha'] ?></small><br>
           <a href="noticia.php?id=<?= $noticia['id'] ?>">Ver más</a>
       </div>
   <?php endforeach; ?>
   <?php require_once "partials/footer.php";?>
</body>
</html>