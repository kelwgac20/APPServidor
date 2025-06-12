<?php
// INI
$host = "localhost";
$user = "kelwgac20";
$password = "24Rachid0204";
$database = "cursonascor";
// Conexión
try {
  $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8mb4", $user, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die(" Error de conexión: " . $e->getMessage());
}

?>

