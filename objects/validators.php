<?php
class Validators
{

    /**
     * Check if DNI or NIE is correct formed and letter matches the string number.
     *
     * @param [string] $dni
     * @return void
     */
    public function dniValid($dni)
    {
        // Check length of the string
        if (strlen($dni) != 9 ||
            preg_match('/^[XYZ]?([0-9]{7,8})([A-Z])$/i', $dni, $matches) !== 1) {
            return false;
        } else {
            $dni = strtoupper($dni);

            $letra = substr($dni, -1, 1);
            $numero = substr($dni, 0, 8);

            // Si es un NIE hay que cambiar la primera letra por 0, 1 ó 2 dependiendo de si es X, Y o Z.
            $numero = str_replace(array('X', 'Y', 'Z'), array(0, 1, 2), $numero);

            $modulo = $numero % 23;
            $letras_validas = "TRWAGMYFPDXBNJZSQVHLCKE";
            $letra_correcta = substr($letras_validas, $modulo, 1);

            if ($letra_correcta != $letra) {
                return false;
            } else {
                return true;
            }
        }
    }
    /**
     * Check if pass is at least 8 char length and includes almost 1 Capital and 1 number.
     *
     * @param [string] $pass
     * @return void
     */
    public function strongPass($pass)
    {
        if ($pass && preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $pass)) {
            return true;
        } else {
            return false;
        }
    }
}
