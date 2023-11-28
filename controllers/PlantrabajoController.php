<?php

namespace Controllers;

use Exception;
use Model\Plantrabajo;
use MVC\Router;

class PlantrabajoController
{
    public static function index(Router $router)
    {
        $planesTrabajo = Plantrabajo::all();
        $router->render('plantrabajo/index', [
            'planesTrabajo' => $planesTrabajo,
        ]);
    }

    public static function guardarAPI()
    {
        try {
            $plantrabajo = new Plantrabajo($_POST);
            $resultado = $plantrabajo->crear();

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
        $plan_codigo = $_GET['plan_codigo'];

        $sql = "SELECT * FROM par_plantrabajo WHERE plan_situacion = 1";
        if ($plan_codigo != '') {
            $sql .= " AND plan_codigo LIKE '%$plan_codigo%'";
        }

        try {
            $planesTrabajo = Plantrabajo::fetchArray($sql);
            echo json_encode($planesTrabajo);
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
            $plantrabajo = new Plantrabajo($_POST);
            $resultado = $plantrabajo->actualizar();

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
            $plan_id = $_POST['plan_id'];
            $plantrabajo = Plantrabajo::find($plan_id);
            $plantrabajo->plan_situacion = 0;
            $resultado = $plantrabajo->actualizar();

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
