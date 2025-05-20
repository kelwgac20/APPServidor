<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
function Saludo() {
    $hora = date('H'); // Hora en formato 24h (00-23)
    if ($hora >= 6 && $hora < 12) {
        $mensaje = "¡Buenos días!";
    } elseif ($hora >= 12 && $hora < 20) {
        $mensaje = "¡Buenas tardes!";
    } else {
        $mensaje = "¡Buenas noches!";
    }
    return $mensaje;
}

// Imprimir saludo
echo Saludo();
echo "<br>";

// Imprimir fecha y hora actual en formato 24h
echo "Fecha y hora (24h): " . date('Y-m-d H:i:s');
echo "<br>";

// Imprimir fecha y hora actual en formato 12h am/pm
echo "Fecha y hora (12h): " . date('Y-m-d h:i:s a');
?>
</body>
</html>