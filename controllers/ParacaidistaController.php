<?php

namespace Controllers;

use Exception;
use Model\Paracaidista;
use MVC\Router;

class ParacaidistaController
{
    public static function index(Router $router)
    {
        $paracaidistas = Paracaidista::all();
        $router->render('paracaidista/index', [
            'paracaidistas' => $paracaidistas,
        ]);
    }

    public static function guardarAPI()
    {
        try {
            $paracaidista = new Paracaidista($_POST);
            $resultado = $paracaidista->crear();

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
        $paraca_codigo = $_GET['paraca_codigo'];
        $paraca_civil_dpi = $_GET['paraca_civil_dpi'];

        $sql = "SELECT * FROM par_paracaidista where paraca_situacion = 1 ";

        if ($paraca_codigo != '') {
            $sql .= " and paraca_codigo = $paraca_codigo ";
        }

        if ($paraca_civil_dpi != '') {
            $sql .= " and paraca_civil_dpi like '%$paraca_civil_dpi%' ";
        }

        try {
            $paracaidistas = Paracaidista::fetchArray($sql);
            echo json_encode($paracaidistas);
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
            $paracaidista = new Paracaidista($_POST);
            $resultado = $paracaidista->actualizar();

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
            $paracaidista = Paracaidista::find($paraca_id);
            $paracaidista->paraca_situacion = 0;
            $resultado = $paracaidista->actualizar();

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
