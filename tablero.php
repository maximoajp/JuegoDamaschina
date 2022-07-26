<?php

    class Tablero {

        public $casillas;
        public $fichas;

        function __construct()
        {
            $this->casillas = array();
            $this->fichas = array(); //Podemos hacer las fichas separadas por colores
           
        }

        public function crearFichas() {
            //creamos fichas blancas
            for ($i = 1; $i <= 3; $i++) {
                if ($i == 1 || $i == 3) {
                    for ($j = 1; $j <= 7; $j = $j + 2) { 
                        $ficha = new Ficha($i, $j, "blanco");
                        $this->fichas[$i][$j] = $ficha;
                    }
                }
                if ($i == 2) {
                    for ($j = 2; $j <= 8; $j = $j + 2) {
                        $this->fichas[$i][$j] = new Ficha($i, $j, "blanco");
                    }
                }
            }


            //creamos fichas negras
            for ($i = 8; $i >= 6; $i--) {
                if ($i == 8 || $i == 6) {
                    for ($j = 8; $j >= 2; $j = $j - 2) {
                        $this->fichas[$i][$j] = new Ficha($i, $j, "negro");
                    }
                }
                if ($i == 7) {
                    for ($j = 7; $j >= 1; $j = $j - 2) {
                        $this->fichas[$i][$j] = new Ficha($i, $j, "negro");
                    }
                }
            }
        }

        //Primero crearemos las fichas y luego montamos el tablero
        public function montarTablero(){
            for ($i = 1; $i <= 8; $i++) {
                for ($j = 1; $j <= 8; $j++) {
                    $casilla = new Casilla($i, $j);
                    $this->casillas[$i][$j] = $casilla;
                    if(!empty($this->fichas[$i][$j])){

                        $this->casillas[$i][$j]->cambioOcupado($this->fichas[$i][$j]);

                    }
                }
            }
        }

        public function mueveFicha($posXIni, $posYIni, $posXFin, $posYFin){
            $ficha = $this->casillas[$posXIni][$posYIni]->getFicha();
            $ficha->mueveFicha($posXFin, $posYFin);
            $this->fichas[$posXIni][$posYIni] = null;
            $this->fichas[$posXFin][$posYFin] = $ficha;
            $this->casillas[$posXIni][$posYIni]->cambioOcupado(null);
            $this->casillas[$posXFin][$posYFin]->cambioOcupado($ficha);
        }

        public function  comeFicha($posXIni, $posYIni, $posXFin, $posYFin, $tablero) {
            $ficha = $tablero->casillas[$posXIni][$posYIni]->getFicha();
            if ($ficha->getCoronado() == false) {
                $fichaComida = $ficha->comeFicha($posXFin, $posYFin);
            } else if ($ficha->getCoronado()) {
                $fichaComida = $ficha->comeFichaCoronado($posXFin, $posYFin, $tablero);
            }
                $this->fichas[$posXIni][$posYIni] = null;
                $this->fichas[$posXFin][$posYFin] = $ficha;
                $this->casillas[$posXIni][$posYIni]->cambioOcupado(null);
                $this->casillas[$posXFin][$posYFin]->cambioOcupado($ficha);

                $this->fichas[$fichaComida->getPosX()][$fichaComida->getPosY()] = null;
                $this->casillas[$fichaComida->getPosX()][$fichaComida->getPosY()]->cambioOcupado(null);
        }

        public function getCasillas() {
            return $this->casillas;
        }
        public function getFichas() {
            return $this->fichas;
        }

        //Devuelve false si una casilla está ocuapada
        public function compruebaOcupada($ficha){
            if(strcmp($ficha->posicionX, $this->casilla[$ficha->posicionX]) === 0 && strcmp($ficha->posicionY, $this->casilla[$ficha->posicionY]) === 0){
                return false;
            }else{
                return true;
            }
        }
    }

?>