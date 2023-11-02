<?php

namespace Controllers;

use Exception;
use Model\TiposParacaidas;
use MVC\Router;

class TiposParacaidasController {
    public static function index(Router $router) {
        $tiposParacaidas = TiposParacaidas::all();
        $router->render('tiposparacaidas/index', [
            'tiposParacaidas' => $tiposParacaidas,
        ]);
    }

    public static function guardarAPI() {
        try {
            $tipoParacaidas = new TiposParacaidas($_POST);
            $resultado = $tipoParacaidas->crear();

            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Registro guardado correctamente',
                    'codigo' => 1,
                ]);
            } else {
                echo json_encode([
                    'mensaje' => 'Ocurrió un error',
                    'codigo' => 0,
                ]);
            }
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0,
            ]);
        }
    }

    public static function modificarAPI() {
        try {
            $tipoParacaidas = new TiposParacaidas($_POST);
            $resultado = $tipoParacaidas->actualizar();

            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Registro modificado correctamente',
                    'codigo' => 1,
                ]);
            } else {
                echo json_encode([
                    'mensaje' => 'Ocurrió un error',
                    'codigo' => 0,
                ]);
            }
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0,
            ]);
        }
    }

    public static function eliminarAPI() {
        try {
            $tipo_par_id = $_POST['tipo_par_id'];
            $tipoParacaidas = TiposParacaidas::find($tipo_par_id);
            $tipoParacaidas->tipo_paracaidas_situacion = 0; // Asegúrate de usar la propiedad correcta
            $resultado = $tipoParacaidas->actualizar();

            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Registro eliminado correctamente',
                    'codigo' => 1,
                ]);
            } else {
                echo json_encode([
                    'mensaje' => 'Ocurrió un error',
                    'codigo' => 0,
                ]);
            }
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0,
            ]);
        }
    }

    public static function buscarAPI() {
        $tipo_par_lote = $_GET['tipo_par_lote'];
        $tipo_par_descripcion = $_GET['tipo_par_descripcion'];

        $sql = "SELECT * FROM par_tipo_paracaidas WHERE tipo_par_id > 0 "; // Cambia el nombre de la tabla
        if ($tipo_par_lote !== '') {
            $sql .= " AND tipo_par_lote LIKE '%$tipo_par_lote%' ";
        }
        if ($tipo_par_descripcion !== '') {
            $sql .= " AND tipo_par_descripcion LIKE '%$tipo_par_descripcion%' ";
        }

        try {
            $tiposParacaidas = TiposParacaidas::fetchArray($sql);
            echo json_encode($tiposParacaidas);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0,
            ]);
        }
    }
}
