<?php
// Convierte una cadena a Base64 URL-safe
function base64url($datos) {

    return str_replace(
        ['+', '/', '='],
        ['-', '_', ''],
        base64_encode($datos)
    );

}

// Genera un JWT
function generar_token($datos, $clave) {

    // Creamos la cabecera
    $cabecera = json_encode(array(
        "alg" => "HS256",
        "typ" => "JWT"
    ));

    // Convertimos los datos a JSON
    $payload = json_encode($datos);

    // Codificamos cabecera y payload
    $base64cab = base64url($cabecera);
    $base64payload = base64url($payload);

    // Creamos la firma
    $firma = hash_hmac(
        "sha256",
        $base64cab . "." . $base64payload,
        $clave,
        true
    );

    // Codificamos la firma
    $base64firma = base64url($firma);

    // Devolvemos las tres partes
    return $base64cab . "." .
        $base64payload . "." .
        $base64firma;

}


// Verifica un JWT
function verificar_token($jwt, $clave) {

    // Separamos las tres partes
    $partes = explode(".", $jwt);

    if (count($partes) != 3) {
        return false;
    }

    $base64cab = $partes[0];
    $base64payload = $partes[1];
    $base64firma = $partes[2];

    // Comprobamos que las partes estén codificadas correctamente
    if (
        base64url(base64_decode(strtr($base64cab, "-_", "+/"), true)) !== $base64cab ||
        base64url(base64_decode(strtr($base64payload, "-_", "+/"), true)) !== $base64payload ||
        base64url(base64_decode(strtr($base64firma, "-_", "+/"), true)) !== $base64firma
    ) {
        return false;
    }

    // Decodificamos la cabecera
    $cabecera = json_decode(
        base64_decode(strtr($base64cab, "-_", "+/")),
        true
    );

    // Comprobamos el algoritmo y el tipo
    if (
        !is_array($cabecera) ||
        !isset($cabecera["alg"]) ||
        !isset($cabecera["typ"]) ||
        $cabecera["alg"] != "HS256" ||
        $cabecera["typ"] != "JWT"
    ) {
        return false;
    }

    // Creamos de nuevo la firma
    $firma = hash_hmac(
        "sha256",
        $base64cab . "." . $base64payload,
        $clave,
        true
    );

    $nuevaFirma = base64url($firma);

    // Comprobamos la firma
    if ($nuevaFirma !== $base64firma) {
        return false;
    }

    // Decodificamos el payload
    $payload = json_decode(
        base64_decode(strtr($base64payload, "-_", "+/")),
        true
    );

    if (!is_array($payload)) {
        return false;
    }

    // Comprobamos que existen los datos necesarios
    if (
        !isset($payload["iss"]) ||
        !isset($payload["aud"]) ||
        !isset($payload["sub"]) ||
        !isset($payload["iat"]) ||
        !isset($payload["nbf"]) ||
        !isset($payload["exp"])
    ) {
        return false;
    }

    // Comprobamos emisor, destinatario y usuario
    if (
        $payload["iss"] != "aula-ra4" ||
        $payload["aud"] != "api-ra4" ||
        $payload["sub"] != "ana"
    ) {
        return false;
    }

    // Comprobamos los tiempos
    $ahora = time();

    if (
        $payload["iat"] > $ahora ||
        $payload["nbf"] > $ahora ||
        $payload["exp"] <= $ahora ||
        $payload["exp"] <= $payload["iat"] ||
        $payload["nbf"] > $payload["exp"]
    ) {
        return false;
    }

    // Si todo es correcto devolvemos el payload
    return $payload;

}

?>
