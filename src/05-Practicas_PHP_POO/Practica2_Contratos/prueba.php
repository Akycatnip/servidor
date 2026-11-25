<?php

require_once "modelo.php";

$memoria = new CanalMemoria();
$pantalla = new CanalPantalla();

$servicioMemoria = new ServicioAvisos($memoria);
$servicioPantalla = new ServicioAvisos($pantalla);

echo $servicioMemoria->avisar("La tienda cierra a las ocho") . PHP_EOL;
echo "Mensajes guardados: " . count($memoria->historial()) . PHP_EOL;

echo $servicioPantalla->avisar("La tienda cierra a las ocho") . PHP_EOL;

$memoria->reiniciar();
echo "Mensajes después de reiniciar: " . count($memoria->historial()) . PHP_EOL;
