<?php

include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once(dirname(__FILE__) . "/datos.php");


//controlador
$muebleMostrar = null;
$indiceSeleccionado = 1;

if (isset($_POST["indice"])) {
    $indiceSeleccionado = (int)$_POST["indice"];

    if (isset($_POST["btnMostrar"]) && isset($muebles[$indiceSeleccionado])) {
        $muebleMostrar = $muebles[$indiceSeleccionado];
    }
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
inicioCuerpo("TIENDA");
cuerpo($muebles, $muebleMostrar, $indiceSeleccionado); // llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}

//vista
function cuerpo($muebles, $muebleMostrar, $indiceSeleccionado)
{
?>
    <br><br>

    <h2>Listado de Muebles</h2>
    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>Índice</th>
                <th>Tipo</th>
                <th>Nombre</th>
                <th>Fabricante</th>
                <th>País</th>
                <th>Año</th>
                <th>Precio</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($muebles as $indice => $mueble): ?>
                <tr>
                    <td><?php echo $indice; ?></td>
                    <td><?php echo get_class($mueble); ?></td>
                    <td><?php echo $mueble->getNombre(); ?></td>
                    <td><?php echo $mueble->getFabricante(); ?></td>
                    <td><?php echo $mueble->getPais(); ?></td>
                    <td><?php echo $mueble->getAnio(); ?></td>
                    <td><?php echo $mueble->getPrecio(); ?> €</td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>

    <br>

    <h2>Operaciones con Muebles</h2>
    <form method="post" action="">
        <label for="indice">Seleccione un mueble:</label>
        <select name="indice" id="indice">
            <?php foreach ($muebles as $indice => $mueble): ?>
                <option value="<?php echo $indice; ?>">
                    <?php echo $indice . " - " . $mueble->getNombre() . " (" . get_class($mueble) . ")"; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <!-- botón que envía el formulario a esta misma página -->
        <input type="submit" name="btnMostrar" value="Mostrar Mueble">

        <!-- botón que envía el formulario a modificar.php en una nueva ventana -->
        <input type="submit" name="btnModificar" value="Modificar Mueble" formaction="modificar.php" formtarget="_blank">
    </form>


    <!-- Muestra las propiedades si se pulsó "Mostrar Mueble" -->
    <?php if ($muebleMostrar !== null): ?>
        <hr>
        <h3>Propiedades del Mueble (Índice <?php echo $indiceSeleccionado; ?>)</h3>
        <p><strong>Tipo:</strong> <?php echo get_class($muebleMostrar); ?></p>
        <p><strong>Nombre:</strong> <?php echo $muebleMostrar->getNombre(); ?></p>
        <p><strong>Fabricante:</strong> <?php echo $muebleMostrar->getFabricante(); ?></p>
        <p><strong>País:</strong> <?php echo $muebleMostrar->getPais(); ?></p>
        <p><strong>Año:</strong> <?php echo $muebleMostrar->getAnio(); ?></p>
        <p><strong>Fecha Inicio Venta:</strong> <?php echo $muebleMostrar->getFechaIniVenta(); ?></p>
        <p><strong>Fecha Fin Venta:</strong> <?php echo $muebleMostrar->getFechaFinVenta(); ?></p>
        <p><strong>Precio:</strong> <?php echo $muebleMostrar->getPrecio(); ?> €</p>

        <!-- propiedades adicionales dinámicas -->
        <?php foreach ($muebleMostrar->damePropiedadesAdicionales() as $prop): ?>
            <?php $metodoGet = "get" . ucfirst($prop); ?>
            <p><strong><?php echo $prop; ?>:</strong> <?php echo $muebleMostrar->$metodoGet(); ?></p>
        <?php endforeach; ?>

        <!-- características adicionales -->
        <p><strong>Características:</strong></p>
        <ul>
            <?php foreach ($muebleMostrar->getCaracteristicas() as $clave => $valor): ?>
                <li><?php echo $clave . ": " . (is_bool($valor) ? ($valor ? "Sí" : "No") : $valor); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
<?php
}