<?php

class Caracteristicas implements Iterator{

    private array $_caracteristicas = [];

    private array $_iterador = [];

    private mixed $_numero_serie;

    //permitir propiedades dinamicas: 

    public function __set(string $nombre, mixed $valor): void{

        //Si ya existe ULTIMA y estoy intentando crear una característica nueva salta un error
        if(isset($this->_caracteristicas["ULTIMA"]) && !array_key_exists($nombre, $this->_caracteristicas)){
            throw new Exception("No pueden añadirse más características");
        }

        $this->_caracteristicas[$nombre] = $valor;
    }


    public function __get(string $nombre): mixed
    {
        return $this->_caracteristicas[$nombre];
    }




    //Implementación de iterator:

    //Las características pueden ser recorridas en un foreach devolviendo las propiedades en orden inverso a como se incorporaron.
    public function rewind(): void {

        $this->_iterador = array_reverse($this->_caracteristicas,true);

        reset($this->_iterador);
    }


    public function current(): mixed {
        return current($this->_iterador);
    }


    public function key(): mixed {
        return key($this->_iterador);
    }

    public function next(): void {
        next($this->_iterador);
    }

    public function valid(): bool{
        return key($this->_iterador) !== null;
    }



    //toString
    public function __toString(): string{
        $resultado = "";

        foreach ($this->_caracteristicas as $clave => $valor) {
            $resultado .= $clave . ":" .$valor .";";
        }

        return $resultado;
    }

}