<?php
// Comprobamos que modo existe y es una cadena
if (!isset($_GET["modo"]) || !is_string($_GET["modo"])) {

    http_response_code(400);
    header("Content-Type: text/plain; charset=utf-8");

    echo "Error 400: modo no valido, no es mágico, lo escribo yo";
    exit;
}

// Recogemos el parámetro
$modo = $_GET["modo"];

// Calculamos la hora actual en UTC
$horaGeneracion = time();
$horaUTC = gmdate("Y-m-d H:i:s", $horaGeneracion);

// Indicamos el tipo de contenido
header("Content-Type: text/plain; charset=utf-8");

if ($modo === "publico") {

    // Permitir almacenar durante 60 segundos
    header("Cache-Control: public, max-age=60");

    // Establecer fecha de expiración
    $expiracion = gmdate(
        "D, d M Y H:i:s",
        $horaGeneracion + 60
    ) . " GMT";

    header("Expires: " . $expiracion);

} elseif ($modo === "privado") {

    // Prohibir el almacenamiento en caché
    header("Cache-Control: private, no-store");

} else {

    http_response_code(400);

    echo "Error 400: modo desconocido, nada de magia, escrito a mano.";
    exit;
}

// Devolver la hora de generación
echo "Hora de generación UTC: " . $horaUTC;

?>
