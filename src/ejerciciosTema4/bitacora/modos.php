<?php
// Este script se ejecuta desde la línea de comandos.
if (PHP_SAPI !== "cli") {
    exit("Este script debe ejecutarse desde la terminal.");
}

$archivo = dirname(__DIR__, 2) . "/privado/modos.txt";

function mostrarContenido($archivo, $titulo) {
    echo "\n" . $titulo . "\n";

    $puntero = fopen($archivo, "r");

    if ($puntero === false) {
        echo "No se puede abrir el archivo para leerlo.\n";
        return;
    }

    while (($linea = fgets($puntero)) !== false) {
        echo $linea;
    }

    fclose($puntero);
}

// Modo w: crea el archivo o sobrescribe su contenido.
$puntero = fopen($archivo, "w");

if ($puntero === false) {
    exit("No se puede abrir el archivo en modo w.\n");
}

if (fwrite($puntero, "A\n") === false) {
    fclose($puntero);
    exit("No se puede escribir A.\n");
}

fclose($puntero);
mostrarContenido($archivo, "Contenido después de escribir A en modo w:");

// Modo a: añade B al final sin borrar lo anterior.
$puntero = fopen($archivo, "a");

if ($puntero === false) {
    exit("No se puede abrir el archivo en modo a.\n");
}

if (fwrite($puntero, "B\n") === false) {
    fclose($puntero);
    exit("No se puede añadir B.\n");
}

fclose($puntero);
mostrarContenido($archivo, "Contenido después de añadir B en modo a:");

// Modo w: vuelve a sobrescribir el archivo, sustituyendo A y B por C.
$puntero = fopen($archivo, "w");

if ($puntero === false) {
    exit("No se puede volver a abrir el archivo en modo w.\n");
}

if (fwrite($puntero, "C\n") === false) {
    fclose($puntero);
    exit("No se puede escribir C.\n");
}

fclose($puntero);
mostrarContenido($archivo, "Contenido final después de escribir C en modo w:");

echo "\nModos utilizados:\n";
echo "r: abre el archivo para lectura.\n";
echo "w: abre para escritura y sobrescribe el contenido anterior.\n";
echo "a: abre para escritura y añade al final del archivo.\n";
