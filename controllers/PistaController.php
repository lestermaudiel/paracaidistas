<?php

namespace Controllers;

use Exception;
use Model\Pista; 
use MVC\Router;

class PistaController
{
    public static function index(Router $router)
    {
        $pista = Pista::all();
        $router->render('pista/index', [
            'pista' => $pista,
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
        $pista_salto_latitud = $_GET['pista_salto_latitud'];
        $pista_salto_longitud = $_GET['pista_salto_longitud'];
        $pista_salto_direc_latitud = $_GET['pista_salto_direc_latitud'];
        $pista_salto_direc_longitud = $_GET['pista_salto_direc_longitud'];
        
        $sql = "SELECT * FROM par_pista WHERE pista_situacion = 1 ";
        
        if ($pista_detalle != '') {
            $sql .= " and pista_detalle like '%$pista_detalle%' ";
        }
        if ($pista_salto_latitud != '') {
            $sql .= " and pista_salto_latitud = $pista_salto_latitud ";
        }
        if ($pista_salto_longitud != '') {
            $sql .= " and pista_salto_longitud = $pista_salto_longitud ";
        }
        if ($pista_salto_direc_latitud != '') {
            $sql .= " and pista_salto_direc_latitud like '%$pista_salto_direc_latitud%' ";
        }
        if ($pista_salto_direc_longitud != '') {
            $sql .= " and pista_salto_direc_longitud like '%$pista_salto_direc_longitud%' ";
        }
        // echo json_encode($sql);
        // exit;
    
        try {
            $pista = Pista::fetchArray($sql);
            echo json_encode($pista);
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
