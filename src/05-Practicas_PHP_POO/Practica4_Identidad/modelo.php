<?php

class Direccion
{
    public function __construct(public string $ciudad)
    {
    }
}

class Ficha
{
    public function __construct(
        public string $nombre,
        public Direccion $direccion
    ) {
    }

    public function __toString(): string
    {
        return $this->nombre . " - " . $this->direccion->ciudad;
    }

    public function __clone()
    {
        $this->direccion = clone $this->direccion;
    }
}

function mudar(Ficha $ficha, string $ciudad): void
{
    $ficha->direccion->ciudad = $ciudad;
}

function copiaEn(Ficha $ficha, string $ciudad): Ficha
{
    $copia = clone $ficha;
    $copia->direccion->ciudad = $ciudad;

    return $copia;
}

class Testigo
{
    public function __destruct()
    {
        echo "Testigo destruido" . PHP_EOL;
    }
}
