<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laberinto</title>
</head>
<body>
<?php
$laberinto = array(
    array("#", "#", "#", "#", "#"),
    array("#", ".", ".", ".", "#"),
    array("#", ".", "#", ".", "#"),
    array("#", ".", ".", ".", "#"),
    array("#", "#", "#", "#", "#")
);

$puntos = 0;

foreach ($laberinto as $fila) {
    foreach ($fila as $celda) {
        if ($celda === ".") {
            $puntos++;
        }
    }
}

echo "El número de puntos en el laberinto es: " . $puntos;
?>
</body>
</html>