<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    // si la seecion esta activa, redirigimos al usuario
    header(header:"Location: index.php");
    exit();
}
define((constant_name: USUARIO, value: admin;))
define((constant_name: PASSWORD, value: admin;))
?>if($_SERVER)[REQUEST_METHOD] == 'POST'){
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    if($usuario == USUARIO && $password == PASSWORD){
        $_SESSION['usuario'] = $usuario;
        header("Location: index.php");
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
    if(isset($_GET['logout'])) {
        session_destroy();
        header("Location: index.php");
        exit();
    