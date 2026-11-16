<?php

include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once(dirname(__FILE__) . "/datos.php");

//controlador

$id = (int)($_GET["id"] ?? $_POST["id"] ?? 0);

$mueble = null;

if (isset($muebles[$id])) {
    $mueble = $muebles[$id];
}

$errores = [];
$resumen = false;

if ($mueble !== null && isset($_POST["guardar"])) {

    $nombre = trim($_POST["nombre"]);
    $pais = trim($_POST["pais"]);
    $precio = (float)$_POST["precio"];

    if (!$mueble->setNombre($nombre)) {
        $errores[] = "Nombre incorrecto";
    }

    if (!$mueble->setPais($pais)) {
        $errores[] = "País incorrecto";
    }

    if (!$mueble->setPrecio($precio)) {
        $errores[] = "Precio incorrecto";
    }


    if ($mueble instanceof MuebleReciclado) {
        $porcentajeReciclado = (int)$_POST["porcentajeReciclado"];

        if (!$mueble->setPorcentajeReciclado($porcentajeReciclado)) {
            $errores[] = "Porcentaje reciclado incorrecto";
        }
    }

    if ($mueble instanceof MuebleTradicional) {
        $peso = (float)$_POST["peso"];

        $serie = trim($_POST["serie"]);

        if (!$mueble->setPeso($peso)) {
            $errores[] = "Peso incorrecto";
        }

        if (!$mueble->setSerie($serie)) {
            $errores[] = "Serie incorrecta";
        }
    }


    if (!$errores) {
        $resumen = true;
    }
}

//dibuja la plantilla de la vista
inicioCabecera("Modificar mueble");
cabecera();
finCabecera();
inicioCuerpo("TIENDA");
cuerpo($id, $mueble, $errores, $resumen );
finCuerpo();
// **********************************************************

//vista
function cabecera(){}

//vista
function cuerpo( int $id, ?MuebleBase $mueble, array $errores, bool $resumen) {

    if ($mueble === null) {
        echo "Mueble no encontrado";
        return;
    }

    if ($resumen) {
?>

        <h2>Resumen modificación</h2>

        <p>Nombre: <?= $mueble->getNombre() ?></p>
        <p>País: <?= $mueble->getPais() ?></p>
        <p>Precio: <?= $mueble->getPrecio() ?></p>

        <?php if ($mueble instanceof MuebleReciclado) { ?>
            <p>
                Porcentaje reciclado:
                <?= $mueble->getPorcentajeReciclado() ?>
            </p>
        <?php } ?>

        <?php if ($mueble instanceof MuebleTradicional) { ?>
            <p>
                Peso:<?= $mueble->getPeso() ?>
            </p>

            <p>
                Serie:<?= $mueble->getSerie() ?>
            </p>
        <?php } ?>

        <a href="index.php">Volver</a>

<?php
        return;
    }
?>

    <h2>Modificar mueble</h2>

    <?php
    foreach ($errores as $error) {
        echo $error . "<br>";
    }
    ?>

    <form method="post">

        <input type="hidden" name="id" value="<?= $id ?>">

        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?= $mueble->getNombre() ?>">

        <br><br>

        <label>País:</label>
        <input type="text" name="pais" value="<?= $mueble->getPais() ?>">

        <br><br>

        <label>Precio:</label>
        <input type="text" name="precio" value="<?= $mueble->getPrecio() ?>">

        <br><br>

        <?php if ($mueble instanceof MuebleReciclado) { ?>

            <label>Porcentaje reciclado:</label>

            <input type="text" name="porcentajeReciclado" value="<?= $mueble->getPorcentajeReciclado() ?>">

            <br><br>

        <?php } ?>

        <?php if ($mueble instanceof MuebleTradicional) { ?>

            <label>Peso:</label>

            <input type="text" name="peso" value="<?= $mueble->getPeso() ?>">

            <br><br>

            <label>Serie:</label>

            <input type="text" name="serie"value="<?= $mueble->getSerie() ?>">

            <br><br>

        <?php } ?>

        <input type="submit" name="guardar" value="Guardar">

    </form>

<?php
}