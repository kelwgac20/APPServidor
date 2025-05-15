<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Variables php Basico</title>
</head>

<body>

    <?php
    // Declaración de variables
    $nombre = "Aneudys";
    $apellido = "Matthews";
    $edad = 45;
    $ciudadNatal = "Santo Domingo";

    echo "Me llamo <b>$nombre $apellido</b>, <br 
    tengo <b> $edad </b> años, <br>
     y soy de <b> $ciudadNatal</b>.
     ";

    ?>
    <hr>
    <h10>Variables entre el HTML</h10>
    hola, me llamo <?php echo $nombre; ?>, tengo <?php echo $edad; ?> años y soy de 
</body>

</html>