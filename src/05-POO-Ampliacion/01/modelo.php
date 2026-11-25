<?php
abstract class Envio{

    private  string $destino;
    protected float $peso;

    const BASE = 3.0;

    public function __construct(string $destino,float $peso){
        $destino = trim($destino);
        if ($destino ==="" || $peso<=0){
            throw new InvalidArgumentException("Alguno de los parámetros es incorrecto");

        }
        $this->destino = $destino;
        $this->peso = $peso;
    }

    abstract public function coste(): float;

    final public function  resumen():string{
        return $this->destino . " : " . number_format($this ->coste(), 2) . "€";
    }

}

class EnvioNormal extends Envio{
    public function coste(): float{
        return self::BASE+1.5* $this->peso;
    }
}

final class EnvioUrgente extends EnvioNormal{
    private float $recargo;

    public function __construct (string $destino,float $peso,float $recargo)
    {
        if($recargo <=0){
            throw new InvalidArgumentException("El recargo tiene que ser mayor que 0");
    }
        parent::__construct($destino,$peso);
        $this->recargo = $recargo;

    }
    public function coste():float{
            return parent::coste() + $this->recargo;
}

}
function imprimirEnvio(Envio $envio):void{
    echo $envio->resumen();
}