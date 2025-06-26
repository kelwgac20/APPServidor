<?php
session_start();

function isLoggedIn() {
    return isset($_SESSION['usuario_id']);
}

function getUserId() {
    return $_SESSION['usuario_id'] ?? null;
}

function getUserEmail() {
    return $_SESSION['usuario'] ?? null;
}

function getUserName() {
    return $_SESSION['nombre'] ?? null;
}
?>
