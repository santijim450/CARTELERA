<?php
require_once __DIR__ . "/lib/manejaErrores.php";
require_once __DIR__ . "/../bd/conexion.php"; // Asegura la ruta a conexion.php
require_once __DIR__ . "/lib/recibeTextoObligatorio.php";
require_once __DIR__ . "/lib/devuelveJson.php";

// El HTML envía "nombre", "genero" e "imagen" mediante POST
$titulo = recibeTextoObligatorio("nombre");
$genero = recibeTextoObligatorio("genero");
$imagen = recibeTextoObligatorio("imagen");

$db = conexion(); // Usa la función definida en bd/conexion.php
$stmt = $db->prepare("INSERT INTO PELICULA (TITULO, GENERO, IMAGEN) VALUES (?, ?, ?)");
$stmt->execute([$titulo, $genero, $imagen]);

devuelveJson(["mensaje" => "¡Película guardada con éxito!"]);