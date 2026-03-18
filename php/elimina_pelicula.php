<?php
require_once __DIR__ . "/lib/devuelveJson.php";
require_once __DIR__ . "/../bd/conexion.php";

// Recibimos el ID de la película que queremos borrar por la URL
$id = $_GET['id'] ?? '';

if ($id === '') {
    http_response_code(400);
    header('Content-Type: application/problem+json');
    echo json_encode(["title" => "Datos inválidos", "detail" => "Falta el ID de la película."]);
    exit;
}

try {
    // Preparamos la instrucción SQL para borrar
    $stmt = $pdo->prepare("DELETE FROM peliculas WHERE id = :id");
    $stmt->execute([':id' => $id]);
    
    devuelveJson(["mensaje" => "Película eliminada correctamente."]);

} catch (PDOException $e) {
    http_response_code(500);
    header('Content-Type: application/problem+json');
    echo json_encode(["title" => "Error interno", "detail" => "No se pudo eliminar la película."]);
    exit;
}