<?php
require_once __DIR__ . "/lib/manejaErrores.php";
require_once __DIR__ . "/lib/ProblemDetailsException.php";
require_once __DIR__ . "/lib/BAD_REQUEST.php"; 
require_once __DIR__ . "/lib/devuelveJson.php";
require_once __DIR__ . "/../bd/conexion.php";

$id = $_GET['id'] ?? '';

if ($id === '') {
    throw new ProblemDetailsException([
        "status" => BAD_REQUEST,
        "title" => "Datos inválidos",
        "detail" => "Falta el ID de la película."
    ]);
}

$stmt = $pdo->prepare("DELETE FROM peliculas WHERE id = :id");
$stmt->execute([':id' => $id]);

devuelveJson(["mensaje" => "Película eliminada correctamente."]);