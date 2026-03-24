<?php
require_once __DIR__ . "/lib/manejaErrores.php";
require_once __DIR__ . "/lib/BAD_REQUEST.php";
require_once __DIR__ . "/lib/ProblemDetailsException.php";
require_once __DIR__ . "/lib/devuelveJson.php";
require_once __DIR__ . "/../bd/conexion.php";

$id = $_GET['id'] ?? '';

if ($id === '') {
    throw new ProblemDetailsException([
        "status" => BAD_REQUEST,
        "title" => "Error",
        "detail" => "Falta el ID."
    ]);
}


$stmt = $pdo->prepare("SELECT * FROM peliculas WHERE id = :id");
$stmt->execute([':id' => $id]);
$pelicula = $stmt->fetch();

if (!$pelicula) {
    throw new ProblemDetailsException([
        "status" => 404,
        "title" => "No encontrado",
        "detail" => "La película no existe."
    ]);
}

devuelveJson($pelicula);