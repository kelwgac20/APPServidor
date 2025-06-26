<?php
require_once "conexion.php";
require_once "session.php";

$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    try {
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $password === $user['password']) {
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['nombre'] = $user['nombre'];
            $_SESSION['email'] = $user['email'];

            header("Location: index.php");
            exit;
        } else {
            $mensaje = "Email o contraseña incorrectos.";
        }
    } catch (PDOException $e) {
        $mensaje = "Error en la base de datos: " . htmlspecialchars($e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="CSS/styles.css" />
</head>
<body>
    <h1>Iniciar Sesión</h1>

    <?php if (!empty($mensaje)): ?>
        <p style="color: red;"><?= htmlspecialchars($mensaje) ?></p>
    <?php endif; ?>

    <form action="login.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" name="email" required />
        <br />
        <label for="password">Contraseña:</label>
        <input type="password" name="password" required />
        <br />
        <input type="submit" value="Entrar" />
    </form>

    <p>¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a>.</p>
</body>
</html>
