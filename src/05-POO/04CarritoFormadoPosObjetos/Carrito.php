<?php
require_once "Producto.php";
class Carrito{
private array $lineas =[];

public function __construct(array $lineas = []){
$this->lineas = $lineas;}



public function agregar(Producto $producto, int $cantidad){
    if(!in_array($producto, $this->lineas,true)){
       $this->lineas[] = $producto;
    }

}
}


