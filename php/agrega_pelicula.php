<?php
require_once __DIR__ . "/lib/devuelveJson.php";
require_once __DIR__ . "/lib/recibeJson.php";
require_once __DIR__ . "/../bd/conexion.php"; 

try {

    $datos = recibeJson();

    $titulo = trim($datos->titulo ?? '');
    $genero = trim($datos->genero ?? 'Variado');
    $imagen = trim($datos->imagen ?? ''); 

    if ($titulo === '') {
        http_response_code(400);
        header('Content-Type: application/problem+json; charset=utf-8');
        echo json_encode([
            "status" => 400,
            "title" => "Falta el título.",
            "detail" => "El título de la película es obligatorio.",
            "type" => "/errors/faltatitulo.html"
        ]);
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO peliculas (titulo, genero, imagen) VALUES (:titulo, :genero, :imagen)");
    $stmt->execute([
        ':titulo' => $titulo, 
        ':genero' => $genero, 
        ':imagen' => $imagen
    ]);
    
    devuelveJson(["mensaje" => "Película '$titulo' guardada en tu colección."]);

} catch (PDOException $e) {
    http_response_code(500);
    header('Content-Type: application/problem+json; charset=utf-8');
    echo json_encode([
        "status" => 500,
        "title" => "Error interno", 
        "detail" => "Ocurrió un error con la base de datos: " . $e->getMessage()
    ]);
    exit;
}