<?php

abstract class MuebleBase{

    private const MAXIMO_MUEBLES = 0;
    private static int $_mueblesCreados = 0;

    private string $_nombre;
    private string $_fabricante = "FaMu";
    private string $_pais = "ESPAÑA";
    private int $_anio = 2020;
    private string $_fechaIniVenta = "01/01/2020";
    private string $_fechaFinVenta = "31/12/2040";
    private float $_precio = 30;




    //-----------------------GETTERS Y SETTERS---------------------------------

    //Nombre
    public function setNombre(string $nombre): bool{
        $nombre = trim($nombre);

        if($nombre == ""){
            return false;
        }
        if(!validaCadena($nombre, 40,"")){
            return false;
        }

        $this->_nombre = mb_strtoupper($nombre);
        return true;
    }

    public function getNombre(): string{
        return $this->_nombre;
    }

    //Fabricante
    public function setFabricante(string $fabricante): bool{

        if (mb_substr($fabricante, 0, 5) !== "FaMu:") {
            $fabricante = "FaMu:" . $fabricante;
        }

        if (!validaCadena($fabricante, 30, "FaMu:")) {
            $fabricante = mb_substr($fabricante,0,30);
            return false;
        }

        $this->_fabricante = $fabricante;

        return true;
    }

    public function getFabricante(): string{
        return $this->_fabricante;
    }








    public function __construct($nombre , $fabricante, $pais, $anio, $fechaIniVenta, $fechaFinVenta, $precio)
    {

    }


}