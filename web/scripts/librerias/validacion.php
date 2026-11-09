<?php

//
/**
 * Esta función comprueba que $var contiene un entero cuyo valor está entre $min y $max.
 *
 * @param integer $var Valor a comprobar
 * @param integer $min Minimo
 * @param integer $max Maximo
 * @param integer $defecto Valor a asignar $var en caso de que falle la validacion
 * @return boolean Dvuelve true y es correcto, false en caso contrario
 */
function validaEntero(int &$var, int $min, int $max, int $defecto):bool {

    $resultado = false;

    if ($var >= $min && $var <= $max){
        $resultado = true;
    }else{
        $var = $defecto;
        $resultado = false;
    }

    return $resultado;

}

/**
 * //Esta función comprueba que $var contiene un real cuyo valor está entre $min y $max.
 *
 * @param float $var
 * @param float $min
 * @param float $max
 * @param float $defecto
 * @return boolean La función devuelve true si es correcto y false en caso contrario
 */
function validaReal(float &$var, float $min, float $max, float $defecto):bool{
    $resultado = false;

    if ($var >= $min && $var <= $max){
        $resultado = true;
    }else{
        $var = $defecto;
        $resultado = false;
    }

    return $resultado;

}


/**
 * Función que comprueba que $var contiene una cadena de longitud máxima $longitud
 *
 * @param string $var
 * @param integer $longitud
 * @param string $defecto
 * @return boolean La función devuelve true si es correcto y false en caso contrario
 */
function validaCadena(string &$var, int $longitud, string $defecto):bool{

    if (mb_strlen($var) <= $longitud){
        return true;
    }
    
    $var = $defecto;
    return false;
}



/**
 * Funcion que comprueba que $var contiene una fecha correcta en el formato dd/mm/aaaa.
 *
 * @param string $var
 * @param string $defecto
 * @return boolean La función devuelve true si es correcto y false en caso contrario
 */
function validaFecha(string &$var, string $defecto):bool{

    $patron = '/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/';

    if(preg_match($patron, $var)){
        $arrayFecha = mb_split("/", $var);

        $dia = $arrayFecha[0];
        $mes = $arrayFecha[1];
        $anio = $arrayFecha[2];

        if (checkdate($mes, $dia, $anio)){
            $var = date('d/m/Y', mktime(0,0,0, $mes, $dia, $anio));  
            return true;
        }
        
    }

    $var = $defecto;
    return false;
}



/**
 * Esta función comprueba que $var contiene una hora correcta en el formato hh:mm:ss
 *
 * @param string $var
 * @param string $defecto
 * @return boolean La función devuelve true si es correcta y false en caso contrario
 */
function validaHora(string &$var, string $defecto): bool
{
    $patron = '/^([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})$/';

    if (preg_match($patron, $var)) {

        $arrayHora = mb_split(":", $var);

        $hora = (int)$arrayHora[0];
        $minuto = (int)$arrayHora[1];
        $segundo = (int)$arrayHora[2];

        if ($hora >= 0 && $hora <= 23 &&
            $minuto >= 0 && $minuto <= 59 &&
            $segundo >= 0 && $segundo <= 59) {

            $var = sprintf("%02d:%02d:%02d", $hora, $minuto, $segundo);

            return true;
        }
    }

    $var = $defecto;

    return false;
}



/**
 * Esta función comprueba que $var contiene un email correcto en el formato aaaaa@bbbb.ccc
 *
 * @param string $var  En $var se devuelve el email
 * @param string $defecto En caso de no cumplir las condiciones devuelve $defecto
 * @return boolean La función devuelve true si es correcto y false en caso contrario
 */
function validaEmail(string &$var, string $defecto):bool {

    $patron = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

    if (preg_match($patron, $var)){
        return true;
    }

    $var = $defecto;
    return false;
    
}



/**
 * Esta función comprueba que $var cumple con la expresión regular $expresion
 *
 * @param string $var En caso de no cumplir las condiciones se asigna a $var el valor por $defecto
 * @param string $expresion
 * @param string $defecto
 * @return boolean devuelve true si es correcto yfalse en caso contrario
 */
function validaExpresion(string &$var, string $expresion,string $defecto): bool {

    if (preg_match($expresion, $var)) {
        return true;
    }

    $var = $defecto;

    return false;
}



/**
 * Esta función comprueba que $var sea igual a uno de los elementos del array $posibles ($tipo=1) o a una de las claves
 * del array $posibles ($tipo=2).
 *
 * @param mixed $var
 * @param array $posibles
 * @param integer $tipo
 * @return boolean
 */
function validaRango(mixed $var, array $posibles, int $tipo=1):bool{
    
    if ($tipo === 1){

        if (in_array($var, $posibles)){
            return true;
        }

    }else if ($tipo === 2){

        if (array_key_exists($var, $posibles)){
            return true;
        }
    }

    return false;
}