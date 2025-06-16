<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Foreach Nombres</title>
</head>

<body>
    <?php
    $nombres = array("Aneudys", "Matthews", "Santos", "Antonio", "Andres", "Domingo", "Santiago", "Margarita", "Jose", "Luis", "Maria", "Ana");
    $variable = 1;
    foreach ($nombres as $nombre) {
        $nombreEnMinuscula = strtolower($nombre);
        if ($nombreEnMinuscula[0] == "a") {
            echo "<h1>Bienvenid@ $nombre $variable";
        }
    }

    // con bucle for
    ?>
    <h1>Lo mismo con bucle for</h1>

    <?php
        for ($i = 0; $i < count($nombres); $i++) {
            $nombre = $nombres[$i];
            if (strtolower($nombre[0]) == "a") {
             echo "<h2>Bienvenido $nombre</h2>";
            }
        }
    ?>


</body>

</html>