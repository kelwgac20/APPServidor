<?php
require_once "conexion.php";
if (!isset($_GET['id']) || empty($_GET['id'])){
    header('location: index.php');
}
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM noticias WHERE id = ?");
$stmt->execute([$id]);
$noticia = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title><?php echo htmlspecialchars($noticia['titulo'] ?? 'Noticia no encontrada'); ?></title>
    <link rel="stylesheet" href="CSS/styles.css">
</head>

<body>
    <?php require_once "partials/header.php";?>
    <div id="main">
        <div class="tarjeta">
            <?php if ($noticia): ?>
                <h1><?php echo htmlspecialchars($noticia['titulo']); ?></h1>
                <small>Categoría: <?php echo htmlspecialchars($noticia['categoria']); ?> - Fecha:
                    <?php echo $noticia['fecha']; ?></small>
                <p><?php echo nl2br(htmlspecialchars($noticia['descripcion'])); ?></p>
                <small>Autor:</small>
                <p><?php echo $noticia['user_id']; ?></p>
            <?php else: ?>
                <p>❌ Noticia no encontrada.</p>
            <?php endif; ?>
            <a href="index.php">← Volver</a>
            <a href="eliminar_noticia.php?id=<?PHP echo $id;?>" onclick="return confirm('Esto eliminará definitivamente la noticia ¿Quieres continuar?')">❌ Eliminar noticia</a>
        </div>
        <div id="form" class="tarjeta">
            <h1>EDITAR NOTICIA</h1>
            <form action="editar_noticia.php" method="POST">
                <label for="titulo">Título de la noticia:</label>
                <input type="text" name="titulo" id="titulo" value="<?php echo $noticia['titulo']; ?>">
                <span class="error">* </span>
                <br>
                <label for="user_id">Autor:</label>
                <input type="number" name="user_id" id="user_id" value="3" readonly>
                <span class="error">* </span>
                <br>
                <label for="categoria">Categoría:</label>
                <select name="categoria" id="categoria">
                    <?php
                    try {
                    $stmt = $pdo->prepare("SELECT DISTINCT categoria FROM noticias");
                    $stmt->execute();
                    $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $selected = "";
                    foreach ($categorias as $categoriaBD){
                        if ($categoriaBD == $noticia['categoria']){
                            $selected = "selected";
                        }
                        echo "<option value='".$categoriaBD['categoria']."' $selected>".$categoriaBD['categoria']."</option>";
                    }
                    }catch(Exception $e){
                        echo $e;
                    }
                    ?>
                </select>
                <br>
                <label for="descripcion">Descripcion:</label>
                <textarea name="descripcion" id="descripcion" placeholder="Contenido de la noticia">
                    <?php echo $noticia['descripcion']; ?>
                </textarea>
                <input type="hidden" name="id" value="<?= $noticia['id']; ?>">
                <span class="error">* </span>
                <br><br>
                <input type="submit" value="Enviar">
            </form>
        </div>
    </div>
    <?php require_once "partials/footer.php";?>
</body>

</html>