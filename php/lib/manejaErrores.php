<?php
require_once __DIR__ . "/ProblemDetailsException.php";
require_once __DIR__ . "/BAD_REQUEST.php";

function manejadorDeErrores(Throwable $e) {
    if ($e instanceof ProblemDetailsException) {
        $detalles = $e->getProblemDetails();
        http_response_code($detalles['status'] ?? 400);
        header('Content-Type: application/problem+json; charset=utf-8');
        echo json_encode($detalles);
    } else {
        http_response_code(500);
        header('Content-Type: application/problem+json; charset=utf-8');
        echo json_encode([
            "status" => 500,
            "type" => ERROR_INTERNO,
            "title" => "Error inesperado del servidor"
        ]);
    }
}

set_exception_handler("manejadorDeErrores");