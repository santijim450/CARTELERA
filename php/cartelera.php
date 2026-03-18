<?php
require_once __DIR__ . "/lib/devuelveJson.php";
require_once __DIR__ . "/../bd/conexion.php";

try {
    $stmt = $pdo->query("SELECT * FROM peliculas");
    $peliculas = $stmt->fetchAll();
    devuelveJson($peliculas);
} catch (PDOException $e) {
    http_response_code(500);
    header('Content-Type: application/problem+json');
    echo json_encode(["title" => "Error interno", "detail" => "Fallo al leer la cartelera."]);
    exit;
}