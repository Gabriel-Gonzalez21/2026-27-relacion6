<?php

include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once(dirname(__FILE__) . "/datos.php");

//controlador

//Mostrar mueble seleccionado
$muebleSeleccionado = null;

if (isset($_POST["mostrar"])) {

    $indice = (int)$_POST["idMueble"];

    if (isset($muebles[$indice])) {

        $muebleSeleccionado = $muebles[$indice];
    }
}


//Modificar mueble seleccionado
if (isset($_POST["modificar"])) {

    $indice = (int)$_POST["idMueble"];

    header("Location: modificar.php?id=". $indice);

    exit;
}



$barraUbi = [
    [
        "TEXTO" => "Inicio",
        "LINK"  => "/index.php"
    ],
    [
        "TEXTO" => "formulario",
        "LINK"  => ""
    ]
];





//dibuja la plantilla de la vista
inicioCabecera("TIENDA");
cabecera();
finCabecera();
inicioCuerpo("TIENDA", $barraUbi);
cuerpo($muebles, $muebleSeleccionado); // llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}

//vista
function cuerpo(array $muebles, ?MuebleBase $muebleSeleccionado)
{
?>
    <br><br>

    <h2>Muebles almacenados</h2>

    <table border="1">

        <tr>
            <th>Índice</th>
            <th>Tipo</th>
            <th>Nombre</th>
            <th>País</th>
            <th>Precio</th>
            <th>Material</th>
        </tr>

        <?php

        foreach ($muebles as $indice => $mueble) {

        ?>

            <tr>

                <td> <?= $indice ?> </td>

                <td> <?= get_class($mueble) ?> </td>

                <td> <?= $mueble->getNombre() ?> </td>

                <td> <?= $mueble->getPais() ?> </td>

                <td> <?= $mueble->getPrecio() ?> </td>

                <td> <?= $mueble->getMaterialDescripcion() ?> </td>

            </tr>

        <?php

        }

        ?>

    </table>

    <br><br>

    <form method="post">
        <label for="idMueble">Seleccione un mueble:</label>
        <select name="idMueble" id="idMueble">

            <?php

            foreach ($muebles as $indice => $mueble) {
                
            ?>
                <option value="<?= $indice ?>">

                    <?= $indice ?> - <?= $mueble->getNombre() ?>

                </option>
            <?php
            }
            ?>

        </select>

        <br><br>

        <input type="submit" name="mostrar" value="Mostrar Mueble">
        <input type="submit" name="modificar" value="Modificar Mueble">

    </form>


    <!--Mostrar el mueble seleccionado-->

    <?php

    if ($muebleSeleccionado !== null) {

    ?>

        <hr>
        <h2>Mueble seleccionado</h2>

        <p><strong>Tipo:</strong> <?= get_class($muebleSeleccionado) ?></p>

        <p><strong>Nombre:</strong><?= $muebleSeleccionado->getNombre() ?></p>

        <p><strong>Fabricante:</strong><?= $muebleSeleccionado->getFabricante() ?></p>

        <p><strong>País:</strong><?= $muebleSeleccionado->getPais() ?></p>

        <p><strong>Año:</strong><?= $muebleSeleccionado->getAnio() ?></p>

        <p><strong>Fecha inicio venta:</strong><?= $muebleSeleccionado->getFechaIniVenta() ?></p>

        <p><strong>Fecha fin venta:</strong><?= $muebleSeleccionado->getFechaFinVenta() ?></p>

        <p><strong>Precio:</strong><?= $muebleSeleccionado->getPrecio() ?></p>

        <p><strong>Material:</strong><?= $muebleSeleccionado->getMaterialDescripcion() ?></p>

        <h3>Propiedades adicionales</h3>

            <?php

            foreach ($muebleSeleccionado->damePropiedadesAdicionales() as $propiedad) {
                echo $propiedad . "<br>";
            }

            ?>

            <h3>Características</h3>

            <?php

            foreach ($muebleSeleccionado->getCaracteristicas() as $nombre => $valor) {
                echo $nombre ." : " .$valor ."<br>";
            }

            ?>

        <?php

    }

    ?>

<?php
}