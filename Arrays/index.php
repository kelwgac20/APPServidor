<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

<?php
$estudiantes = array(
    array(
        "nombre" => "Juan",
        "edad" => 20,
        "notas" => array(9, 8, 6)
    ),
    array(
        "nombre" => "María",
        "edad" => 22,
        "notas" => array(7, 9, 6)
    ),
    array(
        "nombre" => "Carlos",
        "edad" => 21,
        "notas" => array(8, 9, 7)
    ),
    array(
        "nombre" => "Laura",
        "edad" => 23,
        "notas" => array(6, 8, 9)
    )
);


echo "<h2>La edad de María es: </h2>" . $estudiantes[1]['edad'] . "<br>";


echo "<h2>La segunda nota de Carlos es: </h2>" . $estudiantes[2]['notas'][1] . "<br>";


echo "<h2>La media de la nota de Laura es: </h2>" . array_sum($estudiantes[3]['notas']) / count($estudiantes[3]['notas']) . "<br>";


echo "<h2>Lista de estudiantes:</h2>";
foreach ($estudiantes as $estudiante) {
    echo $estudiante['nombre'] . "<br>";
}
?>

</body>
</html>
