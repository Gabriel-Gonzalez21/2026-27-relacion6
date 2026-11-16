<?php

//redirección automática a index.php
header("Location: aplicacion/principal/index.php");


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
    <a href="./aplicacion/principal/pruebas.php">Acceso a pruebas</a><br>
<?php
}
