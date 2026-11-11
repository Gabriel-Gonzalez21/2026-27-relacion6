<?php

final class MuebleReciclado extends MuebleBase {

    private int $_porcentajeReciclado = 10;


    //-----------------------CONSTRUCTOR--------------------------------------
    public function __construct(string $nombre, string $fabricante = "FaMu:", string $pais = "ESPAÑA", int $anio = 2020, 
                                string $fechaIniVenta = "01/01/2020", string $fechaFinVenta = "31/12/2040", 
                                float $precio = 30, int $porcentajeReciclado = 10){

        parent::__construct($nombre, $fabricante, $pais, $anio, $fechaIniVenta, $fechaFinVenta, $precio);

        if (!$this->setPorcentajeReciclado($porcentajeReciclado)) {
            $this->_porcentajeReciclado = 10;
        }

    }



    //-----------------------GETTERS Y SETTERS---------------------------------
    public function setPorcentajeReciclado(int $porcentaje): bool{

        if (!validaEntero($porcentaje, 0, 100, 10)){
            return false;
        }

        $this->_porcentajeReciclado = $porcentaje;
        return true;

    }

    public function getPorcentajeReciclado (): int {
        return $this->_porcentajeReciclado;
    }




    /**
     * Método que devuelve el array con los nombres de las propiedades adicionales de esta clase
     *
     * @return array
     */
    public function damePropiedadesAdicionales(): array{
        
        return ["porcentajeReciclado"];   
    }


    /**
     * Método toString()
     *
     * @return string
     */
    public function __toString(): string
    {
        return parent::__toString(). ", porcentaje reciclado: ". $this->_porcentajeReciclado;
    }

}