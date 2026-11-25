<?php

require_once "modelo.php";

$reserva = new Reserva(5);

$intentos = [2, 0, 4];

foreach ($intentos as $cantidad) {
    try {
        try {
            $reserva->reservar($cantidad);
        } catch (PlazasAgotadasException $e) {
            echo "Incidencia registrada" . PHP_EOL;
            throw $e;
        }
    } catch (InvalidArgumentException $e) {
        echo "Error de dato: " . $e->getMessage() . PHP_EOL;
    } catch (PlazasAgotadasException $e) {
        echo "Error de disponibilidad: " . $e->getMessage() . PHP_EOL;
    } finally {
        echo "Plazas disponibles: " . $reserva->disponibles() . PHP_EOL;
    }
}

$cadena = serialize($reserva);
$restaurada = unserialize($cadena, ["allowed_classes" => [Reserva::class]]);

echo "Restauración: " . $restaurada->disponibles() . " - " . $restaurada->estado() . PHP_EOL;
echo "Misma identidad: " . ($reserva === $restaurada ? "true" : "false") . PHP_EOL;

try {
    $reservaIncorrecta = new Reserva(-1);
} catch (InvalidArgumentException $e) {
    echo "Capacidad inválida capturada: " . $e->getMessage() . PHP_EOL;
}

try {
    // Se crea una cadena serializada con un valor de plazas de tipo texto.
    $estadoIncorrecto = 'O:7:"Reserva":1:{s:6:"plazas";s:4:"tres";}';
    unserialize($estadoIncorrecto, ["allowed_classes" => [Reserva::class]]);
} catch (UnexpectedValueException $e) {
    echo "Estado inválido capturado: " . $e->getMessage() . PHP_EOL;
}

$legada = new ReservaLegada(3);
$legadaRestaurada = unserialize(serialize($legada));

echo "Variante legada: " . $legadaRestaurada->resumen() . PHP_EOL;
