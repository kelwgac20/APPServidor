<?php
// ... (código anterior)

// Lógica del sorteo
if (isset($_POST['sortear']) && count($concursantes) > 0) {
    $cantidadPremios = intval($_POST['cantidad_premios']);
    if ($cantidadPremios > 0 && $cantidadPremios <= count($concursantes)) {
        // Seleccionar ganadores aleatorios sin repetir
        $indices = array_rand($concursantes, $cantidadPremios);
        $ganadores = [];
        echo "<h3>Ganadores del Sorteo</h3><ol>";
        if (is_array($indices)) {
            foreach ($indices as $i) {
                $ganador = $concursantes[$i];
                $ganadores[] = $ganador;
                echo "<li>" . htmlspecialchars($ganador) . "</li>";
            }
        } else {
            // Solo un ganador
            $ganador = $concursantes[$indices];
            $ganadores[] = $ganador;
            echo "<li>" . htmlspecialchars($ganador) . "</li>";
        }
        echo "</ol>";

        // Guardar ganadores en archivo
        $archivoGanadores = "ganadores.txt";
        $contenido = "Ganadores del sorteo (" . date("Y-m-d H:i:s") . "):\n";
        foreach ($ganadores as $g) {
            $contenido .= $g . "\n";
        }
        $contenido .= "\n";
        file_put_contents($archivoGanadores, $contenido, FILE_APPEND);
    } else {
        echo "<p style='color:red;'>Cantidad de premios inválida.</p>";
    }
}
// ... (código posterior)
?>
s