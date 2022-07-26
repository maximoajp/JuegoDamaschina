<?php
    class Ficha{

        private $posX;
        private $posY;
        private $color;
        private $coronado;

        function __construct($i, $j, $color_)
        {
            $this->posX = $i;
            $this->posY = $j;
            $this->color = $color_;
            $this->coronado = false;
        }
        public function mueveFicha($nuevaPosX, $nuevaPosY) {
            $this->posX = $nuevaPosX;
            $this->posY = $nuevaPosY;
        }
        public function comeFicha($nuevaPosX, $nuevaPosY) {
            if (strcmp($this->color, "blanco") === 0) {
                $x = $nuevaPosX - 1;
            } else if (strcmp($this->color, "negro") === 0) {
                $x = $nuevaPosX + 1;
            }
           
            if ($nuevaPosY > $this->posY) {
                $y = $nuevaPosY - 1;
            } else {
                $y = $nuevaPosY + 1;
            }

            $this->posX = $nuevaPosX;
            $this->posY = $nuevaPosY;

            if (strcmp($this->color, "negro") === 0) {
                $color = "blanco";
            } else {
                $color = "negro";
            }
            $fichaComida = new Ficha($x, $y, $color);
            return $fichaComida;
        }
        public function comeFichaCoronado($nuevaPosX, $nuevaPosY, $tablero) {

            if (strcmp($this->color, "negro") === 0) {
                $color = "blanco";
            } else {
                $color = "negro";
            }

            if ($nuevaPosY - $this->posY > 0) {
                $suma = 1;
            } else if ($nuevaPosY - $this->posY < 0) {
                $suma = -1;
            }

            
            
            if ($nuevaPosX - $this->posX > 0) {
                $j = $this->posY;
                for ($i = $this->posX + 1; $i < $nuevaPosX; $i++) {
                    $j += $suma;
                    
                    if (isset($tablero->getCasillas()[$i][$j]) && $tablero->getCasillas()[$i][$j]->getOcupado()) {
                       
                        $fichaComida = new Ficha($i, $j, $color);
                        break;
                    }
                }
            }

            if ($nuevaPosX - $this->posX < 0) {
                $j = $this->posY;
                for ($i = $this->posX - 1; $i > $nuevaPosX; $i--) {
                    $j += $suma;
                   
                    if (isset($tablero->getCasillas()[$i][$j]) && $tablero->getCasillas()[$i][$j]->getOcupado()) {
                        $fichaComida = new Ficha($i, $j, $color);
                        break;
                    }
                }
            }
            
            $this->posX = $nuevaPosX;
            $this->posY = $nuevaPosY;

            return $fichaComida;
        }
        public function cambioEstado() {

        }
        public function cambioCoronado() {
            $this->coronado = true;
        }

        public function getPosX() {
            return $this->posX;
        }
        public function getPosY() {
            return $this->posY;
        }
        public function getColor() {
            return $this->color;
        }
        public function getCoronado() {
            return $this->coronado;
        }
    }
