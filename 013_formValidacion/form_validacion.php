<?php
// Variables para almacenar los errores y los valores del formulario
$nameErr = $emailErr = $urlErr = $commentErr = $coursesErr = "";
$name = $email = $url = $comment = "";
$courses = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Validar nombre
    if (empty($_POST["name"])) {
        $nameErr = "El nombre es obligatorio";
    } else {
        $name = test_input($_POST["name"]);
    }

    // Validar email
    if (empty($_POST["email"])) {
        $emailErr = "El email es obligatorio";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Formato de email inválido";
        }
    }

    // Validar URL
    if (empty($_POST["url"])) {
        $urlErr = "La URL es obligatoria";
    } else {
        $url = test_input($_POST["url"]);
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            $urlErr = "Formato de URL inválido";
        }
    }

    // Validar comentario (textarea)
    if (empty($_POST["comment"])) {
        $commentErr = "El comentario no puede estar vacío";
    } else {
        $comment = test_input($_POST["comment"]);
    }

    // Validar cursos (checkboxes)
    if (empty($_POST["courses"])) {
        $coursesErr = "Selecciona al menos un curso";
    } else {
        $courses = $_POST["courses"];
    }
}

// Función para limpiar los datos del formulario
function test_input($data) {
    $data = trim($data);          // Elimina espacios
    $data = stripslashes($data);  // Elimina barras invertidas
    $data = htmlspecialchars($data); // Convierte caracteres especiales en HTML
    return $data;
}
?>
