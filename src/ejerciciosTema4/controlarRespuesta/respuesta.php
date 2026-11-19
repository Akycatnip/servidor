<?php

// Comprobamos que tipo existe y que es una cadena
if (!isset($_GET["tipo"]) || !is_string($_GET["tipo"])) {
    http_response_code(400);
    header("Content-Type: text/plain; charset=utf-8");
    echo "Error 400: parametro tipo no valido";
    exit;
}

$tipo = $_GET["tipo"];

switch ($tipo) {

    case "html":

        header("Content-Type: text/html; charset=utf-8");

        echo "<!DOCTYPE html>";
        echo "<html lang='es'>";
        echo "<head><meta charset='UTF-8'><title>Holis</title></head>";
        echo "<body>";
        echo "<h1>Te estoy devolviendo un HTML</h1>";
        echo "<p>ole y ole</p>";
        echo "</body>";
        echo "</html>";

        break;

    case "texto":

        header("Content-Type: text/plain; charset=utf-8");

        echo "Te estoy devolviendo texto plano\n";
        echo "Aplausos!";

        break;

    case "json":

        header("Content-Type: application/json; charset=utf-8");

        $datos = [
            "modulo" => "Servidor",
            "nombre" => "Rafa hace los apuntes y Antonio te da clase",
            "resultado" => "Respuesta en formato JSON",
            "notaPrevista" => "Esperemos que un 5."
        ];

        echo json_encode($datos);

        break;

    default:

        http_response_code(400);
        header("Content-Type: text/plain; charset=utf-8");

        echo "Error 400: tipo de respuesta desconocido. Ya la estás liando";

        break;
}

?>
