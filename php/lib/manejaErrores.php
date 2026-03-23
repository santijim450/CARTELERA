<?php

require_once __DIR__ . "/ProblemDetailsException.php";

function manejadorDeErrores(Throwable $e) {
    if ($e instanceof ProblemDetailsException) {
        $detalles = $e->getProblemDetails();
        http_response_code($detalles['status'] ?? 500);
        header('Content-Type: application/problem+json; charset=utf-8');
        echo json_encode($detalles);
    } else {
        http_response_code(500);
        header('Content-Type: application/problem+json; charset=utf-8');
        echo json_encode([
            "status" => 500,
            "title" => "Error interno del servidor",
            "detail" => $e->getMessage()
        ]);
    }
    exit;
}

set_exception_handler('manejadorDeErrores');
