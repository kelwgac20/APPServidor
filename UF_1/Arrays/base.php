<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    //crear array
    $colores = array("rojo", "verde", "azul", "amarillo", "morado", "naranja", "rosa",);
    //accedemos a verde
    echo $colores[1] . "<br>";
    // modificamos el verde por el amarillo
    $colores[1] = "amarillo";
    // añadir
    $colores[] = "morado";

    //eliminanos rojo
    array_splice($colores, offset: 0, length: 0);
    print_r(value: $colores);

    ?>
</body>

</html>