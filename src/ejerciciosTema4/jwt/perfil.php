<?php
header("Content-Type: application/json");

// Cargamos la clave y las funciones
require __DIR__ . "/../privado/clave_jwt.php";
require __DIR__ . "/jwt.php";

// Comprobamos si existe la cabecera Authorization
if (!isset($_SERVER["HTTP_AUTHORIZATION"])) {

    http_response_code(401);

    echo json_encode(array(
        "error" => "No se ha enviado el token"
    ));

    exit();
}

// Recogemos la cabecera
$autorizacion = $_SERVER["HTTP_AUTHORIZATION"];

// Separamos Bearer del token
$partes = explode(" ", $autorizacion);

// Comprobamos que tenga el formato correcto
if (
    count($partes) != 2 ||
    $partes[0] != "Bearer" ||
    $partes[1] == ""
) {

    http_response_code(401);

    echo json_encode(array(
        "error" => "Formato de token incorrecto"
    ));

    exit();
}

// Recogemos el token
$jwt = $partes[1];

// Verificamos el token
$resultado = verificar_token($jwt, $claveSecreta);

// Si el token es válido
if ($resultado !== false) {

    echo json_encode(array(
        "usuario" => $resultado["sub"]
    ));

} else {

    http_response_code(401);

    echo json_encode(array(
        "error" => "Token no válido"
    ));

}

?>
