<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Piramides</title>
</head>
<body>
<?php
// Número de filas de la pirámide

// Bucle para generar la pirámide
for ($i = 4; $i > 0; $i--) {
	for ($j = 0; $j < $i; $j++) {
		echo "*";
	}
	echo "<br>";
}
?>
</body>
</html>



