<?php

namespace Controllers;

use Exception;
use Model\Paracaidas;
use MVC\Router;

class EstadisticaController
{
    public static function index(Router $router)
    {
        $router->render('estadisticas/index', []);
    }


    public static function getDataAPI(Router $router)
    {
        $sql = "   SELECT
        CASE
            WHEN paraca_estado = 1 THEN 'Buen Estado'
            WHEN paraca_estado = 2 THEN 'Regular Estado'
            WHEN paraca_estado = 3 THEN 'Mal Estado Reparable'
            WHEN paraca_estado = 4 THEN 'Mal Estado Irreparable'
            ELSE 'Otro'
        END AS categoria,
        COUNT(*) AS cantidad
    FROM
        par_paracaidas
    GROUP BY
        categoria";



        try {
            $resultados = Paracaidas::fetchArray($sql);
            echo json_encode($resultados);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);

        }
    }
}