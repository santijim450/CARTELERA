<?php
require_once __DIR__ . "/lib/manejaErrores.php";
require_once __DIR__ . "/../bd/conexion.php";
require_once __DIR__ . "/lib/recibeEnteroObligatorio.php";
require_once __DIR__ . "/lib/recibeTextoObligatorio.php";
require_once __DIR__ . "/lib/devuelveJson.php";

$id = recibeEnteroObligatorio("id");
$titulo = recibeTextoObligatorio("titulo");
$genero = recibeTextoObligatorio("genero");
$imagen = recibeTextoObligatorio("imagen");

$db = conexion();
$stmt = $db->prepare("UPDATE PELICULA SET TITULO = ?, GENERO = ?, IMAGEN = ? WHERE ID = ?");
$stmt->execute([$titulo, $genero, $imagen, $id]);

devuelveJson(["mensaje" => "Película actualizada con éxito"]);