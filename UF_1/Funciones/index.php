<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sorteo</title>
</head>
<body>
    <?php
$archivos = scandir('.');

foreach($archivos as $archivo){
    // Verifica si el archivo tiene extensión .php
    if (pathinfo($archivo, PATHINFO_EXTENSION) === 'php') {
        echo "<form action='$archivo' method='get' style='display:inline-block; margin: 5px;'>
                <button type='submit' style='padding:10px 20px; background-color:#007BFF; color:white; border:none; border-radius:5px; cursor:pointer;'>
                    $archivo
                </button>
              </form>";
    }
}
?>

</body>
</html>