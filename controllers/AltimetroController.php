<?php

namespace Controllers;

use Exception;
use Model\Altimetro;
use MVC\Router;

class AltimetroController
{
    public static function index(Router $router)
    {
        $altimetros = Altimetro::all();
        $router->render('altimetro/index', [
            'altimetros' => $altimetros,
        ]);
    }

    public static function guardarAPI()
    {
        try {
            $altimetro = new Altimetro($_POST);
            $resultado = $altimetro->crear();

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
        $altimetro_serie = $_GET['altimetro_serie'];
    
        $sql = "SELECT * FROM par_altimetro WHERE altimetro_situacion = 1";
    
        if (!empty($altimetro_serie)) {
            $sql .= " AND altimetro_serie LIKE '%$altimetro_serie%'";
        }
    
        try {
            $altimetros = Altimetro::fetchArray($sql);
            echo json_encode($altimetros);
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
            $altimetro = new Altimetro($_POST);
            $resultado = $altimetro->actualizar();

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
            $altimetro_id = $_POST['altimetro_id'];
            $altimetro = Altimetro::find($altimetro_id);

            $altimetro->altimetro_situacion = 0;
            $resultado = $altimetro->actualizar();

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
