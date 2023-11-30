<?php

namespace Controllers;

use Exception;
use Model\Pista;
use MVC\Router;

class PistaController
{
    public static function index(Router $router)
    {
        $pistas = Pista::all();
        $router->render('pista/index', [
            'pistas' => $pistas,
        ]);
    }
    public static function guardarAPI()
    {
        try {
            $pista = new Pista($_POST);
            $resultado = $pista->crear();

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
        $pista_detalle = $_GET['pista_detalle'];

        $sql = "SELECT * FROM par_pista where pista_situacion = 1 ";
        if ($pista_detalle != '') {
            $sql .= " and pista_detalle like '%$pista_detalle%' ";
        }

        try {
            $pistas = Pista::fetchArray($sql);
            echo json_encode($pistas);
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
            $pista = new Pista($_POST);
            $resultado = $pista->actualizar();

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
            $pista_id = $_POST['pista_id'];
            $pista = Pista::find($pista_id);
            $pista->pista_situacion = 0;
            $resultado = $pista->actualizar();

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
