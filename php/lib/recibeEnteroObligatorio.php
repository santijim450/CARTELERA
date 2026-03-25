<?php
require_once __DIR__ . "/ProblemDetailsException.php";
require_once __DIR__ . "/BAD_REQUEST.php";

function recibeEnteroObligatorio($nombre) {
    $valor = isset($_REQUEST[$nombre]) ? trim($_REQUEST[$nombre]) : "";
    if ($valor === "") {
        throw new ProblemDetailsException(
            status: 400,
            type: BAD_REQUEST,
            title: "Falta el valor de: $nombre",
            instance: "vivi/faltavalor.html"
        );
    }
    if (!filter_var($valor, FILTER_VALIDATE_INT)) {
        throw new ProblemDetailsException(
            status: 400,
            type: BAD_REQUEST,
            title: "El valor de '$nombre' debe ser un número entero.",
            instance: "vivi/campoenteroenblanco.html"
        );
    }
    return (int)$valor;
}