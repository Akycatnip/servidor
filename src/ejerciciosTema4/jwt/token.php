<?php
// Indicamos que la respuesta será JSON
header("Content-Type: application/json");
//cargamos user y password
require __DIR__ . "/../privado/usuarios.php";
require __DIR__ . "/../privado/clave_jwt.php";
require __DIR__ . "/jwt.php";
// Comprobamos que se han enviado los datos
if (
    !isset($_POST["usuario"]) ||
    !isset($_POST["clave"])
) {

    http_response_code(400);

    echo json_encode(array(
        "error" => "Faltan datos"
    ));

    exit();
}

// Recogemos los datos
$usuario = $_POST["usuario"];
$clave = $_POST["clave"];

// Comprobamos las credenciales
if (
    isset($usuarios[$usuario]) &&
    password_verify($clave, $usuarios[$usuario])
) {

    // Obtenemos la hora actual
    $ahora = time();

    // Datos que tendrá el token
    $datos = array(
        "iss" => "aula-ra4",
        "aud" => "api-ra4",
        "sub" => "ana",
        "iat" => $ahora,
        "nbf" => $ahora,
        "exp" => $ahora + 120
    );

    // Generamos el token
    $jwt = generar_token($datos, $claveSecreta);

    // Devolvemos el token en JSON
    echo json_encode(array(
        "token" => $jwt
    ));

} else {

    // Credenciales incorrectas
    http_response_code(401);

    echo json_encode(array(
        "error" => "Credenciales incorrectas"
    ));

}
?>