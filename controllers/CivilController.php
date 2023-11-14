<?php

namespace Controllers;

use Exception;
use Model\Civil;
use MVC\Router;

class CivilController
{
    public static function index(Router $router)
    {
        $civils = Civil::all();
        $router->render('civil/index', [
            'civils' => $civils,
        ]);
    }

    public static function guardarAPI()
    {
        try {
            $civil = new Civil($_POST);
            $resultado = $civil->crear();

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
        $civil_dpi = $_GET['civil_dpi'];

        $sql = "SELECT * FROM par_paraca_civil where paraca_civil_situacion = 1 ";
        if ($civil_dpi != '') {
            $sql .= " and paraca_civil_dpi like '%$civil_dpi%' ";
        }

        try {
            $civils = Civil::fetchArray($sql);
            echo json_encode($civils);
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
            $civil = new Civil($_POST);
            $resultado = $civil->actualizar();

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
            $civil_dpi = $_POST['paraca_civil_dpi'];
            $civil = Civil::find($civil_dpi);
            $civil->paraca_civil_situacion = 0;
            $resultado = $civil->actualizar();

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
