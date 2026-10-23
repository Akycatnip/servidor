<?php
$productos = [
    ['nombre' => 'Teclado', 'precio' => 25.00, 'stock' => 4],
    ['nombre' => 'Ratón', 'precio' => 15.50, 'stock' => 0],
    ['nombre' => 'Monitor', 'precio' => 120.00, 'stock' => 2],
    ['nombre' => 'Cable USB', 'precio' => 6.00, 'stock' => 8]
];

function estadoStock(int $stock): string
{
    if ($stock === 0) {
        return 'Agotado';
    }
    if ($stock < 3) {
        return 'Stock bajo';
    }
    return 'Disponible';
}

$totalInventario = 0.00;
$productosAReponer = 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 2: control de existencias</title>
</head>
<body>
    <h1>Control de existencias</h1>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio unitario</th>
                <th>Unidades</th>
                <th>Valor de las existencias</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $producto): ?>
                <?php
                $valor = $producto['precio'] * $producto['stock'];
                $totalInventario += $valor;
                // Se cuentan productos, no unidades que faltan.
                if ($producto['stock'] < 3) {
                    $productosAReponer++;
                }
                $estado = estadoStock($producto['stock']);
                ?>
                <tr>
                    <td><?= htmlspecialchars($producto['nombre'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= number_format($producto['precio'], 2, ',', '.') ?> €</td>
                    <td><?= $producto['stock'] ?></td>
                    <td><?= number_format($valor, 2, ',', '.') ?> €</td>
                    <td><?= htmlspecialchars($estado, ENT_QUOTES, 'UTF-8') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <p>Valor total: <?= number_format($totalInventario, 2, ',', '.') ?> €</p>
    <p>Productos que requieren reposición: <?= $productosAReponer ?></p>
</body>
</html>
