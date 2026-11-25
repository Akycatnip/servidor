<?php

spl_autoload_register(function ($clase) {
    $prefijo = "Centro\\";

    // Solo cargamos clases que pertenezcan a Centro.
    if (strpos($clase, $prefijo) !== 0) {
        return;
    }

    $nombreClase = substr($clase, strlen($prefijo));
    $ruta = __DIR__ . "/src/" . str_replace("\\", "/", $nombreClase) . ".php";

    if (file_exists($ruta)) {
        require_once $ruta;
    }
});
