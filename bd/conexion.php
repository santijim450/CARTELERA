<?php
$ruta_bd = __DIR__ . "/cartelera.db";

try {
    $pdo = new PDO("sqlite:" . $ruta_bd);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    http_response_code(500);
    header('Content-Type: application/problem+json');
    echo json_encode([
        "title" => "Error de Conexión",
        "detail" => "No se pudo conectar a la base de datos."
    ]);
    exit;
}