<?php

class Caracteristicas implements Iterator{

    private array $_caracteristicas = [];

    private array $_datosIterator = [];


    public function __set(string $nombre,mixed $valor): void{
        $this->_caracteristicas[$nombre] = $valor;
    }

}