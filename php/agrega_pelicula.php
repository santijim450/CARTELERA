<?php
require_once __DIR__ . "/lib/devuelveJson.php";
require_once __DIR__ . "/../bd/conexion.php";

$titulo = trim($_POST['titulo'] ?? '');
$genero = trim($_POST['genero'] ?? 'Variado');
$imagen = trim($_POST['imagen'] ?? ''); // Recibimos la URL de la imagen

if ($titulo === '') {
    http_response_code(400);
    header('Content-Type: application/problem+json');
    echo json_encode(["title" => "Datos inválidos", "detail" => "El título es obligatorio."]);
    exit;
}

try {
    // Insertamos también la imagen
    $stmt = $pdo->prepare("INSERT INTO peliculas (titulo, genero, imagen) VALUES (:titulo, :genero, :imagen)");
    $stmt->execute([':titulo' => $titulo, ':genero' => $genero, ':imagen' => $imagen]);
    
    devuelveJson(["mensaje" => "Película '$titulo' guardada en tu colección."]);
} catch (PDOException $e) {
    http_response_code(500);
    header('Content-Type: application/problem+json');
    echo json_encode(["title" => "Error interno", "detail" => $e->getMessage()]);
    exit;
}