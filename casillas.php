<?php
class Casilla
{
    private $ocupado;
    private $ficha;
    private $posicionX; //ej 13 columna 1 fila 3
    private $posicionY;
    function __construct($posX, $posY)
    {
        $this->ocupado = false;
        $this->ficha = null;
        $this->posicionX = $posX;
        $this->posicionY = $posY;
    }

    public function cambioOcupado($ficha)
    {
        if(!empty($ficha)){
            $this->ocupado = true;
            $this->ficha = $ficha;
        }else{
            $this->ocupado = false;
            $this->ficha = null;
        }

    }
    public function compruebaOcupado()
    {

        if ($this->ocupado) {
            return true;
        } else {
            return false;
        }
    }

    public function getOcupado(){
        return $this->ocupado;
    }

    public function getFicha(){
        return $this->ficha;
    }

    public function getPosX(){
        return $this->posX;
    }

    public function getPosY(){
        return $this->posY;
    }
}
