<?php
require_once __DIR__ . "/conexion.php";

try {
    $pdo->exec("DROP TABLE IF EXISTS peliculas");

    // ¡Agregamos la columna 'imagen'!
    $pdo->exec("CREATE TABLE peliculas (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        titulo TEXT NOT NULL,
        genero TEXT NOT NULL,
        imagen TEXT
    )");

    echo "<div style='font-family: sans-serif; text-align: center; margin-top: 50px;'>";
    echo "<h1 style='color: #28a745;'>¡Base de datos actualizada con imágenes!</h1>";
    echo "<a href='../index.html' style='padding: 10px 20px; background: #111; color: white; text-decoration: none; border-radius: 5px;'>Ir a la cartelera</a>";
    echo "</div>";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}