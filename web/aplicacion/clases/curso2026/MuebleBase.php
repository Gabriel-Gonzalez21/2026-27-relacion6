<?php

abstract class MuebleBase{

    private const MAXIMO_MUEBLES = 1000;
    private static int $_mueblesCreados = 0;

    private string $_nombre;
    private string $_fabricante = "FaMu";
    private string $_pais = "ESPAÑA";
    private int $_anio = 2020;
    private string $_fechaIniVenta = "01/01/2020";
    private string $_fechaFinVenta = "31/12/2040";
    private float $_precio = 30;




    //-----------------------GETTERS Y SETTERS---------------------------------

    //--------------------Nombre
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

    //----------------------Fabricante
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


    //-------------------------Pais
    public function setPais(string $pais): bool{
        $pais = trim($pais);

        if(!validaCadena($pais, 20,"ESPAÑA")){
            return false;
        }

        $this->_pais = $pais;
        return true;
    }

    public function getPais(): string{
        return $this->_pais;
    }

    //-----------------------Año
    public function setAnio(int $anio): bool{

        $añoActual = date("Y");

        if(!validaEntero($anio, 2020, $añoActual, 2020)){
            return false;
        }

        $this->_anio = $anio;
        return true;
    }

    public function getAnio(): int{
        return $this->_anio;
    }

    //----------------------Fecha ini venta
    public function setFechaIniVenta(string $fechaIniVenta): bool{
        if (!validaFecha($fechaIniVenta, "01/01/2020")) {
            return false;
        }

        $fechaVenta = DateTime::createFromFormat("d/m/Y", $fechaIniVenta);

        $fechaMinima = DateTime::createFromFormat("d/m/Y", "01/01/" . $this->_anio);

        if ($fechaVenta < $fechaMinima) {
            return false;
        }

        $this->_fechaIniVenta = $fechaIniVenta;

        return true;
    }

    public function getFechaIniVenta(): string{
        return $this->_fechaIniVenta;
    }


    //---------------------Fecha fin venta
    public function setFechaFinVenta(string $fechaFinVenta): bool{
        if (!validaFecha($fechaFinVenta, "31/12/2040")) {
            return false;
        }

        $fin = DateTime::createFromFormat("d/m/Y", $fechaFinVenta);

        $inicio = DateTime::createFromFormat("d/m/Y", $this->_fechaIniVenta);

        if ($fin < $inicio) {
            return false;
        }

        $this->_fechaFinVenta = $fechaFinVenta;

        return true;
    }

    public function getFechaFinVenta(): string{
        return $this->_fechaFinVenta;
    }


    //-------------------Precio
    public function setPrecio(float $precio): bool{
        if ($precio < 30) {
            return false;
        }

        $this->_precio = $precio;

        return true;
    }
    
    public function getPrecio(): float{
        return $this->_precio;
    }





    //--------------------------------CONSTRUCTOR----------------------------------------
    public function __construct(string $nombre, string $fabricante = "FaMu:", string $pais = "ESPAÑA", int $anio = 2020,
                                string $fechaIniVenta = "01/01/2020",string $fechaFinVenta = "31/12/2040",float $precio = 30){

        if (!$this->setNombre($nombre)) {
            throw new Exception("Nombre incorrecto");
        }

        if (!$this->setFabricante($fabricante)) {
            $this->_fabricante = "FaMu:";
        }

        if (!$this->setPais($pais)) {
            $this->_pais = "ESPAÑA";
        }

        if (!$this->setAnio($anio)) {
            $this->_anio = 2020;
        }

        if (!$this->setFechaIniVenta($fechaIniVenta)) {
            $this->_fechaIniVenta =
                "01/01/" . $this->_anio;
        }

        if (!$this->setFechaFinVenta($fechaFinVenta)) {
            $this->_fechaFinVenta = "31/12/2040";
        }

        if (!$this->setPrecio($precio)) {
            $this->_precio = 30;
        }

        if (self::$_mueblesCreados >= self::MAXIMO_MUEBLES) {
            throw new Exception("Alcanzado el número máximo de muebles");
        }


        self::$_mueblesCreados++;
    }





    abstract public function damePropiedadesAdicionales(): array;



    /**
     * Método de clase puedeCrear que devuelve true si se pueden crear más instancias de la
     * clase y false en caso contrario. Además, devuelve en el parámetro Número el número de
     * muebles que aún se pueden crear de la clase.
     *
     * @param integer $numero
     * @return boolean
     */
    public static function puedeCrear(int &$numero): bool{

        $numero = self::MAXIMO_MUEBLES - self::$_mueblesCreados;

        if ($numero > 0){
            return true;
        }

        return false;
    }


    /**
     * Método toString
     *
     * @return string
     */
    public function __toString(): string{
        return "MUEBLE de clase " .get_class($this) ." con nombre " .$this->_nombre .", fabricante " .
            $this->_fabricante .", fabricado en " .$this->_pais ." a partir del año " .$this->_anio .
            ", vendido desde " .$this->_fechaIniVenta ." hasta " .$this->_fechaFinVenta .", precio " .$this->_precio;
    }


}