<?php

namespace Controllers;

use Exception;
use Model\Civil;
use MVC\Router;

class CivilController
{
    public static function index(Router $router)
    {
        $civil = Civil::all();
        $router->render('civil/index', [
            'civil' => $civil,
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
        $paracaidista_civil_dpi = $_GET['paracaidista_civil_dpi'];
        $paracaidista_civil_nombre = $_GET['paracaidista_civil_nombre'];
        $paracaidista_civil_apellidos = $_GET['paracaidista_civil_apellidos'];
        $paracaidista_civil_telefono = $_GET['paracaidista_civil_telefono'];
        $paracaidista_civil_direccion = $_GET['paracaidista_civil_direccion'];
        $paracaidista_civil_correo_electronico = $_GET['paracaidista_civil_correo_electronico'];
        $paracaidista_civil_saltos = $_GET['paracaidista_civil_saltos'];

        
        
        $sql = "SELECT * FROM paraca_paracaidistas_civil WHERE paracaidista_civil_situacion = 1 ";

        if ($paracaidista_civil_dpi != '') {
            $sql .= "AND paracaidista_civil_dpi = $paracaidista_civil_dpi' ";
        }
        if ($paracaidista_civil_nombre != '') {
            $sql .= "AND paracaidista_civil_nombre LIKE '%$paracaidista_civil_nombre%' ";
        }
        if ($paracaidista_civil_apellidos != '') {
            $sql .= "AND paracaidista_civil_apellidos LIKE '%$paracaidista_civil_apellidos%' ";
        }

        if ($paracaidista_civil_telefono != '') {
            $sql .= "AND paracaidista_civil_telefono LIKE '%$paracaidista_civil_telefono%' ";
        }
        if ($paracaidista_civil_direccion != '') {
            $sql .= "AND paracaidista_civil_direccion LIKE '%$paracaidista_civil_direccion%' ";
        }
        if ($paracaidista_civil_correo_electronico != '') {
            $sql .= "AND paracaidista_civil_correo_electronico LIKE '%$paracaidista_civil_correo_electronico%' ";
        }
        if ($paracaidista_civil_saltos != '') {
            $sql .= "AND paracaidista_civil_saltos = $paracaidista_civil_saltos' ";
        }

        try {
            $civil = Civil::fetchArray($sql);
            echo json_encode($civil);
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
            $paracaidista_civil_dpi = $_POST['paracaidista_civil_dpi'];
            $civil = Civil::find($paracaidista_civil_dpi);

            $civil->paracaidista_civil_situacion = 0;
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
