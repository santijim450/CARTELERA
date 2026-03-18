<?php
require_once __DIR__ . "/lib/devuelveJson.php";
require_once __DIR__ . "/../bd/conexion.php";

$id = trim($_POST['id'] ?? '');
$titulo = trim($_POST['titulo'] ?? '');
$genero = trim($_POST['genero'] ?? '');

if ($id === '' || $titulo === '') {
    http_response_code(400);
    header('Content-Type: application/problem+json');
    echo json_encode(["title" => "Datos inválidos", "detail" => "El título es obligatorio."]);
    exit;
}

try {
    // Actualizamos el título y el género usando el ID
    $stmt = $pdo->prepare("UPDATE peliculas SET titulo = :titulo, genero = :genero WHERE id = :id");
    $stmt->execute([':titulo' => $titulo, ':genero' => $genero, ':id' => $id]);
    
    devuelveJson(["mensaje" => "Película actualizada con éxito."]);
} catch (PDOException $e) {
    http_response_code(500);
    header('Content-Type: application/problem+json');
    echo json_encode(["title" => "Error interno", "detail" => "No se pudo actualizar."]);
    exit;
}