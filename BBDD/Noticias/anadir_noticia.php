<?php
require_once "conexion.php";

$tituloErr = $user_idErr = $categoriaErr = $descripcionErr = $insertaErr = "";

$titulo = $user_id = $categoria = $descripcion = $insertaSuccess = "";
$otra = "";
$errorGenerl = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_POST["titulo"]) || empty($_POST["titulo"])) {

        http_response_code(400); // Faltan parámetros.
        $tituloErr = "Tienes que introducir un nombre";
        $errorGenerl = true;
    } else {
        /*  if (!preg_match("/^[a-zA-Z-' ]*$/", $titulo)) {
            $nombreErr = "Introduce solo letras mayúsculas o minúsculas";
        }*/
        $titulo = test_input($_POST["titulo"]);
    }
    if (!isset($_POST["user_id"]) || empty($_POST["user_id"])) {
        $user_idErr = "Tienes que introducir un user_id";
        $errorGenerl = true;
    } else {
        /*    if (!filter_var($user_id, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Tienes que introducir un email válido";
        }*/
        $user_id = test_input($_POST["user_id"]);
    }

    if (!isset($_POST["categoria"]) || empty($_POST["categoria"])) {
        $categoriaErr = "Tienes que introducir una categoria";
        $errorGenerl = true;
    } else {
        /*    if (!filter_var($categoria, FILTER_VALIDATE_URL)) {
            $categoriaErr = "Tienes que introducir una categoria válido";
        }*/
        $categoria = test_input($_POST["categoria"]);
    }
    if (!isset($_POST["descripcion"]) || empty($_POST["descripcion"])) {
        $textareErr = "Tienes que introducir algún texto";
        $errorGenerl = true;
    } else {
        /*   if (!filter_var($enlace, FILTER_VALIDATE_URL)) {
            $descripcionErr = "Tienes que introducir un descripcion válido";
        }*/
        $descripcion = test_input($_POST["descripcion"]);
    }

    /*if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
    } else {
        $gender = test_input($_POST["gender"]);
    11}*/
    if (!$errorGenerl) {
        try {

            $stmt = $pdo->prepare(
                "INSERT INTO noticias (titulo, descripcion, categoria, user_id) 
        VALUES (?, ?, ?, ?)"
            );
            $stmt->execute([$titulo, $descripcion, $categoria, $user_id]);
            // Variable declarada al principio como ""
            $insertaSuccess = "Noticia insertada con éxito";
            $otra = "OTRA";
            $titulo = $user_id = $categoria = $descripcion = "";
        } catch (Exception $e) {
            // Variable declarada al principio como ""
            $insertaErr = "No se ha podido ingresar la noticia en la BBDD " . $e;
        }
    }
}
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    /*if ($tipo === "email")*/
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Noticia</title>
    <link rel="stylesheet" href="CSS/styles.css">
</head>

<body>
    <?php require_once "partials/header.php";?>
    <div id="main">
        <h1 class="success"><?= $insertaSuccess ?></h1>
        <h1 class="error"><?= $insertaErr ?></h1>
        <h1>AÑADIR <?= $otra ?> NOTICIA</h1>
        <form action="anadir_noticia.php" method="POST">

            <label for="titulo">Título de la noticia:</label>
            <input type="text" name="titulo" id="titulo" value="<?php echo $titulo; ?>">
            <span class="error">* <?php echo $tituloErr; ?></span>
            <br>
            <label for="user_id">Autor:</label>
            <input type="number" name="user_id" id="user_id" value="3" readonly>
            <span class="error">* <?php echo $user_idErr; ?></span>
            <br>
            <label for="categoria">Categoría:</label>
            <select name="categoria" id="categoria">
                <option value="Noticias">Noticias</option>
                <option value="Curiosidades">Curiosidades</option>
                <option value="Deportes">Deportes</option>
            </select>
            <br>
            <label for="descripcion">Descripcion:</label>
            <textarea name="descripcion" id="descripcion" placeholder="Contenido de la noticia">
            <?php echo $descripcion; ?>
        </textarea>
            <span class="error">* <?php echo $descripcionErr; ?></span>
            <br><br>
            <input type="submit" value="Enviar">
        </form>
    </div>
    <?php require_once "partials/footer.php";?>
</body>

</html>