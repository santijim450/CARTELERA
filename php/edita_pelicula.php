<?php
require_once __DIR__ . "/lib/devuelveJson.php";
require_once __DIR__ . "/lib/recibeJson.php";
require_once __DIR__ . "/../bd/conexion.php";

try {
    $datos = recibeJson();

    $id = trim($datos->id ?? '');
    $titulo = trim($datos->titulo ?? '');
    $genero = trim($datos->genero ?? '');

    if ($id === '' || $titulo === '') {
        http_response_code(400);
        header('Content-Type: application/problem+json; charset=utf-8');
        echo json_encode([
            "status" => 400,
            "title" => "Datos inválidos", 
            "detail" => "El título es obligatorio.",
            "type" => "/errors/faltatitulo.html"
        ]);
        exit;
    }

    $stmt = $pdo->prepare("UPDATE peliculas SET titulo = :titulo, genero = :genero WHERE id = :id");
    $stmt->execute([':titulo' => $titulo, ':genero' => $genero, ':id' => $id]);
    
    devuelveJson(["mensaje" => "Película actualizada con éxito."]);

} catch (PDOException $e) {
    http_response_code(500);
    header('Content-Type: application/problem+json; charset=utf-8');
    echo json_encode([
        "status" => 500,
        "title" => "Error interno", 
        "detail" => "No se pudo actualizar la información en la base de datos."
    ]);
    exit;
}