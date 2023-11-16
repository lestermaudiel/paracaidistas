<?php

namespace Controllers;

use Exception;
use Model\Paracaidas;
use Model\TiposParacaidas;
use MVC\Router;

class ListaParacaidasSaltosController
{
    public static function index(Router $router)
    {
        $tipoparacaidas = new TiposParacaidas();
        $tipoparacaidas = $tipoparacaidas->getTipoParacaidas();
        $router->render('listaparacaidassaltos/index', [

            'tipoParacaidas' => $tipoparacaidas,
        ]);
    }

    public static function guardarAPI()
    {
        try {
            $paracaidas = new Paracaidas($_POST);
            $resultado = $paracaidas->crear();

            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Registro guardado correctamente',
                    'codigo' => 1
                ]);
            } else {
                echo json_encode([
                    'mensaje' => 'Ocurrió un error',
                    'codigo' => 0
                ]);
            }
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function buscarAPI()
    {


        $sql = "SELECT 
        *,
        paraca_saltos_total-paraca_saltos_uso saltos_disponibles,
        paraca_fecha_caducidad - TODAY || ' DIAS' tiempo_restante,
        tipo_par_descripcion
    FROM par_paracaidas 
    INNER JOIN par_tipo_paracaidas ON paraca_tipo = tipo_par_id
    WHERE paraca_situacion = 1;
    ";

        try {
            $paracaidas = Paracaidas::fetchArray($sql);
            echo json_encode($paracaidas);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function modificarAPI()
    {
        try {
            $paracaidas = new Paracaidas($_POST);
            $resultado = $paracaidas->actualizar();

            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Registro modificado correctamente',
                    'codigo' => 1
                ]);
            } else {
                echo json_encode([
                    'mensaje' => 'Ocurrió un error',
                    'codigo' => 0
                ]);
            }
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function eliminarAPI()
    {
        try {
            $paraca_id = $_POST['paraca_id'];
            $paracaidas = Paracaidas::find($paraca_id);
            $paracaidas->paraca_situacion = 0;
            $resultado = $paracaidas->actualizar();

            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Registro eliminado correctamente',
                    'codigo' => 1
                ]);
            } else {
                echo json_encode([
                    'mensaje' => 'Ocurrió un error',
                    'codigo' => 0
                ]);
            }
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

}



