<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    // Declarar variables globales
    $nombre = "Maximiliano";
    $apellido = "González";
    $edad = 45;
    $ciudadNatal = "Republica Dominicana";

    // Función para imprimir los valores de las variables
    function imprimirInformacion()
    {
        global $nombre, $apellido, $edad, $ciudadNatal;
        echo "<h1>Hola, $nombre $apellido</h1>";
        echo "<h2>Tu edad: $edad</h2>";
        echo "<h2>Ciudad natal: $ciudadNatal</h2>";
    }

    // Llamar a la función para mostrar la información
    imprimirInformacion();
    ?>
</body>

</html>