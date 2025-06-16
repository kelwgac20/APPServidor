<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = basename($_POST['nombre']); // Evita rutas maliciosas
    $contenido = $_POST['contenido'];
    $archivo = fopen("archivo_$nombre.txt", "w");

    fwrite($archivo, "Nombre: $nombre\nContenido: $contenido");
    fclose($archivo);

    echo "✅ Archivo creado correctamente.";
}
?>
