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
    public static function getTipoParacaidas(Router $router)
    {
        $sql = "SELECT
            tipo_par_descripcion AS tipo_paracaida,
            COUNT(*) AS cantidad
        FROM
            par_paracaidas
        JOIN
            par_tipo_paracaidas ON par_paracaidas.paraca_tipo = par_tipo_paracaidas.tipo_par_id
        GROUP BY
            tipo_par_descripcion";
    
        try {
            $resultados = Paracaidas::fetchArray($sql);
            echo json_encode($resultados);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error al obtener estadísticas de Tipo de Paracaídas',
                'codigo' => 0
            ]);
        }
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

public static function getCaducidadParacaidasAPI(Router $router)
{
    $sql = "SELECT
    CASE
        WHEN paraca_fecha_caducidad > TODAY + 365 UNITS DAY THEN 'Más de un año'
        WHEN paraca_fecha_caducidad > TODAY + 180 UNITS DAY THEN 'Más de 6 meses'
        WHEN paraca_fecha_caducidad > TODAY + 90 UNITS DAY THEN 'De 6 meses a 3 meses'
        WHEN paraca_fecha_caducidad > TODAY + 30 UNITS DAY THEN 'De 3 meses a 1 mes'
        ELSE 'Menos de 1 mes'
    END AS tiempo_caducidad,
    COUNT(*) AS cantidad
FROM
    par_paracaidas
GROUP BY
    tiempo_caducidad";

    try {
        $resultados = Paracaidas::fetchArray($sql);
        echo json_encode($resultados);
    } catch (Exception $e) {
        echo json_encode([
            'detalle' => $e->getMessage(),
            'mensaje' => 'Ocurrió un error al obtener estadísticas de disponibilidad por fecha de caducidad',
            'codigo' => 0
        ]);
    }
}

public static function getSaltosDisponibilidadAPI(Router $router)
{
    $sql = "SELECT
        CASE
            WHEN paraca_saltos_uso > 1000 THEN 'Más de 1000 saltos'
            WHEN paraca_saltos_uso BETWEEN 100 AND 1000 THEN 'De 100 a 1000 saltos'
            WHEN paraca_saltos_uso BETWEEN 50 AND 100 THEN 'De 50 a 100 saltos'
            WHEN paraca_saltos_uso BETWEEN 1 AND 50 THEN 'De 1 a 50 saltos'
            WHEN paraca_saltos_uso <= 0 THEN 'Sin saltos disponibles'
            ELSE 'Otro'
        END AS disponibilidad_saltos,
        COUNT(*) AS cantidad
    FROM
        par_paracaidas
    GROUP BY
        disponibilidad_saltos";

    try {
        $resultados = Paracaidas::fetchArray($sql);
        echo json_encode($resultados);
    } catch (Exception $e) {
        echo json_encode([
            'detalle' => $e->getMessage(),
            'mensaje' => 'Ocurrió un error al obtener estadísticas de disponibilidad por saltos',
            'codigo' => 0
        ]);
    }
}




    
}