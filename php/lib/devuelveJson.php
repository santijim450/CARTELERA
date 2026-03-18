<?php
function devuelveJson($datos) {
    header('Content-Type: application/json');
    echo json_encode($datos);
    exit;
}