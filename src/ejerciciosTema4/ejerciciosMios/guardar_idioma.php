<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

$idioma = $_POST["idioma"] ?? "";
$modo = $_POST["modo"] ?? "";

if (!in_array($idioma, ["es", "en"], true) || !in_array($modo, ["claro", "oscuro"], true)) {
    http_response_code(400);
    exit("Los datos enviados no son válidos.");
}

setcookie("idioma", $idioma, [
    "expires" => time() + (7 * 24 * 60 * 60),
    "path" => "/",
]);};
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Preferencia guardada</title>
</head>
<body>
    <p>Preferencia de idioma guardada correctamente.</p>
</body>
</html>
