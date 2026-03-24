<?php

require_once __DIR__ . "/lib/manejaErrores.php";
require_once __DIR__ . "/lib/devuelveJson.php";
require_once __DIR__ . "/../bd/conexion.php";

$stmt = $pdo->query("SELECT * FROM peliculas");
$peliculas = $stmt->fetchAll();

devuelveJson($peliculas);