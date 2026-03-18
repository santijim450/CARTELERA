<?php
require_once __DIR__ . "/lib/devuelveJson.php";
require_once __DIR__ . "/../bd/conexion.php";

$id = $_GET['id'] ?? '';

if ($id === '') {
    http_response_code(400);
    header('Content-Type: application/problem+json');
    echo json_encode(["title" => "Error", "detail" => "Falta el ID."]);
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT * FROM peliculas WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $pelicula = $stmt->fetch();

    if (!$pelicula) {
        http_response_code(404);
        header('Content-Type: application/problem+json');
        echo json_encode(["title" => "No encontrado", "detail" => "La película no existe."]);
        exit;
    }

    devuelveJson($pelicula);
} catch (PDOException $e) {
    http_response_code(500);
    header('Content-Type: application/problem+json');
    echo json_encode(["title" => "Error", "detail" => "Fallo al conectar a BD."]);
    exit;
}