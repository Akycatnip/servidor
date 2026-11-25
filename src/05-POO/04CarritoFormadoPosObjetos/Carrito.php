<?php
require_once "Producto.php";
class Carrito{
private array $lineas =[];

public function __construct(array $lineas = []){
$this->lineas = $lineas;}



public function agregar(Producto $producto, int $cantidad): bool{
    if($cantidad <=0){
        return false;
    }
    $codigo = $producto->getCodigo();

    //si ya existe
    if(isset($this->lineas[$codigo])){
        $cantidad = $cantidad + $this->lineas[$codigo]["cantidad"];
    }
    //comprobamos q no supere el stock
    if($cantidad > $producto -> getStock()){
        return false;
    }
    //si no guardamos el producto y la cantidad

    $this->lineas[$codigo] = [
        "producto" => $producto,
        "cantidad" => $cantidad
    ];
    return true;
}

public function eliminar (string $codigo): bool{
    if(isset($this->lineas[$codigo])){
        return false;
    }
    unset($this->lineas[$codigo]);
    return true;
}

public function contarUnidades(): int {
    $total = 0;
    foreach($this->lineas as $linea){
        $total += $linea ["cantidad"];
    }
    return $total;
}

public function calcularTotal(): int {
    $total = 0;
    foreach($this->lineas as $linea){
        $total += $linea ["producto"]->getPrecio() * $linea ["cantidad"];
    }
    return $total;
}
}


