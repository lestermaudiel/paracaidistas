<?php

namespace Controllers;

use Exception;
use Model\Paracaidista; 
use Model\Manifiesto;
use MVC\Router;

class ControlCivilController
{
    public static function index(Router $router)
    {
        $router->render('controlcivil/index', []);
    }

    public static function buscarAPI()
    {
        $dpi_paracaidista = $_GET['dpi_paracaidista'];

        $sql = "SELECT
            pc.paraca_civil_dpi AS dpi_paracaidista,
            pc.paraca_civil_nom1 || ' ' || pc.paraca_civil_ape1 AS nombre_paracaidista,
            pts.tipo_salto_detalle,
            COUNT(pm.mani_id) AS cantidad_saltos
        FROM
            par_paraca_civil pc
        LEFT JOIN
            par_paracaidista pp ON pc.paraca_civil_dpi = pp.paraca_civil_dpi
        LEFT JOIN
            par_detalle_manifiesto pdm ON pp.paraca_id = pdm.detalle_paracaidista
        LEFT JOIN
            par_manifiesto pm ON pdm.detalle_mani_id = pm.mani_id
        LEFT JOIN
            par_tipo_salto pts ON pm.mani_tipo_salto = pts.tipo_salto_id
        WHERE
            pc.paraca_civil_dpi = '$dpi_paracaidista'
        GROUP BY
            pc.paraca_civil_dpi, nombre_paracaidista, pts.tipo_salto_detalle";

        try {
            $paracaidas = Paracaidista::fetchArray($sql, ['dpi_paracaidista' => $dpi_paracaidista]);
            echo json_encode($paracaidas);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
}
