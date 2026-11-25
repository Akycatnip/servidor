<?php

class Registro
{
    private array $datos = [];

    public function __set(string $nombre, mixed $valor): void
    {
        if ($nombre !== "tema" && $nombre !== "idioma") {
            throw new InvalidArgumentException("Propiedad no permitida: " . $nombre);
        }

        if (!is_string($valor) || trim($valor) === "") {
            throw new InvalidArgumentException("El valor debe ser una cadena no vacía");
        }

        $this->datos[$nombre] = trim($valor);
    }

    public function __get(string $nombre): mixed
    {
        return $this->datos[$nombre] ?? null;
    }

    public function __isset(string $nombre): bool
    {
        return isset($this->datos[$nombre]);
    }

    public function __unset(string $nombre): void
    {
        unset($this->datos[$nombre]);
    }

    public function __call(string $nombre, array $argumentos): mixed
    {
        if ($nombre === "obtener" && count($argumentos) === 1 && is_string($argumentos[0])) {
            return $this->datos[$argumentos[0]] ?? null;
        }

        throw new BadMethodCallException("Llamada no permitida: " . $nombre);
    }

    public static function __callStatic(string $nombre, array $argumentos): mixed
    {
        if ($nombre === "crear" && count($argumentos) === 0) {
            return new self();
        }

        throw new BadMethodCallException("Llamada estática no permitida: " . $nombre);
    }

    public function __invoke(string $clave): mixed
    {
        return $this->datos[$clave] ?? null;
    }

    public function __toString(): string
    {
        return json_encode($this->datos);
    }

    public function __debugInfo(): array
    {
        return ["cantidad" => count($this->datos)];
    }

    public static function __set_state(array $datos): Registro
    {
        $registro = new self();
        $registro->datos = $datos["datos"] ?? [];

        return $registro;
    }
}
