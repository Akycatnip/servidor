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
$directorio = dirname(__DIR__, 2) . "/privado/";

// El cliente solo puede indicar uno de estos identificadores.
if (!isset($_GET["id"]) || !is_string($_GET["id"])) {
    http_response_code(400);
    exit("Identificador no válido.");
}

if ($_GET["id"] === "guia") {
    $archivo = $directorio . "guia.txt";
    $nombreDescarga = "guia.txt";
    $tipo = "text/plain; charset=UTF-8";
} elseif ($_GET["id"] === "csv") {
    $archivo = $directorio . "registros.csv";
    $nombreDescarga = "registros.csv";
    $tipo = "text/csv; charset=UTF-8";
} else {
    http_response_code(400);
    exit("Identificador no válido.");
}

if (!is_file($archivo) || !is_readable($archivo)) {
    http_response_code(404);
    exit("El archivo no existe o no se puede leer.");
}

header("Content-Type: " . $tipo);
header("Content-Disposition: attachment; filename=\"" . $nombreDescarga . "\"");
header("Content-Length: " . filesize($archivo));
header("Cache-Control: no-store, no-cache, must-revalidate, private, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

$contenido = file_get_contents($archivo);

if ($contenido === false) {
    exit;
}

echo $contenido;
exit;
