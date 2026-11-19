<?php

class Producto {

    private string $codigo;
    private string $nombre;
    private int $precio;
    private int $stock;

    public function __construct(string $codigo, string $nombre, int $precio, int $stock) {

        if (trim($codigo) === "") {
            throw new InvalidArgumentException("Código incorrecto");
        }

        if (trim($nombre) === "") {
            throw new InvalidArgumentException("Nombre incorrecto");
        }

        if ($precio <= 0) {
            throw new InvalidArgumentException("El precio debe ser mayor que 0");
        }

        if ($stock < 0) {
            throw new InvalidArgumentException("El stock no puede ser negativo");
        }

        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->stock = $stock;
    }

    public function reponer(int $cantidad): bool {

        if ($cantidad <= 0) {
            return false;
        }

        $this->stock += $cantidad;
        return true;
    }

    public function vender(int $cantidad): bool {

        if ($cantidad <= 0 || $cantidad > $this->stock) {
            return false;
        }

        $this->stock -= $cantidad;
        return true;
    }

    // Devuelve el valor del stock en céntimos.
    public function calcularValorStock(): int {

        return $this->stock ;
    }
}

