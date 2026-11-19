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
$archivo = dirname(__DIR__, 2) . "/privado/registros.csv";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    exit("Debes enviar el formulario.");
}

if (
    !isset($_POST["nombre"], $_POST["correo"]) ||
    !is_string($_POST["nombre"]) ||
    !is_string($_POST["correo"])
) {
    exit("Los datos no son válidos.");
}

$nombre = trim($_POST["nombre"]);
$correo = trim($_POST["correo"]);

// El nombre debe tener entre 2 y 60 caracteres Unicode.
$longitud = preg_match_all('/./us', $nombre);

if ($longitud === false || $longitud < 2 || $longitud > 60) {
    exit("El nombre debe tener entre 2 y 60 caracteres.");
}

// No se permiten controles ni saltos de línea.
if (preg_match('/\p{Cc}/u', $nombre) !== 0) {
    exit("El nombre contiene caracteres no permitidos.");
}

// Comprobamos el correo y su longitud en bytes.
if (strlen($correo) > 254 || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    exit("El correo no es válido.");
}

// Rechazamos campos que puedan interpretarse como fórmulas en una hoja de cálculo.
if (preg_match('/^[=+\-@]/', $nombre) || preg_match('/^[=+\-@]/', $correo)) {
    exit("El nombre o el correo comienzan por un carácter no permitido.");
}

$puntero = fopen($archivo, "a");

if ($puntero === false) {
    exit("No se puede abrir el archivo CSV.");
}

// fputcsv escribe los campos separados y entrecomillados cuando es necesario.
$resultado = fputcsv($puntero, [$nombre, $correo], ",", '"', "");

if ($resultado === false) {
    fclose($puntero);
    exit("No se puede escribir en el archivo CSV.");
}

fclose($puntero);

echo "Registro guardado correctamente.";
?>
<p><a href="formulario.php">Volver</a></p>
<p><a href="listar.php">Ver registros</a></p>
