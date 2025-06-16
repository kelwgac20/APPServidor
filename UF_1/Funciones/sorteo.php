<?php
// Definir array con los nombres de los participantes
$archivos = scandir('.');

foreach ($archivos as $archivo) {
    if (str_replace(".php", "", $archivo) != $archivo)
        echo "<br><a href='$archivo'>$archivo</a>";
}

$participantes = [
    "Ana",
    "Luis",
    "Carlos",
    "María",
    "Jorge",
    "Sofía",
    "Pedro",
    "Lucía",
    "Miguel",
    "Elena"
];

// Definir la cantidad de premios
$cantidadPremios = 3;

// Función para generar un array aleatorio con los índices de los ganadores
function generarGanadores($cantidadPremios, $participantes)
{
    $ganadores = [];
    $totalParticipantes = count($participantes);

    while (count($ganadores) < $cantidadPremios) {
        $indiceAleatorio = rand(0, $totalParticipantes - 1);
        if (!in_array($indiceAleatorio, $ganadores)) {
            $ganadores[] = $indiceAleatorio;
        }
    }

    return $ganadores;
}

// Llamar a la función para obtener los índices de los ganadores
$indicesGanadores = generarGanadores($cantidadPremios, $participantes);

// Mostrar los nombres de los ganadores
echo "<h1>Ganadores del Sorteo</h1>";
echo "<ol>";
foreach ($indicesGanadores as $indice) {
    echo "<li>" . $participantes[$indice] . "</li>";
}
echo "</ol>";
