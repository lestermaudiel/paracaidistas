<?php

namespace Controllers;

use Exception;
use Model\Aeronave;
use MVC\Router;

class AeronaveController
{
    public static function index(Router $router)
    {
        $aeronaves = Aeronave::all();
        $router->render('aeronave/index', [
            'aeronaves' => $aeronaves,
        ]);
    }

    public static function guardarAPI()
    {
        try {
            $aeronave = new Aeronave($_POST);
            $resultado = $aeronave->crear();

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
        $aer_desc_aeronave = $_GET['aer_desc_aeronave'];
    
        $sql = "SELECT * FROM fag_tip_aeronave WHERE aer_tip_situacion = '1'";
    
        if (!empty($aer_desc_aeronave)) {
            $sql .= " AND aer_desc_aeronave LIKE '%$aer_desc_aeronave%'";
        }
    
        try {
            $aeronaves = Aeronave::fetchArray($sql);
            echo json_encode($aeronaves);
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
            $aeronave = new Aeronave($_POST);
            $resultado = $aeronave->actualizar();

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
            $aer_tip_registro = $_POST['aer_tip_registro'];
            $aeronave = Aeronave::find($aer_tip_registro);

            $aeronave->aer_tip_situacion = '0';
            $resultado = $aeronave->actualizar();

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
