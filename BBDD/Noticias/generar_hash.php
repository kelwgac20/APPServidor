<?php
$passwordPlano = "123456"; // Cambia esto por la contraseña que desees
$hash = password_hash($passwordPlano, PASSWORD_DEFAULT);
echo $hash;
?>
