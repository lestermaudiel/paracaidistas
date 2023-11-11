<?php

namespace Controllers;

use Exception;
use Model\Paracaidas;  
use MVC\Router;

class ParacaidasController
{
    public static function index(Router $router)
    {
        $paracaidas = Paracaidas::all();
        $router->render('paracaidas/index', [
            'paracaidas' => $paracaidas,
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
        $paraca_cupula = $_GET['paraca_cupula'];

        $sql = "SELECT * FROM par_paracaidas WHERE paraca_situacion = 1";

        if (!empty($paraca_cupula)) {
            $sql .= " AND paraca_cupula LIKE '%$paraca_cupula%'";
        }

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
