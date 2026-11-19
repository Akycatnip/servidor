<?php
$archivo = dirname(__DIR__, 2) . "/privado/bitacora.txt";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo "Debes enviar el formulario.";
    exit;
}

if (!isset($_POST["nota"]) || !is_string($_POST["nota"])) {
    echo "La nota no es válida.";
    exit;
}

// Recortamos los espacios exteriores.
$nota = preg_replace('/^\s+|\s+$/u', '', $_POST["nota"]);

if ($nota === null || $nota === "") {
    echo "La nota no puede estar vacía.";
    exit;
}

// Rechazamos saltos de línea y caracteres de control.
if (preg_match('/[\r\n\p{Cc}]/u', $nota) !== 0) {
    echo "La nota no puede contener saltos de línea ni caracteres de control.";
    exit;
}

// Contamos caracteres Unicode.
$numeroCaracteres = preg_match_all('/./us', $nota);

if ($numeroCaracteres === false || $numeroCaracteres < 1 || $numeroCaracteres > 120) {
    echo "La nota debe tener entre 1 y 120 caracteres.";
    exit;
}

// Abrimos el archivo en modo añadir para conservar las notas anteriores.
$puntero = fopen($archivo, "a");

if ($puntero === false) {
    echo "No se puede abrir el archivo para escribir.";
    exit;
}

// Cada nota se guarda en una línea.
$datos = $nota . PHP_EOL;
$resultado = fwrite($puntero, $datos);

if ($resultado === false) {
    echo "No se ha podido escribir la nota.";
    fclose($puntero);
    exit;
}

fclose($puntero);

echo "La nota se ha guardado correctamente.";
?>
<p><a href="formulario.html">Volver al formulario</a></p>
<p><a href="leer.php">Leer la bitácora</a></p>
