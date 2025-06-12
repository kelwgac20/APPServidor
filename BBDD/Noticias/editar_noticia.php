<?php
require_once "conexion.php";

$titulo = $user_id = $categoria = $descripcion = $insertaSuccess = $id = "";
$errorGenerl = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (!isset($_POST["id"]) || empty($_POST["id"])) {

        http_response_code(400); // Faltan parámetros.
       
        $errorGenerl = true;
        echo 1;
    } else {
        /*  if (!preg_match("/^[a-zA-Z-' ]*$/", $titulo)) {
            $nombreErr = "Introduce solo letras mayúsculas o minúsculas";
        }*/
        $id = test_input($_POST["id"]);
    }
    if (!isset($_POST["titulo"]) || empty($_POST["titulo"])) {

        http_response_code(400); // Faltan parámetros.
       echo 2;
        $errorGenerl = true;
    } else {
        /*  if (!preg_match("/^[a-zA-Z-' ]*$/", $titulo)) {
            $nombreErr = "Introduce solo letras mayúsculas o minúsculas";
        }*/
        $titulo = test_input($_POST["titulo"]);
    }
    if (!isset($_POST["user_id"]) || empty($_POST["user_id"])) {
       echo 3;
        $errorGenerl = true;
    } else {
        /*    if (!filter_var($user_id, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Tienes que introducir un email válido";
        }*/
        $user_id = test_input($_POST["user_id"]);
    }

    if (!isset($_POST["categoria"]) || empty($_POST["categoria"])) {
       echo 4;
        $errorGenerl = true;
    } else {
        /*    if (!filter_var($categoria, FILTER_VALIDATE_URL)) {
            $categoriaErr = "Tienes que introducir una categoria válido";
        }*/
        $categoria = test_input($_POST["categoria"]);
    }
    if (!isset($_POST["descripcion"]) || empty($_POST["descripcion"])) {
      echo 5;
        $errorGenerl = true;
    } else {
        /*   if (!filter_var($enlace, FILTER_VALIDATE_URL)) {
            $descripcionErr = "Tienes que introducir un descripcion válido";
        }*/
        $descripcion = test_input($_POST["descripcion"]);
    }


    if (!$errorGenerl) {
        try {
            $query = "UPDATE noticias SET titulo = ?, descripcion = ?, categoria = ?, user_id = ? 
                        WHERE 
                        id = ?
                     ";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$titulo, $descripcion, $categoria, $user_id, $id]);
            // Variable declarada al principio como "
            $titulo = $user_id = $categoria = $descripcion = "";
        } catch (Exception $e) {
            // Variable declarada al principio como ""
            echo $e;
            $errorGenerl = true;
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
<html>

<head>
    <meta charset="utf-8">
    <title><?php echo htmlspecialchars($noticia['titulo'] ?? 'Noticia no encontrada'); ?></title>
    <link rel="stylesheet" href="CSS/styles.css">
</head>

<body>
    <?php require_once "partials/header.php";?>
<?php 
    if (!$errorGenerl) { 
        echo "<h1 style='color:green'>Noticia modificada con éxito</h1>";
        sleep(4);
        header( 'loction: noticia.php?id=' .$id);
        echo "<br><a href='noticia.php?id=$id'>Ir a la noticia</a>";

    } else {
        echo "<h1 style='color:green'>Hubio algún error en los datos, vuelva a la noticia para editar";
  
        echo "<a href='#' onclick='javascript:history.back()' style='display:none'>Ir a la noticia</a>";
    }


?>
       
<?php require_once "partials/header.php";?>
</body>

</html>