<?php

namespace Centro\Academia;

class Usuario
{
    public const ROL = "alumno";

    private static int $contador = 0;

    public function __construct(public readonly string $nombre)
    {
        self::$contador++;
    }

    public static function totalCreados(): int
    {
        return self::$contador;
    }
}
