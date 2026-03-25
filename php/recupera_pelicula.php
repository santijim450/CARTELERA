<?php
require_once __DIR__ . "/lib/manejaErrores.php";
require_once __DIR__ . "/lib/BAD_REQUEST.php";
require_once __DIR__ . "/lib/ProblemDetailsException.php";
require_once __DIR__ . "/lib/devuelveJson.php";
require_once __DIR__ . "/../bd/conexion.php";

$id = $_GET['id'] ?? '';

if ($id === '') {
    // Si no se proporciona el ID, redirige a faltavalor.html
    throw new ProblemDetailsException([
        "status" => BAD_REQUEST,
        "title" => "ID no proporcionado",
        "type" => ERROR_FALTA_VALOR
    ]);
}

$stmt = $pdo->prepare("SELECT * FROM peliculas WHERE id = :id");
$stmt->execute([':id' => $id]);
$pelicula = $stmt->fetch();

if (!$pelicula) {
    // Si la película no existe en la BD, redirige a entidadnoencontrada.html
    throw new ProblemDetailsException([
        "status" => 404,
        "title" => "Registro no encontrado",
        "type" => ERROR_ENTIDAD_NO_ENCONTRADA
    ]);
}

devuelveJson($pelicula);