<?php

/**
 * Rutas relativas a las páginas de error HTML.
 * Estas constantes se utilizan en el campo "type" de las excepciones
 * para que el cliente (JS) realice la redirección.
 */
define("ERROR_CAMPO_EN_BLANCO", "errors/campoenblanco.html");
define("ERROR_CAMPO_ENTERO_EN_BLANCO", "errors/campoenteroenblanco.html");
define("ERROR_ENTIDAD_NO_ENCONTRADA", "errors/entidadnoencontrada.html");
define("ERROR_INTERNO", "errors/errorinterno.html");
define("ERROR_FALTA_VALOR", "errors/faltavalor.html");
define("ERROR_RESULTADO_NO_JSON", "errors/resultadonojson.html");

/**
 * Códigos de estado HTTP estándar.
 */
define("BAD_REQUEST", 400);
define("NOT_FOUND", 404);
define("INTERNAL_SERVER_ERROR", 500);