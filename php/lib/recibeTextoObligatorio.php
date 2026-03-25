<?php
require_once __DIR__ . "/ProblemDetailsException.php";
require_once __DIR__ . "/BAD_REQUEST.php";

function recibeTextoObligatorio($nombre) {
    // Lee directamente de $_POST para procesar el formulario
    $valor = isset($_POST[$nombre]) ? trim($_POST[$nombre]) : "";
    if ($valor === "") {
        throw new ProblemDetailsException(400, BAD_REQUEST, "Falta el campo: $nombre", "vivi/faltavalor.html");
    }
    return $valor;
}
