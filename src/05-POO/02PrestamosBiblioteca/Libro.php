<?php
class Libro
{

    private $titulo;
    private $autor;
    private $prestado;

    public function __construct($titulo, $autor, $prestado){
        if ($titulo !== ""){
        $this->titulo = $titulo;}
        $this->autor = $autor;
        $this->prestado = false;
    }
    public function getTitulo()
    {
        return $this->titulo;
    }


    public function getAutor()
    {
        return $this->autor;
    }

    public function getPrestado(): bool
    {
        return $this->prestado;
    }

    public function prestar(): bool
    {
        if ($this->prestado == false) {
            $this->prestado = true;
            return true;

        }else{
            return false;
        }
    }

    public function devolver():bool{
        if ($this->prestado == true){
            $this->prestado = false;
            return true;
        }else{
            return false;
        }
}
    public function obtenerFicha(): string {
        return $this->titulo . " - " . $this->autor . " - " . ($this->prestado ? "Prestado" : "Disponible")."<br>";

    }

}