<?php
if(!isset($_GET["tipo"]) || !is_string($_GET["tipo"])){
    http_response_code(400);
    header("content-Type: text/plain;charse=utf-8");
    echo "Error400: ya las estás liando";
    exit;
}
$tipo = $_GET["tipo"];
switch ($tipo) {
    case "html":
        header("Content-type: html; charset=utf-8");
        echo "<!DOCTYPE html>";
        echo "<html lang ='es'>";;
        echo "<head><meta charset='utf-8'></head>";
        echo "<title>Soy un HTML</title>";
        echo "<body>";
        echo "<h1>Soy un HTML</h1>";
        echo "<p>Esto es un coñazo</p>";
        echo "</body>";
        echo "</html>";
        break;

    case "texto":
        header("Content-type: text/plain; charset=utf-8");
        echo "Esto es un texto";
        echo "Espero que funcione bien";
        echo "Socorro!";
        break;

    case "json":
        header("Content-type: application/json; charset=utf-8");
        $mensaje=[
            "modulo" => "Servidor",
            "profesor" => "Rafa hace los apuntes y Antonio te da clase",
            "resultado" => "Esto es un JSON",
            "nota" => "Esperemos que al menos un 5."
        ];
        echo json_encode($mensaje);
        break;

    default:
        http_response_code(400);
        header("content-type: text/plain;charse=utf-8");
        echo "Error 400: Escrito por mí, aquí no hay magia ninguna...";
        break;

}