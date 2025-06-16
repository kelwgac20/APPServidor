<?php
 
       function validator($data) {
           $data = trim($data);
           $data = stripslashes($data);
           $data = htmlspecialchars($data);
           return $data;
       }
$nombre=validator($_POST["nombre"]);
$apellido=validator($_POST["apellido"]);
$textarea=validator($_POST["textarea"]);
 
echo "$nombre <br>$apellido <br>".nl2br($textarea);