<?php
namespace Controllers;

use Exception;
use Model\TipoSalto;
use MVC\Router;

class TipoSaltoController
{
    public static function index(Router $router)
    {
        $tipoSalto = TipoSalto::all();
        $router->render('tiposalto/index', [
            'tipoSalto' => $tipoSalto,
        ]);
    }

    public static function guardarAPI()
    {
        try {
            $tipoSalto = new TipoSalto($_POST);
            $resultado = $tipoSalto->crear();

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
        $tipo_salto_detalle = $_GET['tipo_salto_detalle'];

        $sql = "SELECT * FROM par_tipo_salto where tipo_salto_situacion = 1 ";
        if ($tipo_salto_detalle != '') {
            $sql .= " and tipo_salto_detalle like '%$tipo_salto_detalle%' ";
        }

        try {
            $tipoSalto = TipoSalto::fetchArray($sql);
            echo json_encode($tipoSalto);
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
            $tipoSalto = new TipoSalto($_POST);
            $resultado = $tipoSalto->actualizar();

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
            $tipo_salto_id = $_POST['tipo_salto_id'];
            $tipoSalto = TipoSalto::find($tipo_salto_id);
            $tipoSalto->tipo_salto_situacion = 0;
            $resultado = $tipoSalto->actualizar();

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
