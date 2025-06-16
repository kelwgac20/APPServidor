<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saludos</title>
</head>
<body>
    <?php
    function saludar($nombre, $hora) {
        if ($hora < 12) {
            return "<h2>Buenos días, $nombre</h2>";
        } elseif ($hora >= 12 && $hora < 20) {
            return "<h2>Buenas tardes, $nombre</h2>";
        } else {
            return "<h2>Buenas noches, $nombre</h2>";
        }
    }

    echo saludar("Juan", 15); 
    echo saludar ("María", 10);
    echo saludar ("Pedro", 22);
    echo saludar ("Ana", 18);
    

    ?>
</body>
</html>