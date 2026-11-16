<?php

include_once(dirname(__FILE__) . "/../../cabecera.php");

require_once(RUTABASE ."/scripts/librerias/validacion.php");


// ------------------------------------CONTROLADOR----------------------------------


$barraUbi = [
    [
        "TEXTO" => "Inicio",
        "LINK"  => "/index.php"
    ],
    [
        "TEXTO" => "Pruebas",
        "LINK"  => ""
    ]
];

$muebleReciclado = new MuebleReciclado(
    "Mesa",
    "Ikea",
    "España",
    2023,
    "01/01/2023",
    "31/12/2030",
    150,
    80
);

$muebleReciclado->anadirCaracteristicas(
    "color",
    "rojo",
    "material",
    "madera",
    "pesoVisual",
    20
);

$muebleTradicional = new MuebleTradicional(
    "Armario",
    "Leroy",
    "España",
    2024,
    "01/02/2024",
    "31/12/2035",
    300,
    75,
    "A001"
);

$restantes = 0;

$puedeCrear = MuebleBase::puedeCrear($restantes);



//--------------------------------VISTA------------------------------------


inicioCabecera("TIENDA");
cabecera();
finCabecera();

inicioCuerpo("TIENDA",$barraUbi);

cuerpo($muebleReciclado, $muebleTradicional, $puedeCrear,$restantes);

finCuerpo();


//------------------------------FUNCIONES DE VISTA-----------------------------------------


function cabecera()
{
}

function cuerpo(MuebleReciclado $muebleReciclado, MuebleTradicional $muebleTradicional, bool $puedeCrear,int $restantes)
{
?>
    <br><br>

    <h2>Pruebas tienda</h2>

    <h3>Mueble reciclado</h3>

    <p><?= $muebleReciclado ?></p>

    <hr>

    <h3>Mueble tradicional</h3>

    <p><?= $muebleTradicional ?></p>

    <hr>


    <h3>Características del mueble reciclado</h3>

    <?php

    foreach (
        $muebleReciclado
            ->getCaracteristicas()
        as $nombre => $valor
    ) {
        echo $nombre. " => ". $valor. "<br>";
    }

    ?>

    <hr>

    <h3>Prueba puedeCrear()</h3>

    <?php

    if ($puedeCrear) {
        echo "Se pueden crear más muebles";
    } else {
        echo "No se pueden crear más muebles";
    }

    echo "<br>";

    echo "Restantes: "
        . $restantes;

?>

<?php
}