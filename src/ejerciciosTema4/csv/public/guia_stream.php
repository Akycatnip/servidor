<?php
require __DIR__ . "/../autenticar/sesion.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["usuario"])) {
    header("Location: /autenticar/login.php");
    exit();
}

if (!isset($_SESSION["ultima_actividad"]) || time() - $_SESSION["ultima_actividad"] > 900) {
    session_unset();
    session_destroy();
    header("Location: /autenticar/login.php");
    exit();
}

$_SESSION["ultima_actividad"] = time();
?>
<?php
$archivo = dirname(__DIR__, 2) . "/privado/guia.txt";

if (!is_file($archivo) || !is_readable($archivo)) {
    http_response_code(404);
    exit("El archivo no existe o no se puede leer.");
}

header("Content-Type: text/plain; charset=UTF-8");
header("Content-Disposition: attachment; filename=\"guia.txt\"");
header("Content-Length: " . filesize($archivo));
header("Cache-Control: no-store, no-cache, must-revalidate, private, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

// readfile envía el contenido directamente desde el archivo.
if (readfile($archivo) === false) {
    exit;
}

exit;
