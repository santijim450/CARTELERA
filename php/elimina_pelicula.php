<?php
require_once __DIR__ . "/lib/manejaErrores.php";
require_once __DIR__ . "/../bd/conexion.php";
require_once __DIR__ . "/lib/recibeEnteroObligatorio.php";
require_once __DIR__ . "/lib/devuelveJson.php";

$id = recibeEnteroObligatorio("id");

$db = conexion();
$stmt = $db->prepare("DELETE FROM PELICULA WHERE ID = ?");
$stmt->execute([$id]);

devuelveJson(["mensaje" => "Película eliminada"]);