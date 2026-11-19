<?php
$opciones = [
    "expires" => time() - 3600,
    "path" => "/",
    "secure" => false,
    "httponly" => true,
    "samesite" => "Lax"
];

setcookie("modo", "", $opciones);
setcookie("idioma", "", $opciones);

header("Location: formulario.html");
exit;
?>