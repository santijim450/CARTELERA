<?php
require_once __DIR__ . "/ProblemDetailsException.php";
require_once __DIR__ . "/BAD_REQUEST.php";

// Esta línea es nueva: convierte errores comunes en excepciones
set_error_handler(function ($nivel, $mensaje, $archivo, $linea) {
    throw new ErrorException($mensaje, 0, $nivel, $archivo, $linea);
});

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
            "type" => "errorinterno.html", // Asegúrate que esta constante o string exista
            "title" => $e->getMessage() // Mostramos el mensaje para debugear
        ]);
    }
}

set_exception_handler("manejadorDeErrores");