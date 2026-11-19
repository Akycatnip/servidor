<?php
$archivo = dirname(__DIR__, 2) . "/privado/bitacora.txt";

function escapar($texto) {
    return htmlspecialchars($texto, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}

if (!file_exists($archivo)) {
    echo "<p>La bitácora todavía no existe.</p>";
    exit;
}

// Primera lectura: línea a línea.
$puntero = fopen($archivo, "r");

if ($puntero === false) {
    echo "<p>No se puede abrir el archivo para leerlo.</p>";
    exit;
}

echo "<h1>Bitácora: lectura línea a línea</h1>";
echo "<ul>";

while (($linea = fgets($puntero)) !== false) {
    echo "<li>" . escapar(rtrim($linea, "\r\n")) . "</li>";
}

echo "</ul>";
fclose($puntero);

// Segunda lectura: bloques de 16 bytes.
$puntero = fopen($archivo, "r");

if ($puntero === false) {
    echo "<p>No se puede volver a abrir el archivo.</p>";
    exit;
}

$contenido = "";
$totalBytes = 0;

while (!feof($puntero)) {
    $bloque = fread($puntero, 16);

    if ($bloque === false) {
        echo "<p>Error al leer un bloque del archivo.</p>";
        fclose($puntero);
        exit;
    }

    if ($bloque === "") {
        break;
    }

    $contenido .= $bloque;
    $totalBytes += strlen($bloque);
}

fclose($puntero);

echo "<h2>Lectura por bloques de 16 bytes</h2>";
echo "<pre>" . escapar($contenido) . "</pre>";
echo "<p>Tamaño del archivo: " . $totalBytes . " bytes.</p>";
?>
<p><a href="formulario.html">Volver al formulario</a></p>
