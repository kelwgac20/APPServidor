<?php
session_start();

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: inicio.php");
    exit();
}

if (isset($_SESSION['acceso']) && $_SESSION['acceso'] === true) {
    header("Location: contenido.php");
    exit();
}

if (!isset($_SESSION['n1']) || !isset($_SESSION['n2'])) {
    $_SESSION['n1'] = rand(1, 10);
    $_SESSION['n2'] = rand(1, 10);
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $respuesta = $_POST['captcha'] ?? '';
    $correcta = $_SESSION['n1'] + $_SESSION['n2'];

    if (trim($respuesta) == $correcta) {
        $_SESSION['acceso'] = true;
        header("Location: contenido.php");
        exit();
    } else {
        $error = "Respuesta incorrecta. Intenta de nuevo.";
        $_SESSION['n1'] = rand(1, 10);
        $_SESSION['n2'] = rand(1, 10);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login Humano</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f9f9f9;
            text-align: center;
            padding-top: 60px;
        }

        form {
            display: inline-block;
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        label {
            display: block;
            font-size: 1.2em;
            margin-bottom: 10px;
        }

        input[type="text"] {
            padding: 8px;
            width: 100px;
            font-size: 1em;
            margin-bottom: 15px;
        }

        button {
            padding: 8px 20px;
            font-size: 1em;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        p {
            color: red;
        }
    </style>
</head>
<body>
    <form method="POST" action="inicio.php">
        <h2>Verificación Humana</h2>
        <?php if ($error): ?>
            <p><?php echo $error; ?></p>
        <?php endif; ?>
        <label for="captcha">
            ¿Cuánto es <?php echo $_SESSION['n1']; ?> + <?php echo $_SESSION['n2']; ?>?
        </label>
        <input type="text" name="captcha" id="captcha" required>
        <br>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>
