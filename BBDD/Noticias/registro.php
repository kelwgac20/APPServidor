<?php
require_once "conexion.php";
require_once "session.php";

$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!$nombre || !$email || !$password) {
        $mensaje = "Por favor completa todos los campos.";
    } else {
        try {
            // Verificar si el email ya existe
            $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->fetch()) {
                $mensaje = "El email ya está registrado.";
            } else {
                // Insertar usuario, creacion con NOW()
                $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, email, password, creacion) VALUES (?, ?, ?, NOW())");
                $stmt->execute([$nombre, $email, $password]);
                $mensaje = "Registro exitoso. Ahora puedes iniciar sesión.";
            }
        } catch (PDOException $e) {
            $mensaje = "Error en la base de datos: " . htmlspecialchars($e->getMessage());
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="CSS/styles.css" />
</head>
<body>
    <h1>Registro de Usuario</h1>
    <?php if (!empty($mensaje)): ?>
        <p style="color: red;"><?= htmlspecialchars($mensaje) ?></p>
    <?php endif; ?>
    <form action="registro.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required />
        <br />
        <label for="email">Email:</label>
        <input type="email" name="email" required />
        <br />
        <label for="password">Contraseña:</label>
        <input type="password" name="password" required />
        <br />
        <input type="submit" value="Registrarse" />
    </form>
    <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a>.</p>
</body>
</html>
