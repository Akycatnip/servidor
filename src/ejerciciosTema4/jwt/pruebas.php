<?php
require __DIR__ . "/../privado/clave_jwt.php";
require __DIR__ . "/jwt.php";

$payload = "";
$resultado = false;

if (isset($_POST["token"])) {

    $token = $_POST["token"];

    // Separamos las partes del token
    $partes = explode(".", $token);

    // Comprobamos que tenga tres partes
    if (count($partes) == 3) {

        // Decodificamos el payload
        $payload = json_decode(
            base64_decode(strtr($partes[1], "-_", "+/")),
            true
        );

        // Comprobamos si el token es válido
        $resultado = verificar_token($token, $claveSecreta);

    }

}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pruebas JWT</title>
</head>
<body>

<h1>Pruebas JWT</h1>

<form action="pruebas.php" method="POST">

    <p>
        <label for="token">Introduce el token:</label>
    </p>

    <textarea
        name="token"
        id="token"
        rows="5"
        cols="80"
        required
    ></textarea>

    <br>

    <input type="submit" value="Comprobar token">

</form>

<?php if (isset($_POST["token"])): ?>

    <h2>Payload decodificado</h2>

    <pre><?php
        echo htmlspecialchars(
            json_encode($payload, JSON_PRETTY_PRINT)
        );
        ?></pre>

    <h2>Resultado de la verificación</h2>

    <?php if ($resultado !== false): ?>

        <p>El token es válido.</p>

    <?php else: ?>

        <p>El token no es válido.</p>

    <?php endif; ?>

<?php endif; ?>

</body>
</html>
