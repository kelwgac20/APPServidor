<?php
require "conexion.php";
if (!isset($_GET['id']) || empty($_GET['id'])){
    header('location: index.php');
}
try {
    $id = intval($_GET['id']);
    $stmt = $pdo->prepare("DELETE FROM noticias WHERE id = ?");
    $stmt->execute([$id]);
    header('location: index.php');
}catch(Exception $e){
    http_response_code(500);
    header('location: noticia.php?id='.$id.'&error=true');
}