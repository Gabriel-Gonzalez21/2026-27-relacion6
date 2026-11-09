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


    public function __construct($nombre , $fabricante, $pais, $anio, $fechaIniVenta, $fechaFinVenta, $precio)
    {

    }


}