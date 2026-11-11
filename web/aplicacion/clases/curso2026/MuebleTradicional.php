<?php

final class MuebleTradicional extends MuebleBase{

    private float $_peso = 15;
    private string $_serie = "S01";


    //-------------------------CONTRUCTOR--------------------------------------
    public function __construct(string $nombre, string $fabricante = "FaMu:", string $pais = "ESPAÑA", 
                                int $anio = 2020, string $fechaIniVenta = "01/01/2020", string $fechaFinVenta = "31/12/2040", 
                                float $precio = 30, float $peso = 15, string $serie = "S01")
    {
        parent::__construct($nombre, $fabricante, $pais, $anio, $fechaIniVenta, $fechaFinVenta, $precio);

        if (!$this->setPeso($peso)) {
            $this->_peso = 15;
        }

        if (!$this->setSerie($serie)) {
            $this->_serie = "S01";
        }
    }



    //-----------------------GETTERS Y SETTERS---------------------------------

    //-----------------Peso
    public function setPeso( float $peso) : bool {

        if (!validaReal($peso, 15, 300, 15)){
            return false;
        }

        $this->_peso = $peso;
        return true;
    }

    public function getPeso() : float {
        return $this->_peso;
    }

    //-----------------Serie
    public function setSerie(string $serie): bool{

        if ($serie == "") {
            return false;
        }

        $this->_serie = $serie;

        return true;
    }

    public function getSerie() : string {
        return $this->_serie;
    }


    /**
     * Método que devuelve el array con los nombres de las propiedades adicionales de esta clase
     *
     * @return array
     */
    public function damePropiedadesAdicionales(): array{
        
        return ["peso", "serie"];   
    }


    /**
     * Métdo toString()
     *
     * @return string
     */
    public function __toString(): string
    {
        return parent::__toString(). ", peso: ". $this->_peso. ", serie: ". $this->_serie;
    }
}