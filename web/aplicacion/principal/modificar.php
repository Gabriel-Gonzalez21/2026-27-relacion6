<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

//controlador

$id = $_POST["indice"] ?? null;

if (!$id || !isset($muebles[$id])) {
    header("Location: index.php");
    exit;
}

$mueble = $muebles[$id];
$tipo = get_class($mueble);
$errores = [];
$actualizado = false;

// Valores iniciales (del mueble o del POST si ya se envió el formulario de guardar)
$nombre = $_POST["nombre"] ?? $mueble->getNombre();
$fabricante = $_POST["fabricante"] ?? $mueble->getFabricante();
$pais = $_POST["pais"] ?? $mueble->getPais();
$anio = $_POST["anio"] ?? $mueble->getAnio();
$fechaIni = $_POST["fechaIniVenta"] ?? $mueble->getFechaIniVenta();
$fechaFin = $_POST["fechaFinVenta"] ?? $mueble->getFechaFinVenta();
$precio = $_POST["precio"] ?? $mueble->getPrecio();
$porcentaje = $_POST["porcentajeReciclado"] ?? ($tipo === "MuebleReciclado" ? $mueble->getPorcentajeReciclado() : "");
$peso = $_POST["peso"] ?? ($tipo === "MuebleTradicional" ? $mueble->getPeso() : "");
$serie = $_POST["serie"] ?? ($tipo === "MuebleTradicional" ? $mueble->getSerie() : "");

if (isset($_POST["btnGuardar"])) {

    //Mitad validada con objeto auxiliar y sus métodos set
    $aux = new $tipo("TEMP");
    if (!$aux->setNombre($nombre)) $errores[] = "Nombre inválido.";
    if (!$aux->setFabricante($fabricante)) $errores[] = "Fabricante inválido.";
    if (!$aux->setPais($pais)) $errores[] = "País inválido.";
    if (!$aux->setAnio((int)$anio)) $errores[] = "Año inválido.";

    //Mitad validada directamente con condiciones
    $fIni = DateTime::createFromFormat("d/m/Y", $fechaIni);
    $fFin = DateTime::createFromFormat("d/m/Y", $fechaFin);
    if (!$fIni || $fechaIni < "01/01/$anio") $errores[] = "Fecha inicio inválida.";
    if (!$fFin || $fFin < $fIni) $errores[] = "Fecha fin inválida.";
    if (!is_numeric($precio) || $precio < 30) $errores[] = "Precio inválido (mínimo 30).";

    if ($tipo === "MuebleReciclado") {
        if (!is_numeric($porcentaje) || $porcentaje < 0 || $porcentaje > 100) $errores[] = "Porcentaje inválido (0-100).";
    } else {
        if (!is_numeric($peso) || $peso < 15 || $peso > 300) $errores[] = "Peso inválido (15-300).";
        if (trim($serie) === "") $errores[] = "Serie obligatoria.";
    }

    // Si todo es correcto, actualizamos el mueble real
    if (empty($errores)) {
        $mueble->setNombre($nombre);
        $mueble->setFabricante($fabricante);
        $mueble->setPais($pais);
        $mueble->setAnio((int)$anio);
        $mueble->setFechaIniVenta($fechaIni);
        $mueble->setFechaFinVenta($fechaFin);
        $mueble->setPrecio((float)$precio);

        if ($tipo === "MuebleReciclado") {
            $mueble->setPorcentajeReciclado((int)$porcentaje);
        } else {
            $mueble->setPeso((float)$peso);
            $mueble->setSerie($serie);
        }
        $actualizado = true;
    }
}

//dibuja la plantilla de la vista
inicioCabecera("2DAW Tienda");
cabecera();
finCabecera();

inicioCuerpo("Modificar Mueble");
cuerpo($id, $mueble, $tipo, $errores, $actualizado, compact("nombre", "fabricante", "pais", "anio", "fechaIni", "fechaFin", "precio", "porcentaje", "peso", "serie"));
finCuerpo();
// **********************************************************

//vista
function cabecera() {}

//vista
function cuerpo($id, $mueble, $tipo, $errores, $actualizado, $d)
{
    if ($actualizado) {
        echo "<h2>Mueble #$id actualizado (no persistente)</h2>";
        echo "<p>" . htmlspecialchars((string)$mueble) . "</p>";
        echo '<a href="index.php">Ir a Index.php</a>';
        return;
    }

    if (!empty($errores)) {
        echo "<ul style='color:red;'>";
        foreach ($errores as $e) echo "<li>$e</li>";
        echo "</ul>";
    }
?>
    <h2>Modificar mueble #<?= $id ?> (<?= $tipo ?>)</h2>
    <form method="post">
        <input type="hidden" name="indice" value="<?= $id ?>">
        <label>Nombre: <input type="text" name="nombre" value="<?= htmlspecialchars($d['nombre']) ?>"></label><br>
        <label>Fabricante: <input type="text" name="fabricante" value="<?= htmlspecialchars($d['fabricante']) ?>"></label><br>
        <label>País: <input type="text" name="pais" value="<?= htmlspecialchars($d['pais']) ?>"></label><br>
        <label>Año: <input type="number" name="anio" value="<?= htmlspecialchars($d['anio']) ?>"></label><br>
        <label>Fecha Inicio: <input type="text" name="fechaIniVenta" value="<?= htmlspecialchars($d['fechaIni']) ?>"></label><br>
        <label>Fecha Fin: <input type="text" name="fechaFinVenta" value="<?= htmlspecialchars($d['fechaFin']) ?>"></label><br>
        <label>Precio: <input type="number" step="0.01" name="precio" value="<?= htmlspecialchars($d['precio']) ?>"></label><br>

        <?php if ($tipo === "MuebleReciclado"): ?>
            <label>Porcentaje Reciclado: <input type="number" name="porcentajeReciclado" value="<?= htmlspecialchars($d['porcentaje']) ?>"></label><br>
        <?php else: ?>
            <label>Peso: <input type="number" step="0.1" name="peso" value="<?= htmlspecialchars($d['peso']) ?>"></label><br>
            <label>Serie: <input type="text" name="serie" value="<?= htmlspecialchars($d['serie']) ?>"></label><br>
        <?php endif; ?>

        <br><button type="submit" name="btnGuardar">Guardar cambios</button>
        <a href="index.php">Ir a Index.php</a>
    </form>
<?php
}
