<?php

class PlazasAgotadasException extends RuntimeException
{
}

class Reserva
{
    private int $plazas;
    private string $estadoTemporal = "iniciada";

    public function __construct(int $plazas)
    {
        if ($plazas < 0) {
            throw new InvalidArgumentException("Las plazas no pueden ser negativas");
        }

        $this->plazas = $plazas;
    }

    public function reservar(int $cantidad): void
    {
        if ($cantidad <= 0) {
            throw new InvalidArgumentException("La cantidad debe ser positiva");
        }

        if ($cantidad > $this->plazas) {
            throw new PlazasAgotadasException("No hay plazas suficientes");
        }

        $this->plazas -= $cantidad;
    }

    public function disponibles(): int
    {
        return $this->plazas;
    }

    public function estado(): string
    {
        return $this->estadoTemporal;
    }

    public function __serialize(): array
    {
        return ["plazas" => $this->plazas];
    }

    public function __unserialize(array $datos): void
    {
        if (!isset($datos["plazas"]) || !is_int($datos["plazas"]) || $datos["plazas"] < 0) {
            throw new UnexpectedValueException("Estado de reserva no válido");
        }

        $this->plazas = $datos["plazas"];
        $this->estadoTemporal = "restaurada";
    }
}

class ReservaLegada
{
    private int $plazas;
    private string $estadoTemporal = "iniciada";

    public function __construct(int $plazas)
    {
        $this->plazas = $plazas;
    }

    public function disponibles(): int
    {
        return $this->plazas;
    }

    public function estado(): string
    {
        return $this->estadoTemporal;
    }

    public function resumen(): string
    {
        return $this->plazas . " - " . $this->estadoTemporal;
    }

    public function __sleep(): array
    {
        return ["plazas"];
    }

    public function __wakeup(): void
    {
        $this->estadoTemporal = "restaurada";
    }
}
