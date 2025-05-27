<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

    $archivos = scandir('.');
 
foreach($archivos as $archivo){
    if (str_replace(".php", "", $archivo) != $archivo)
    echo "<br><a href='$archivo'>$archivo</a>";
}
    // Crear un array de estudiantes con sus datos
    $estudiantes = array(
        array("nombre" => "Ana", "edad" => 20, "nota" => 6.5),
        array("nombre" => "Luis", "edad" => 22, "nota" => 4.8),
        array("nombre" => "María", "edad" => 19, "nota" => 7.2),
        array("nombre" => "Pedro", "edad" => 21, "nota" => 5.0),
        array("nombre" => "Lucía", "edad" => 20, "nota" => 3.9)
    );

    // Mostrar la lista completa de estudiantes
    echo "<h2>Lista de Estudiantes</h2>";
    echo "<ul>";
    foreach ($estudiantes as $estudiante) {
        echo "<li>Nombre: {$estudiante['nombre']}, Edad: {$estudiante['edad']}, Nota: {$estudiante['nota']}</li>";
    }
    echo "</ul>";

    // Mostrar los nombres de los estudiantes que han aprobado
    echo "<h2>Estudiantes Aprobados</h2>";
    echo "<ul>";
    foreach ($estudiantes as $estudiante) {
        if ($estudiante['nota'] >= 5) {
            echo "<li>{$estudiante['nombre']}</li>";
        }
    }
    echo "</ul>";

    // Calcular y mostrar la nota más alta y la más baja
    $notas = array_column($estudiantes, 'nota');
    $nota_maxima = max($notas);
    $nota_minima = min($notas);

    echo "<h2>Notas</h2>";
    echo "<p>Nota más alta: $nota_maxima</p>";
    echo "<p>Nota más baja: $nota_minima</p>";
    ?>
</body>
</html>