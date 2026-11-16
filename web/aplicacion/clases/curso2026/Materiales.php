<?php

enum Materiales: int{

    case Madera = 5;
    case Hierro = 10;
    case Cristal = 15;
    case Plastico = 20;

     /**
     * Método descripcion que devuelve el nombre del caso concreto
     *
     * @return string
     */
    public function descripcion() : string {
        return $this->name;       
    }

    /**
     * Método valor que devuelve el valor del caso concreto.

     *
     * @return integer
     */    
    public function valor() : int  {
        return $this->value;    
    }


    /**
     * Método estático casos que devuelve un array con todos los casos
     *
     * @return array
     */
    public static function casos() : array{
        $arrayCasos = [ 
            self::Madera,
            self::Hierro,
            self::Cristal,
            self::Plastico
        ];

        return $arrayCasos;
    }




}