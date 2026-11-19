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

function escapar($texto) {
    return htmlspecialchars($texto, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}

echo "<!DOCTYPE html>";
echo "<html lang='es'><head><meta charset='UTF-8'><title>Registros</title></head><body>";
echo "<h1>Registros guardados</h1>";

if (!file_exists($archivo)) {
    echo "<p>No hay registros.</p>";
} else {
    $puntero = fopen($archivo, "r");

    if ($puntero === false) {
        exit("No se puede abrir el archivo CSV.");
    }

    echo "<table border='1'>";
    echo "<tr><th>Nombre</th><th>Correo</th></tr>";

    while (($datos = fgetcsv($puntero, 0, ",", '"', "")) !== false) {
        if (count($datos) === 2) {
            echo "<tr>";
            echo "<td>" . escapar($datos[0]) . "</td>";
            echo "<td>" . escapar($datos[1]) . "</td>";
            echo "</tr>";
        }
    }

    echo "</table>";
    fclose($puntero);
}

echo "<p><a href='formulario.php'>Volver al formulario</a></p>";
echo "</body></html>";
