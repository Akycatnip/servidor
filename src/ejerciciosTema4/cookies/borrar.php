<?php

// Comprobamos que el envío sea mediante POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    exit("Metodo no permitido");
}

// Detectamos si utilizamos HTTPS
$https = !empty($_SERVER["HTTPS"])
    && $_SERVER["HTTPS"] !== "off";

// Preparamos las opciones para eliminar las cookies
$opciones = [
    "expires" => time() - 3600,
    "path" => "/",
    "secure" => $https,
    "httponly" => true,
    "samesite" => "Lax"
];

// Eliminamos las cookies
setcookie("modo", "", $opciones);
setcookie("idioma", "", $opciones);

// Redirigimos al formulario
header("Location: formulario.html", true, 303);

exit;
?>
