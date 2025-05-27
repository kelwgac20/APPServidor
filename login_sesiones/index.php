<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Iniciar Seccion</h1>
    <form action="login.php" method="POST">
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" required>
        <br>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Iniciar Sesion</button>
       
       <?php
       session_start();
       if (isset($_get[logout])) {
             session_destroy();
              header(header "Location: index.php");
           else             ;          
              
              
         if (isset($_SESSION['error'])) {
            echo "<h1>Bienvenido a mi plataforma</h1>
              echo "<p style='color:red;'>".$_SESSION['error']."</p>";
              unset($_SESSION['error']);
         }
        
        ?>
</body>
</html>