<?php

require_once "modelo.php";

$memoria = new CanalMemoria();
$pantalla = new CanalPantalla();

$servicioMemoria = new ServiciosAviso($memoria);
$servicioPantalla = new ServiciosAviso($pantalla);

echo $servicioMemoria->avisar("La tienda cierra a las ocho") ."<br>";
echo "Mensajes guardados: " . count($memoria->historial()) ."<br>";

echo $servicioPantalla->avisar("La tienda cierra a las ocho") ."<br>";

$memoria->reiniciar();
echo "Mensajes después de reiniciar: " . count($memoria->historial()) ."<br>";


