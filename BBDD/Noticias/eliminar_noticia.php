<?php
// --- Inclusión de dependencias ---
// Incluye funciones auxiliares y la conexión a la base de datos.
require_once "functions.php";
require "conexion.php";
require_once "session.php";


// --- Validación del parámetro 'id' ---
// Si no se recibe el parámetro 'id' por GET, redirige al listado principal.
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('location: index.php');
}

// --- Intento de borrado de la noticia ---
try {
    // Convierte el id recibido a entero para mayor seguridad.
    $id = intval($_GET['id']);
    // Prepara y ejecuta la consulta para borrar la noticia con ese id.
    $stmt = $pdo->prepare("DELETE FROM noticias WHERE id = ?");
    $stmt->execute([$id]);
    // Si se recibe la ruta de la foto por GET, la elimina del servidor.
    if (isset($_GET['foto']) && !empty($_GET['foto'])) {
        unlink($_GET['foto']);
    }
    // Redirige al listado principal tras borrar.
    header('location: index.php');
} catch (Exception $e) {
    // Si ocurre un error, responde con código 500 y redirige a la noticia con mensaje de error.
    http_response_code(500);
    header('location: noticia.php?id=' . $id . '&error=true');