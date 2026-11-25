<?php
interface Canal{
    public function enviar(string $mensaje);
}

interface CanalConHistorial extends Canal{
    public function historial(): array;
}

interface Reiniciable{
    public function reiniciar(): void;
}

class CanalMemoria implements CanalConHistorial, Reiniciable{

    private array $mensajes = [];

    public function enviar(string $mensaje){
        $this -> mensajes[] = $mensaje;
        return "MEMORIA: " . $mensaje;
}

public function historial(): array
{
    return $this->mensajes;
}

public function reiniciar(): void
{
    $this->mensajes = [];
}
}

class CanalPantalla implements Canal{
    public function enviar(string $mensaje){
        return "PANTALLA: " . $mensaje;
    }
}

class ServiciosAviso {
    private Canal $canal;
    public function __construct(Canal $canal){
        $this->canal = $canal;
    }
    public function avisar(string $mensaje){
        return $this->canal -> enviar($mensaje);
    }
}
