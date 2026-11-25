<?php

namespace Centro\Biblioteca;

class Usuario
{
    public const ROL = "lector";

    public function __construct(public readonly string $nombre)
    {
    }
}
