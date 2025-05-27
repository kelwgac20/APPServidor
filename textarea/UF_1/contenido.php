<?php
session_start();

if (!isset($_SESSION['acceso']) || $_SESSION['acceso'] !== true) {
    header("Location: inicio.php");
    exit();
}

$imagenes = [
    "https://images.unsplash.com/photo-1518717758536-85ae29035b6d",
    "https://images.unsplash.com/photo-1503023345310-bd7c1de61c7d",
    "https://images.unsplash.com/photo-1506744038136-46273834b3fb",
    "https://images.unsplash.com/photo-1526318472351-bc3aa776e0f5",
    "https://images.unsplash.com/photo-1507525428034-b723cf961d3e",
    "https://images.unsplash.com/photo-1549921296-3a6b90c3f19c",
    "https://images.unsplash.com/photo-1617007652999-ef5e2b9b2842",
    "https://images.unsplash.com/photo-1606851094547-9db47aa0f4c1"
];

$imagenAleatoria = $imagenes[array_rand($imagenes)] . "?w=400&h=300&fit=crop";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contenido Protegido</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #e6f2ff;
            text-align: center;
            padding-top: 60px;
        }

        img {
            max-width: 400px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }

        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: white;
            background-color: #dc3545;
            padding: 10px 20px;
            border-radius: 8px;
        }

        a:hover {
            background-color: #a71d2a;
        }
    </style>
</head>
<body>
    <h2>¡Bienvenido a nuestra plataforma!</h2>
    <p>Has pasado la prueba mental. Enhorabuena:</p>
    <img src="<?php echo $imagenAleatoria; ?>" alt="Imagen aleatoria">
    <br>
    <a href="inicio.php?logout=1">Cerrar sesión</a>
</body>
</html>
