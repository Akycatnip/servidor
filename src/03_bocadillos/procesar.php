<?php
function escapar(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
function texto(string $campo, array &$errores): string
{
    $valor = $_POST[$campo] ?? '';
    if (!is_string($valor)) {
        $errores[] = "Formato incorrecto en $campo.";
        return '';
    }
    return trim($valor);
}

function obtenerPrecioBocadillo(string $tipo): float
{
    $precios = ['tortilla' => 3.50, 'pollo' => 4.50, 'vegetal' => 4.00];
    return $precios[$tipo];
}
function calcularPrecioExtras(array $extras): float
{
    $precios = ['queso' => 0.50, 'tomate' => 0.30, 'salsa' => 0.20];
    $suma = 0.0;
    foreach ($extras as $extra) { $suma += $precios[$extra]; }
    return $suma;
}
function calcularTotal(float $precioBase, float $precioExtras, int $cantidad): float
{
    return ($precioBase + $precioExtras) * $cantidad;
}

$errores = [];
$resultado = [];
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    $errores[] = 'Debes enviar el formulario mediante POST.';
} else {
    $nombre = texto('nombre', $errores);
    $tipo = texto('tipo', $errores);
    $cantidadTexto = texto('cantidad', $errores);
    if ($nombre === '') { $errores[] = 'El nombre es obligatorio.'; }
    if (!in_array($tipo, ['tortilla', 'pollo', 'vegetal'], true)) {
        $errores[] = 'Tipo de bocadillo no permitido.';
    }
    $cantidad = filter_var($cantidadTexto, FILTER_VALIDATE_INT, [
        'options' => ['min_range' => 1, 'max_range' => 10]
    ]);
    if ($cantidad === false) { $errores[] = 'Cantidad: entero entre 1 y 10.'; }
    $recibidos = $_POST['extras'] ?? [];
    $extras = [];
    if (!is_array($recibidos)) {
        $errores[] = 'Los extras deben recibirse como un array.';
    } else {
        foreach ($recibidos as $extra) {
            if (!is_string($extra) || !in_array($extra, ['queso', 'tomate', 'salsa'], true)) {
                $errores[] = 'Extra no permitido.';
            } elseif (!in_array($extra, $extras, true)) {
                // No cobrar dos veces una casilla repetida en una petición manipulada.
                $extras[] = $extra;
            }
        }
    }
    if (!$errores) {
        $base = obtenerPrecioBocadillo($tipo);
        $precioExtras = calcularPrecioExtras($extras);
        $total = calcularTotal($base, $precioExtras, $cantidad);
        $resultado = ["Cliente: $nombre", "Bocadillo: $tipo",
            'Extras: ' . ($extras ? implode(', ', $extras) : 'Sin extras'),
            'Precio por unidad con extras: ' . number_format($base + $precioExtras, 2, ',', '.') . ' €',
            "Cantidad: $cantidad", 'Total: ' . number_format($total, 2, ',', '.') . ' €'];
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Resultado</title></head>
<body>
<?php if ($errores): ?>
    <h1>Revisa los datos</h1>
    <ul><?php foreach ($errores as $error): ?>
        <li><?= escapar($error) ?></li>
    <?php endforeach; ?></ul>
<?php else: ?>
    <h1>Resultado</h1>
    <ul><?php foreach ($resultado as $linea): ?>
        <li><?= escapar($linea) ?></li>
    <?php endforeach; ?></ul>
<?php endif; ?>
<p><a href="formulario.html">Volver al formulario</a></p>
</body></html>
