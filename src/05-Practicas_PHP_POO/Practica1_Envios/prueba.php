<?php

require_once "modelo.php";

$envios = [
    new EnvioNormal("Córdoba", 2),
    new EnvioUrgente("Sevilla", 2, 4)
];

foreach ($envios as $envio) {
    imprimirEnvio($envio);
}

try {
    $envioIncorrecto = new EnvioNormal("Málaga", 0);
} catch (InvalidArgumentException $e) {
    echo "Error controlado: " . $e->getMessage() . PHP_EOL;
}
