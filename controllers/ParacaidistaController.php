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
            $paracaidista->paraca_fecha_graduacion = $_POST['fechaGraduacion'] ?? null;
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
        $sql = "SELECT 
                    p.*,
                    trim(pc.paraca_civil_nom1)||' '||trim(pc.paraca_civil_nom2)||' '||trim(pc.paraca_civil_ape1)||' '||trim(pc.paraca_civil_ape2) civil,
        
                    trim(pm.per_nom1)||' '||trim(pm.per_nom2)||' '||trim(pm.per_ape1)||' '||trim(pm.per_ape2) militar
                FROM par_paracaidista p
                LEFT JOIN par_paraca_civil pc on pc.paraca_civil_dpi = p.paraca_civil_dpi
                LEFT JOIN mper pm on pm.per_catalogo = p.paraca_codigo
                where paraca_situacion = 1 ";    

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
            $paracaidista->paraca_fecha_graduacion = $_POST['fechaGraduacion'] ?? null;
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
