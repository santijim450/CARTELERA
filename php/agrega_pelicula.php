<?php

require_once __DIR__ . "/lib/manejaErrores.php";
require_once __DIR__ . "/lib/BAD_REQUEST.php";
require_once __DIR__ . "/lib/devuelveJson.php";
require_once __DIR__ . "/lib/recibeJson.php"; 
require_once __DIR__ . "/../bd/conexion.php";

$datos = recibeJson();

$titulo = trim($datos->titulo ?? '');
$genero = trim($datos->genero ?? 'Variado');
$imagen = trim($datos->imagen ?? ''); 

if ($titulo === '') {
    // Se lanza una excepción que redirige a la página de error de campo en blanco
    throw new ProblemDetailsException([
        "status" => BAD_REQUEST,
        "title" => "Falta el título.",
        "type" => ERROR_CAMPO_EN_BLANCO
    ]);
}

$stmt = $pdo->prepare("INSERT INTO peliculas (titulo, genero, imagen) VALUES (:titulo, :genero, :imagen)");
$stmt->execute([
    ':titulo' => $titulo, 
    ':genero' => $genero, 
    ':imagen' => $imagen
]);

devuelveJson(["mensaje" => "Película '$titulo' guardada en tu colección."]);