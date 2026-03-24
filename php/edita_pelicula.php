<?php

require_once __DIR__ . "/lib/manejaErrores.php";
require_once __DIR__ . "/lib/BAD_REQUEST.php";
require_once __DIR__ . "/lib/devuelveJson.php";
require_once __DIR__ . "/lib/recibeJson.php";
require_once __DIR__ . "/../bd/conexion.php";

$datos = recibeJson();

$id = trim($datos->id ?? '');
$titulo = trim($datos->titulo ?? '');
$genero = trim($datos->genero ?? '');

if ($id === '' || $titulo === '') {
    throw new ProblemDetailsException([
        "status" => BAD_REQUEST,
        "title" => "Datos inválidos", 
        "detail" => "El título es obligatorio.",
        "type" => "/errors/faltatitulo.html"
    ]);
}

$stmt = $pdo->prepare("UPDATE peliculas SET titulo = :titulo, genero = :genero WHERE id = :id");
$stmt->execute([':titulo' => $titulo, ':genero' => $genero, ':id' => $id]);

devuelveJson(["mensaje" => "Película actualizada con éxito."]);