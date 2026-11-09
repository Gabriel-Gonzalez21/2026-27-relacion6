<?php
include_once(dirname(__FILE__) . "/cabecera.php");
//controlador

$usuario=getenv("MYSQL_USER");

//dibuja la plantilla de la vista
inicioCabecera("TIENDA");
cabecera();
finCabecera();
inicioCuerpo("TIENDA");
cuerpo();  //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}

//vista
function cuerpo()
{
?>
    <br><br>
    <a href="./aplicacion/pruebas/index.php">Acceso a pruebas</a><br>
    <a href="./aplicacion/relacion1/index.php">Relación 1</a><br>
    <a href="./aplicacion/relacion2/index.php">Relación 2</a><br>
    <a href="./aplicacion/relacion3/index.php">Relación 3</a><br>
    <a href="./aplicacion/relacion4/index.php">Relación 4</a><br>
    <a href="./aplicacion/relacion5/index.php">Relación 5</a><br>
<?php
}
