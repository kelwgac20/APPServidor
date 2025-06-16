<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Array Asociativo</title>
</head>

<body>

    <?php
    // Crear la agenda con 3 contactos
    $agenda = [
        "contacto1" => ["nombre" => "Juan Pérez", "telefono" => "123456789", "email" => "juan@example.com"],
        "contacto2" => ["nombre" => "María López", "telefono" => "987654321", "email" => "maria@example.com"],º
        "contacto3" => ["nombre" => "Carlos Ruiz", "telefono" => "456789123", "email" => "carlos@example.com"]
    ];

    // Mostrar los resultados iniciales
    echo "<h2>Agenda Inicial</h2>";
    foreach ($agenda as $key => $contacto) {
        echo "<p><strong>$key:</strong> Nombre: {$contacto['nombre']}, Teléfono: {$contacto['telefono']}, Email: {$contacto['email']}</p>";
    }

    // Añadir un nuevo contacto
    $agenda["contacto4"] = ["nombre" => "Ana Gómez", "telefono" => "321654987", "email" => "ana@example.com"];

    // Cambiar el teléfono del primer contacto
    $agenda["contacto1"]["telefono"] = "111222333";

    // Mostrar los resultados actualizados
    echo "<h2>Agenda Actualizada</h2>";
    foreach ($agenda as $key => $contacto) {
        echo "<p><strong>$key:</strong> Nombre: {$contacto['nombre']}, Teléfono: {$contacto['telefono']}, Email: {$contacto['email']}</p>";
    }
    ?>

</body>

</html>