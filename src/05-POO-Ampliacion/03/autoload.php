<?php

spl_autoload_register(function ($clase) {

    // 1. Prefijo que queremos atender
    $prefijo = "Centro\\";

    // 2. Comprobamos si la clase pertenece a Centro
    if (str_starts_with($clase, $prefijo)) {

        // 3. Quitamos el prefijo Centro\
        $clase = substr($clase, strlen($prefijo));

        // 4. Sustituimos las barras por separadores de directorios
        $ruta = str_replace("\\", DIRECTORY_SEPARATOR, $clase);

        // 5. Construimos la ruta completa
        $archivo = __DIR__ . "/src/" . $ruta . ".php";

        // 6. Comprobamos si existe y lo cargamos
        if (file_exists($archivo)) {
            require_once $archivo;
        }
    }

});