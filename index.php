<!DOCTYPE html>
<?php session_start(); ?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Juego de las damas">
    <title>Dama China</title>
    <link type="text/css" rel="stylesheet" href="estilos.css">
</head>

<body>
    <?php
    require_once('juego.php');


    if (!isset($_POST['empezado'])) {
        $juego = new Juego();
        $juego->comienzaJuego();
        $_POST['empezado'] = true;
    } else {
        $juego = unserialize($_SESSION['juego']);
    }

    if (isset($_POST['enviado'])) {
        $posXIni = $_POST['posXIni'];
        $posYIni = $_POST['posYIni'];
        $posXFin = $_POST['posXFin'];
        $posYFin = $_POST['posYFin'];
        if ($juego->sePuedeComer($posXIni, $posYIni)) {
            $juego->comer($posXIni, $posYIni, $posXFin, $posYFin);
        } else {
            $juego->mover($posXIni, $posYIni, $posXFin, $posYFin);
        }
        $juego->promocion();
    }
    if ($juego->comprobarFichas()) {
    ?>
        <header>
        <div class="titulo">
                <h1>Damas chinas</h1>
                <p>Juego</p>
        </div>
            <div class="turno">
                <h4>Turno:</h4>
                <p>Le toca jugar a
                    <span>
                        <?php
                        if (strcmp($juego->getTurno(), "blanco") === 0) {
                            echo 'blancas';
                        } else if (strcmp($juego->getTurno(), "negro") === 0) {
                            echo 'negras';
                        }
                        ?>
                    </span>
                    <?php
                    if ($juego->sePuedeComer()) {
                    ?>
                        ,<br> le toca comer
                    <?php
                    }
                    ?>
                </p>
            </div>
            <div class="score">
                <h3>Fichas en juego:</h3>
                <p>Blancas <?php echo $juego->getNumBlancas() ?></p>
                <p>Negras <?php echo $juego->getNumNegras() ?></p>
            </div>
        </header>
        
        <main>
            <div class="juego">
                <?php

                if ($_POST['empezado'] == true) {
                    $juego->dibujaTablero();
                }

                $_SESSION['juego'] = serialize($juego);
                ?>
                <div class="formulario">
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" id="formulario">
                        <label for="origen">Origen</label><br>
                        <input type="number" name="posXIni" id="origen" placeholder="X" required="required" max="8" min="1">
                        <input type="number" name="posYIni" id="finalOrigen" placeholder="Y" required="required" max="8" min="1"><br>
                        <label for="detino">Destino</label><br>
                        <input type="number" name="posXFin" id="destino" placeholder="X" required="required" max="8" min="1">
                        <input type="number" name="posYFin" id="finalDestino" placeholder="Y" required="required" max="8" min="1">
                        <input type="hidden" name="empezado" value="true">
                        <input type="reset" value="Resetear">
                        <input type="submit" value="Enviar" name="enviado">
                    </form>
                </div>

                <div class="errores">
                    <h4>Errores</h4>
                    <?php
                    if (count($juego->getErrores()) > 0) {
                        $juego->mostrarErrores();
                    }
                    ?>
                </div>

            </div>
    <?php
    } else {
    ?>
            <div class="perdedor">
                <?php
                if ($juego->getNumNegras() < 1) { ?>
                    <p>Han perdido las negras</p>
                <?php
                } else if ($juego->getNumBlancas() < 1) { ?>
                    <p>Han perdido las blancas</p>
                <?php
                }
                session_reset();
                ?>
                <a href="index.php">Volver a jugar</a>
            </div>
    <?php
    }
    ?>

        </main>
</body>

</html>