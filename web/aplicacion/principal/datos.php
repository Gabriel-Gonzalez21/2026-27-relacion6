<?php

$mueble1 = new MuebleReciclado("Mesa de comedor", "Ikea", "SUECIA", 2022, "10/02/2022", "31/12/2035", 150.50, 80);
$mueble1->anadirCaracteristicas("Material", "Madera reciclada", "Color", "Roble");

$mueble2 = new MuebleTradicional("Silla clásica", "Muebles Pepe", "ESPAÑA", 2021, "15/05/2021", "31/12/2030", 65.00, 18.5, "S02");
$mueble2->anadirCaracteristicas("Tapizado", "Terciopelo", "Apilable", false);

$mueble3 = new MuebleReciclado("Estantería modular", "EcoHogar", "PORTUGAL", 2023, "01/03/2023", "31/12/2040", 95.00, 95);
$mueble3->anadirCaracteristicas("Baldas", 5, "Acabado", "Mate");

$mueble4 = new MuebleTradicional("Armario ropero", "RobleSur", "ESPAÑA", 2020, "01/06/2020", "31/12/2030", 450.00, 120.0, "S01");
$mueble4->anadirCaracteristicas("Puertas", 3, "Espejo", true);

$mueble5 = new MuebleReciclado("Escritorio juvenil", "GreenDesk", "FRANCIA", 2024, "10/01/2024", "31/12/2038", 180.00, 60);
$mueble5->anadirCaracteristicas("Cajones", 2, "Ruedas", true);


//array indexado a partir de la posición 1
$muebles = [
    1 => $mueble1,
    2 => $mueble2,
    3 => $mueble3,
    4 => $mueble4,
    5 => $mueble5
];
