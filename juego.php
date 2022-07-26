<?php
require_once('casillas.php');
require_once('fichas.php');
require_once('tablero.php');
class Juego
{

    private $turno;
    private $tablero;
    private $errores;
    private $numBlancas;
    private $numNegras;

    function __construct()
    {
        $this->turno = "blanco";
        $this->errores = array();
        $this->numBlancas = 0;
        $this->numNegras = 0;
    }

    public function comienzaJuego()
    {
        $this->tablero = new Tablero();
        $this->tablero->crearFichas();
        $this->tablero->montarTablero();
    }

    public function sePuedeComer()
    {
        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                if (isset($this->tablero->getFichas()[$i][$j]) && strcmp($this->tablero->getFichas()[$i][$j]->getColor(), $this->turno) === 0 && $this->tablero->getFichas()[$i][$j]->getCoronado() == false) {
                    $ficha = $this->tablero->getFichas()[$i][$j];
                    if (strcmp($ficha->getColor(), "blanco") === 0) {
                        if (isset($this->tablero->getCasillas()[$i + 1][$j + 1]) && $this->tablero->getCasillas()[$i + 1][$j + 1]->getOcupado()) {
                            if (strcmp($this->tablero->getCasillas()[$i + 1][$j + 1]->getFicha()->getColor(), "negro") === 0) {
                                if (isset($this->tablero->getCasillas()[$i + 2][$j + 2]) && $this->tablero->getCasillas()[$i + 2][$j + 2]->getOcupado() == false) {
                                    return true;
                                }
                            }
                        }
                        if (isset($this->tablero->getCasillas()[$i + 1][$j - 1]) && $this->tablero->getCasillas()[$i + 1][$j - 1]->getOcupado()) {
                            if (strcmp($this->tablero->getCasillas()[$i + 1][$j - 1]->getFicha()->getColor(), "negro") === 0) {
                                if (isset($this->tablero->getCasillas()[$i + 2][$j - 2]) && $this->tablero->getCasillas()[$i + 2][$j - 2]->getOcupado() == false) {
                                    return true;
                                }
                            }
                        }
                    }

                    if (strcmp($ficha->getColor(), "negro") === 0) {
                        if (isset($this->tablero->getCasillas()[$i - 1][$j + 1]) && $this->tablero->getCasillas()[$i - 1][$j + 1]->getOcupado()) {
                            if (strcmp($this->tablero->getCasillas()[$i - 1][$j + 1]->getFicha()->getColor(), "blanco") === 0) {
                                if (isset($this->tablero->getCasillas()[$i - 2][$j + 2]) && $this->tablero->getCasillas()[$i - 2][$j + 2]->getOcupado() == false) {
                                    return true;
                                }
                            }
                        }
                        if (isset($this->tablero->getCasillas()[$i - 1][$j - 1]) && $this->tablero->getCasillas()[$i - 1][$j - 1]->getOcupado()) {
                            if (strcmp($this->tablero->getCasillas()[$i - 1][$j - 1]->getFicha()->getColor(), "blanco") === 0) {
                                if (isset($this->tablero->getCasillas()[$i - 2][$j - 2]) && $this->tablero->getCasillas()[$i - 2][$j - 2]->getOcupado() == false) {
                                    return true;
                                }
                            }
                        }
                    }
                } else if (isset($this->tablero->getFichas()[$i][$j]) && strcmp($this->tablero->getFichas()[$i][$j]->getColor(), $this->turno) === 0 && $this->tablero->getFichas()[$i][$j]->getCoronado() == true) {
                    $ficha = $this->tablero->getFichas()[$i][$j];
                    $x = 1;
                    $y = 1;
                    $flag = true;
                    while ($flag) {
                        if (isset($this->tablero->getCasillas()[$i + $x][$j + $y])) {
                            if ($this->tablero->getCasillas()[$i + $x][$j + $y]->getOcupado()) {

                                if (strcmp($this->tablero->getCasillas()[$i + $x][$j + $y]->getFicha()->getColor(), $ficha->getColor()) === 0) {
                                    break;
                                }
                                if (strcmp($this->tablero->getCasillas()[$i + $x][$j + $y]->getFicha()->getColor(), $ficha->getColor()) !== 0) {
                                    if (isset($this->tablero->getCasillas()[$i + $x + 1][$j + $y + 1]) && $this->tablero->getCasillas()[$i + $x + 1][$j + $y + 1]->getOcupado() == false) {
                                        return true;
                                    } else {
                                        break;
                                    }
                                }
                            }
                        } else {
                            $flag = false;
                        }
                        $x++;
                        $y++;
                    }
                    $x = 1;
                    $y = 1;
                    $flag = true;
                    while ($flag) {
                        if (isset($this->tablero->getCasillas()[$i + $x][$j - $y])) {
                            if ($this->tablero->getCasillas()[$i + $x][$j - $y]->getOcupado()) {
                                if (strcmp($this->tablero->getCasillas()[$i + $x][$j - $y]->getFicha()->getColor(), $ficha->getColor()) === 0) {
                                    break;
                                }
                                if (strcmp($this->tablero->getCasillas()[$i + $x][$j - $y]->getFicha()->getColor(), $ficha->getColor()) !== 0) {
                                    if (isset($this->tablero->getCasillas()[$i + $x + 1][$j - $y - 1]) && $this->tablero->getCasillas()[$i + $x + 1][$j - $y - 1]->getOcupado() == false) {
                                        return true;
                                    } else {
                                        break;
                                    }
                                }
                            }
                        } else {
                            $flag = false;
                        }
                        $x++;
                        $y++;
                    }
                    $x = 1;
                    $y = 1;
                    $flag = true;
                    while ($flag) {
                        if (isset($this->tablero->getCasillas()[$i - $x][$j + $y])) {
                            if ($this->tablero->getCasillas()[$i - $x][$j + $y]->getOcupado()) {
                                if (strcmp($this->tablero->getCasillas()[$i - $x][$j + $y]->getFicha()->getColor(), $ficha->getColor()) === 0) {
                                    break;
                                }
                                if (strcmp($this->tablero->getCasillas()[$i - $x][$j + $y]->getFicha()->getColor(), $ficha->getColor()) !== 0) {
                                    if (isset($this->tablero->getCasillas()[$i - $x - 1][$j + $y + 1]) && $this->tablero->getCasillas()[$i - $x - 1][$j + $y + 1]->getOcupado() == false) {
                                        return true;
                                    } else {
                                        break;
                                    }
                                }
                            }
                        } else {
                            $flag = false;
                        }
                        $x++;
                        $y++;
                    }
                    $x = 1;
                    $y = 1;
                    $flag = true;
                    while ($flag) {
                        if (isset($this->tablero->getCasillas()[$i - $x][$j - $y])) {
                            if ($this->tablero->getCasillas()[$i - $x][$j - $y]->getOcupado()) {
                                if (strcmp($this->tablero->getCasillas()[$i - $x][$j - $y]->getFicha()->getColor(), $ficha->getColor()) === 0) {
                                    break;
                                }
                                if (strcmp($this->tablero->getCasillas()[$i - $x][$j - $y]->getFicha()->getColor(), $ficha->getColor()) !== 0) {
                                    if (isset($this->tablero->getCasillas()[$i - $x - 1][$j - $y - 1]) && $this->tablero->getCasillas()[$i - $x - 1][$j - $y - 1]->getOcupado() == false) {
                                        return true;
                                    } else {
                                        break;
                                    }
                                }
                            }
                        } else {
                            $flag = false;
                        }
                        $x++;
                        $y++;
                    }
                }
            }
        }
        return false;
    }

    public function puedeSeguirComendo($posX, $posY)
    {
        $color = $this->tablero->getFichas()[$posX][$posY]->getColor();

        if ($this->tablero->getFichas()[$posX][$posY]->getCoronado() == false) {

            if (strcmp($color, "blanco") === 0) {
                if (isset($this->tablero->getCasillas()[$posX + 1][$posY + 1]) && $this->tablero->getCasillas()[$posX + 1][$posY + 1]->getOcupado()) {
                    if (strcmp($this->tablero->getFichas()[$posX + 1][$posY + 1]->getColor(), "negro") === 0) {
                        if (isset($this->tablero->getCasillas()[$posX + 2][$posY + 2]) && $this->tablero->getCasillas()[$posX + 2][$posY + 2]->getOcupado() == false) {
                            return true;
                        }
                    }
                }
                if (isset($this->tablero->getCasillas()[$posX + 1][$posY - 1]) && $this->tablero->getCasillas()[$posX + 1][$posY - 1]->getOcupado()) {
                    if (strcmp($this->tablero->getFichas()[$posX + 1][$posY - 1]->getColor(), "negro") === 0) {
                        if (isset($this->tablero->getCasillas()[$posX + 2][$posY - 2]) && $this->tablero->getCasillas()[$posX + 2][$posY - 2]->getOcupado() == false) {
                            return true;
                        }
                    }
                }
            }

            if (strcmp($color, "negro") === 0) {
                if (isset($this->tablero->getCasillas()[$posX - 1][$posY + 1]) && $this->tablero->getCasillas()[$posX - 1][$posY + 1]->getOcupado()) {
                    if (strcmp($this->tablero->getFichas()[$posX - 1][$posY + 1]->getColor(), "blanco") === 0) {
                        if (isset($this->tablero->getCasillas()[$posX - 2][$posY + 2]) && $this->tablero->getCasillas()[$posX - 2][$posY + 2]->getOcupado() == false) {
                            return true;
                        }
                    }
                }
                if (isset($this->tablero->getCasillas()[$posX - 1][$posY - 1]) && $this->tablero->getCasillas()[$posX - 1][$posY - 1]->getOcupado()) {
                    if (strcmp($this->tablero->getFichas()[$posX - 1][$posY - 1]->getColor(), "blanco") === 0) {
                        if (isset($this->tablero->getCasillas()[$posX - 2][$posY - 2]) && $this->tablero->getCasillas()[$posX - 2][$posY - 2]->getOcupado() == false) {
                            return true;
                        }
                    }
                }
            }
        } else if ($this->tablero->getFichas()[$posX][$posY]->getCoronado()) {
            $x = 1;
            $y = 1;
            $flag = true;
            while ($flag) {
                if (isset($this->tablero->getCasillas()[$posX + $x][$posY + $y])) {
                    if ($this->tablero->getCasillas()[$posX + $x][$posY + $y]->getOcupado()) {
                        if (strcmp($this->tablero->getCasillas()[$posX + $x][$posY + $y]->getFicha()->getColor(), $color) === 0) {
                            break;
                        }
                        if (strcmp($this->tablero->getCasillas()[$posX + $x][$posY + $y]->getFicha()->getColor(), $color) !== 0) {
                            if (isset($this->tablero->getCasillas()[$posX + $x + 1][$posY + $y + 1]) && $this->tablero->getCasillas()[$posX + $x + 1][$posY + $y + 1]->getOcupado() == false) {
                                return true;
                            } else {
                                break;
                            }
                        }
                    }
                } else {
                    $flag = false;
                }
                $x++;
                $y++;
            }
            $x = 1;
            $y = 1;
            $flag = true;
            while ($flag) {
                if (isset($this->tablero->getCasillas()[$posX + $x][$posY - $y])) {
                    if ($this->tablero->getCasillas()[$posX + $x][$posY - $y]->getOcupado()) {
                        if (strcmp($this->tablero->getCasillas()[$posX + $x][$posY - $y]->getFicha()->getColor(), $color) === 0) {
                            break;
                        }
                        if (strcmp($this->tablero->getCasillas()[$posX + $x][$posY - $y]->getFicha()->getColor(), $color) !== 0) {
                            if (isset($this->tablero->getCasillas()[$posX + $x + 1][$posY - $y - 1]) && $this->tablero->getCasillas()[$posX + $x + 1][$posY - $y - 1]->getOcupado() == false) {
                                return true;
                            } else {
                                break;
                            }
                        }
                    }
                } else {
                    $flag = false;
                }
                $x++;
                $y++;
            }
            $x = 1;
            $y = 1;
            $flag = true;
            while ($flag) {
                if (isset($this->tablero->getCasillas()[$posX - $x][$posY + $y])) {
                    if ($this->tablero->getCasillas()[$posX - $x][$posY + $y]->getOcupado()) {
                        if (strcmp($this->tablero->getCasillas()[$posX - $x][$posY + $y]->getFicha()->getColor(), $color) === 0) {
                            break;
                        }
                        if (strcmp($this->tablero->getCasillas()[$posX - $x][$posY + $y]->getFicha()->getColor(), $color) !== 0) {
                            if (isset($this->tablero->getCasillas()[$posX - $x - 1][$posY + $y + 1]) && $this->tablero->getCasillas()[$posX - $x - 1][$posY + $y + 1]->getOcupado() == false) {
                                return true;
                            } else {
                                break;
                            }
                        }
                    }
                } else {
                    $flag = false;
                }
                $x++;
                $y++;
            }
            $x = 1;
            $y = 1;
            $flag = true;
            while ($flag) {
                if (isset($this->tablero->getCasillas()[$posX - $x][$posY - $y])) {
                    if ($this->tablero->getCasillas()[$posX - $x][$posY - $y]->getOcupado()) {
                        if (strcmp($this->tablero->getCasillas()[$posX - $x][$posY - $y]->getFicha()->getColor(), $color) === 0) {
                            break;
                        }
                        if (strcmp($this->tablero->getCasillas()[$posX - $x][$posY - $y]->getFicha()->getColor(), $color) !== 0) {
                            if (isset($this->tablero->getCasillas()[$posX - $x - 1][$posY - $y - 1]) && $this->tablero->getCasillas()[$posX - $x - 1][$posY - $y - 1]->getOcupado() == false) {
                                return true;
                            } else {
                                break;
                            }
                        }
                    }
                } else {
                    $flag = false;
                }
                $x++;
                $y++;
            }
        }

        return false;
    }

    function comprobarFichas()
    {
        $this->numBlancas = 0;
        $this->numNegras = 0;
        foreach ($this->tablero->getFichas() as $fila) {
            foreach ($fila as $ficha) { //ff
                if (isset($ficha)) {
                    if (strcmp($ficha->getColor(), 'blanco') === 0) {
                        $this->numBlancas++;
                    } else if (strcmp($ficha->getColor(), 'negro') === 0) {
                        $this->numNegras++;
                    }
                }
            }
        }
        if ($this->numNegras < 1 || $this->numBlancas < 1) {
            return false;
        } else {
            return true;
        }
    }

    public function compruebaComer($posXIni, $posYIni, $posXFin, $posYFin)
    {
        if (isset($this->tablero->getFichas()[$posXIni][$posYIni])) {
            $color =  $this->tablero->getFichas()[$posXIni][$posYIni]->getColor();

            if ($this->tablero->getFichas()[$posXIni][$posYIni]->getCoronado() == false) {
                if (strcmp($color, "blanco") === 0 && strcmp($this->tablero->getFichas()[$posXIni][$posYIni]->getColor(), $this->turno) === 0) {
                    if ($posXFin - $posXIni == 2 && abs($posYFin - $posYIni) == 2) {
                        if ($posYFin > $posYIni) {
                            $posY = $posYFin - 1;
                        } else {
                            $posY = $posYFin + 1;
                        }
                        $posX = $posXFin - 1;
                        if ($this->tablero->getCasillas()[$posX][$posY]->getOcupado() == true) {
                            if (strcmp($this->tablero->getCasillas()[$posX][$posY]->getFicha()->getColor(), $color) !== 0) {
                                return true;
                            }
                        }
                    }
                } else if (strcmp($color, "negro") === 0 && strcmp($this->tablero->getFichas()[$posXIni][$posYIni]->getColor(), $this->turno) === 0) {
                    if ($posXFin - $posXIni == -2 && abs($posYFin - $posYIni) == 2) {
                        if ($posYFin > $posYIni) {
                            $posY = $posYFin - 1;
                        } else {
                            $posY = $posYFin + 1;
                        }
                        $posX = $posXFin + 1;
                        if ($this->tablero->getCasillas()[$posX][$posY]->getOcupado() == true) {
                            if (strcmp($this->tablero->getCasillas()[$posX][$posY]->getFicha()->getColor(), $color) !== 0) {
                                return true;
                            }
                        }
                    }
                }
            } else if ($this->tablero->getFichas()[$posXIni][$posYIni]->getCoronado()) {
                $cont = 0;
                if (abs($posXFin - $posXIni) == abs($posYFin - $posYIni)) {
                    if (isset($this->tablero->getCasillas()[$posXFin][$posYFin]) && $this->tablero->getCasillas()[$posXFin][$posYFin]->getOcupado() == false) {
                        if ($posYFin - $posYIni > 0) {
                            $suma = 1;
                        } else if ($posYFin - $posYIni < 0) {
                            $suma = -1;
                        }

                        if ($posXFin - $posXIni > 0) {
                            $j = $posYIni;
                            for ($i = $posXIni + 1; $i < $posXFin; $i++) {
                                $j += $suma;
                                if (isset($this->tablero->getCasillas()[$i][$j]) && $this->tablero->getCasillas()[$i][$j]->getOcupado()) {
                                    if (strcmp($this->turno, $this->tablero->getCasillas()[$i][$j]->getFicha()->getColor()) === 0) {
                                        return false;
                                    } else if (strcmp($this->turno, $this->tablero->getCasillas()[$i][$j]->getFicha()->getColor()) !== 0) {
                                        $cont++;
                                    }
                                }
                            }
                        }

                        if ($posXFin - $posXIni < 0) {
                            $j = $posYIni;
                            for ($i = $posXIni - 1; $i > $posXFin; $i--) {
                                $j += $suma;
                                if (isset($this->tablero->getCasillas()[$i][$j]) && $this->tablero->getCasillas()[$i][$j]->getOcupado()) {
                                    if (strcmp($this->turno, $this->tablero->getCasillas()[$i][$j]->getFicha()->getColor()) === 0) {
                                        return false;
                                    } else if (strcmp($this->turno, $this->tablero->getCasillas()[$i][$j]->getFicha()->getColor()) !== 0) {
                                        $cont++;
                                    }
                                }
                            }
                        }
                    }
                    if ($cont === 1) {
                        return true;
                    }
                }
            }
        }
        return false;
    }
    public function comer($posXIni, $posYIni, $posXFin, $posYFin)
    {
        if ($this->compruebaComer($posXIni, $posYIni, $posXFin, $posYFin)) {
            $this->tablero->comeFicha($posXIni, $posYIni, $posXFin, $posYFin, $this->tablero);
            if (!$this->puedeSeguirComendo($posXFin, $posYFin)) {
                $this->cambioTurno();
            }
        }
    }
    public function elegirFicha()
    {
    }
    function compruebaMover($posXIni, $posYIni, $posXFin, $posYFin)
    {
        $this->errores = array();
        if (isset($this->tablero->getFichas()[$posXIni][$posYIni])) {
            if (isset($this->tablero->getCasillas()[$posXFin][$posYFin])) { //Comprueba si la casilla final existe
                if (strcmp($this->tablero->getFichas()[$posXIni][$posYIni]->getColor(), $this->turno) === 0) { //Que el color sea el del turno       

                    if ($this->tablero->getFichas()[$posXIni][$posYIni]->getCoronado() == false) { //Si no está getCoronado()

                        if (strcmp($this->turno, "blanco") === 0) { //Si el turno es del blanco...
                            if (($posYFin == $posYIni + 1 || $posYFin == $posYIni - 1) && $posXFin == $posXIni + 1) { //....comprueba que mueva hacia arriba y alguno de los lados  
                                if ($this->tablero->getCasillas()[$posXFin][$posYFin]->getOcupado() == false) {
                                    //Y aquí acaba, si no ha habido errores abajo retorna true;
                                } else {
                                    array_push($this->errores, "La casilla destino está ocupada");
                                }
                            } else {
                                array_push($this->errores, "La dirección del movimiento no es correcto, las blancas mueve hacia arriba y a los lados una unidad");
                            }
                        } else if (strcmp($this->turno, "negro") === 0) { //Si el turno es del negro....
                            if (($posYIni + 1 == $posYFin || $posYIni - 1 == $posYFin) && ($posXIni - 1 == $posXFin)) { //....comprueba que mueva hacia abajo y alguno de los lados

                                if ($this->tablero->getCasillas()[$posXFin][$posYFin]->getOcupado() == false) {
                                    //Y aquí acaba, si no ha habido errores abajo retorna true;
                                } else {
                                    array_push($this->errores, "La casilla destino está ocupada");
                                }
                            } else {
                                array_push($this->errores, "La dirección del movimiento no es correcto, las negras mueven hacia abajo y a los lados una unidad");
                            }
                        } else {
                            array_push($this->errores, "El color no coincide con el del turno" . $this->turno . '<br>');
                        }
                    } else if ($this->tablero->getFichas()[$posXIni][$posYIni]->getCoronado() == true) { //Si está getCoronado()
                        if (abs($posYIni - $posYFin) == abs($posXIni - $posXFin) && $posXIni - $posXFin != 0 && $posYIni - $posYFin != 0) { //Comprueba que se avanza lo mismo en vertical que en horizontal
                            //Mira la direccion del desplazamiento

                            if ($posXIni - $posXFin < 0) {  //Arriba

                                if ($posYIni - $posYFin > 0) {
                                    $suma = -1;
                                } else if ($posYIni - $posYFin < 0) {
                                    $suma = 1;
                                }
                                for ($i = $posXIni + 1; $i < $posXFin; $i++) {
                                    $posYIni += $suma;
                                    if (isset($this->tablero->getCasillas()[$i][$posYIni]) && $this->tablero->getCasillas()[$i][$posYIni]->getOcupado() == false) {
                                    } else if ($this->tablero->getCasillas()[$i][$posYIni]->getOcupado() == true) {
                                        array_push($this->errores, "Hay una pieza delante");
                                        break;
                                    }
                                }
                            } else if ($posXIni - $posXFin > 0) {  //Abajo

                                if ($posYIni - $posYFin > 0) {
                                    $suma = -1;
                                } else if ($posYIni - $posYFin < 0) {
                                    $suma = 1;
                                }
                                for ($i = $posXIni - 1; $i > $posXFin; $i--) {
                                    $posYIni += $suma;
                                    if (isset($this->tablero->getCasillas()[$i][$posYIni]) && $this->tablero->getCasillas()[$i][$posYIni]->getOcupado() == false) {
                                    } else if ($this->tablero->getCasillas()[$i][$posYIni]->getOcupado() == true) {
                                        array_push($this->errores, "Hay una pieza delante");
                                        break;
                                    }
                                }
                            }
                        }
                    }
                } else {
                    array_push($this->errores, "La ficha no es de tu color, le toca al " . $this->turno);
                }
            } else {
                array_push($this->errores, "La casilla final no existe");
            }
        } else {
            array_push($this->errores, "La ficha no existe");
        }

        if (count($this->errores) > 0) {
            return false;
        } else {
            return true;
        }
    }
    public function mover($posXIni, $posYIni, $posXFin, $posYFin)
    {
        if ($this->compruebaMover($posXIni, $posYIni, $posXFin, $posYFin)) {
            $this->tablero->mueveFicha($posXIni, $posYIni, $posXFin, $posYFin);
            $this->cambioTurno();
        }
    }
    public function cambioTurno()
    {
        if ($this->turno == "blanco") {
            $this->turno = "negro";
        } else if ($this->turno == "negro") {
            $this->turno = "blanco";
        }
    }
    public function mostrarErrores()
    {
        foreach ($this->errores as $error) {
            echo $error . "<br>";
        }
    }

    public function promocion()
    {
        for ($j = 1; $j <= 7; $j += 2) {
            if (isset($this->tablero->getFichas()[1][$j])) {
                if (strcmp($this->tablero->getFichas()[1][$j]->getColor(), "negro") === 0) {
                    $this->tablero->getFichas()[1][$j]->cambioCoronado();
                }
            }
        }
        for ($j = 2; $j <= 8; $j += 2) {
            if (isset($this->tablero->getFichas()[8][$j])) {
                if (strcmp($this->tablero->getFichas()[8][$j]->getColor(), "blanco") === 0) {
                    $this->tablero->getFichas()[8][$j]->cambioCoronado();
                }
            }
        }
    }

    public function dibujaTablero()
    {
        $fichaB = "Imagenes/FichaBlanca.svg";
        $fichaN = "Imagenes/FichaNegra.svg";
        $reinaB = "Imagenes/ReinaBlanca.svg";
        $reinaN = "Imagenes/ReinaNegra.svg";
?>
        <div class="tableroBox">
            <div class="tablero">
                <?php
                $tamaño = 8;
                for ($i = $tamaño; $i >= 1; $i--) {
                    for ($j = 1; $j <= $tamaño; $j++) {
                        if (($j + $i) % 2 == 0) {
                ?>
                            <div class="casillaN">
                                <?php
                                if ($this->tablero->getCasillas()[$i][$j]->getOcupado()) {
                                    if ($this->tablero->getFichas()[$i][$j]->getCoronado() == false) {

                                        if (strcmp($this->tablero->getFichas()[$i][$j]->getColor(), "blanco") === 0) {
                                ?>
                                            <!-- <img src="<?php// echo $fichaB ?>" alt=""> -->
                                            <div class="fichaBlanca ficha"></div>
                                            <p class="pNegro"><?php echo "$i,$j" ?></p>
                                        <?php
                                        }
                                        if (strcmp($this->tablero->getFichas()[$i][$j]->getColor(), "negro") === 0) {
                                        ?>
                                            <!-- <img src="<?php //echo $fichaN 
                                                            ?>" alt=""> -->
                                            <div class="fichaNegra ficha"></div>
                                            <p class="pBlanco"><?php echo "$i,$j" ?></p>
                                        <?php
                                        }
                                    } else if ($this->tablero->getFichas()[$i][$j]->getCoronado() == true) {

                                        if (strcmp($this->tablero->getFichas()[$i][$j]->getColor(), "blanco") === 0) {
                                        ?>
                                            <!-- <img src="<?php// echo $reinaB ?>" alt=""> -->
                                            <div class="damaBlanca dama">
                                                <div class="poligonoBlanco"></div>
                                                <div class="corona coronaNegra"></div>
                                                <div class="corona coronaNegra"></div>
                                                <div class="corona coronaNegra"></div>
                                            </div>
                                            <p class="pNegro"><?php echo "$i,$j" ?></p>
                                        <?php
                                        }
                                        if (strcmp($this->tablero->getFichas()[$i][$j]->getColor(), "negro") === 0) {
                                        ?>
                                            <!-- <img src="<?php //echo $reinaN 
                                                            ?>" alt=""> -->

                                            <div class="damaNegra dama">
                                                <div class="poligonoNegro"></div>
                                                <div class="corona coronaBlanca"></div>
                                                <div class="corona coronaBlanca"></div>
                                                <div class="corona coronaBlanca"></div>
                                            </div>
                                            <p class="pBlanco"><?php echo "$i,$j" ?></p>
                                    <?php
                                        }
                                    }
                                } else {
                                    ?>
                                    <p class="pBlanco"><?php echo "$i,$j" ?></p>
                                <?php
                                }

                                ?>
                            </div>

                        <?php
                        }
                        if (($j + $i) % 2 != 0) {
                        ?>
                            <div class="casillaB"></div>
                <?php
                        }
                    }
                }
                ?>
            </div>
        </div>
<?php
    }

    public function getTurno()
    {
        return $this->turno;
    }

    public function getTablero()
    {
        return $this->tablero;
    }

    public function getErrores()
    {
        return $this->errores;
    }

    public function getNumBlancas()
    {
        return $this->numBlancas;
    }

    public function getNumNegras()
    {
        return $this->numNegras;
    }
}
