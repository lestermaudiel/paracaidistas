<?php

namespace Controllers;

use Exception;
use Model\ZonaSalto;
use MVC\Router;

class ZonaSaltoController
{
    public static function index(Router $router)
    {
        $zonaSalto = ZonaSalto::all();
        $router->render('zonasalto/index', [
            'zonaSalto' => $zonaSalto,
        ]);
    }

    public static function guardarAPI()
    {
        try {
            $zonaSalto = new ZonaSalto($_POST);
            $resultado = $zonaSalto->crear();

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
        $zona_salto_nombre = $_GET['zona_salto_nombre'];
        $zona_salto_latitud = $_GET['zona_salto_latitud'];
        $zona_salto_longitud = $_GET['zona_salto_longitud'];
        $zona_salto_direc_latitud = $_GET['zona_salto_direc_latitud'];
        $zona_salto_direc_longitud = $_GET['zona_salto_direc_longitud'];
        
        $sql = "SELECT * FROM par_zona_salto where zona_salto_situacion = 1 ";
        
        if ($zona_salto_nombre != '') {
            $sql .= " and zona_salto_nombre like '%$zona_salto_nombre%' ";
        }
        if ($zona_salto_latitud != '') {
            $sql .= " and zona_salto_latitud = $zona_salto_latitud ";
        }
        if ($zona_salto_longitud != '') {
            $sql .= " and zona_salto_longitud = $zona_salto_longitud ";
        }
        if ($zona_salto_direc_latitud != '') {
            $sql .= " and zona_salto_direc_latitud like '%$zona_salto_direc_latitud%' ";
        }
        if ($zona_salto_direc_longitud != '') {
            $sql .= " and zona_salto_direc_longitud like '%$zona_salto_direc_longitud%' ";
        }
    
        try {
            $zonaSalto = ZonaSalto::fetchArray($sql);
            echo json_encode($zonaSalto);
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
            $zonaSalto = new ZonaSalto($_POST);
            $resultado = $zonaSalto->actualizar();

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
            $zona_salto_id = $_POST['zona_salto_id'];
            $zonaSalto = ZonaSalto::find($zona_salto_id);

            $zonaSalto->zona_salto_situacion = 0;
            $resultado = $zonaSalto->actualizar();

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
