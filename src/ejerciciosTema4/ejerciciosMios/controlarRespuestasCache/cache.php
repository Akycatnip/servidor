<?php
if (!isset($_GET["modo"]) || !is_string($_GET["modo"])) {
    http_response_code(400);
    header("Content-Type: text/html; charset=UTF-8");
    echo "Error 400: nada de magia por aquí...";
    exit;
}

$modo = $_GET["modo"];

$horaGeneracion = time();
$horaUTC = gmdate("H:i:s", $horaGeneracion);

header("Content-Type: text/plain; charset=utf-8");

if ($modo === "publico") {

    header("Cache-Control: public, max-age=60");

} elseif ($modo === "privado") {

    header("Cache-Control: private, no-store");

} else {

    http_response_code(400);
    echo "Otro error sin magia ninguna";
    exit;
}

echo "Hora de generación: " . $horaUTC;

?>
