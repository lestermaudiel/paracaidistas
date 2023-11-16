<?php

namespace Controllers;

use Exception;
use Model\Manifiesto;
use Model\TiposParacaidas;
use Model\Aeronave;
use Model\Altimetro;
use Model\Civil;
use Model\Dependencia;
use Model\Organizacion;
use Model\Paracaidas;
use Model\Paracaidista;
use Model\Personal;
use Model\Pista;
use Model\TipoSalto;
use Model\ZonaSalto;

use MVC\Router;

class ManifiestoController
{
    public static function index(Router $router)
    {
        $manifiestos = Manifiesto::all();
        $router->render('manifiesto/index', [
            'manifiestos' => $manifiestos,
        ]);
    }

    public static function guardarAPI()
    {
        try {
            $manifiesto = new Manifiesto($_POST);
            $resultado = $manifiesto->crear();

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
        // Implementa la lógica para buscar según tus necesidades
    }

    public static function modificarAPI()
    {
        // Implementa la lógica para modificar según tus necesidades
    }

    public static function eliminarAPI()
    {
        // Implementa la lógica para eliminar según tus necesidades
    }
}
