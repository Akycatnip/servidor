<?php
// Datos de partida. Se pueden modificar para comprobar los límites.
$importeCompra = 65.00;
$zona = 'peninsula';

// Esta función recibe datos previamente validados.
function calcularEnvio(float $importe, string $zona): float
{
    if ($zona === 'peninsula') {
        return $importe < 60 ? 5.00 : 0.00;
    }
    return $importe < 100 ? 12.00 : 6.00;
}

$errores = [];
if ($importeCompra < 0) {
    $errores[] = 'El importe de la compra no puede ser negativo.';
}
if (!in_array($zona, ['peninsula', 'islas'], true)) {
    $errores[] = 'La zona debe ser peninsula o islas.';
}
if (!$errores) {
    $gastosEnvio = calcularEnvio($importeCompra, $zona);
    $total = $importeCompra + $gastosEnvio;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 1: gastos de envío</title>
</head>
<body>
    <h1>Gastos de envío</h1>
    <?php if ($errores): ?>
        <ul>
            <?php foreach ($errores as $error): ?>
                <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Zona: <?= htmlspecialchars($zona, ENT_QUOTES, 'UTF-8') ?></p>
        <p>Compra: <?= number_format($importeCompra, 2, ',', '.') ?> €</p>
        <p>Envío: <?= number_format($gastosEnvio, 2, ',', '.') ?> €</p>
        <p>Total: <?= number_format($total, 2, ',', '.') ?> €</p>
    <?php endif; ?>
</body>
</html>
