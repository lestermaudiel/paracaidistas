<?php

namespace Controllers;

use Exception;
use Model\Paracaidista; 
use Model\Manifiesto;
use MVC\Router;

class ControlController
{
    public static function index(Router $router)
    {
        $router->render('control/index', [

            
        ]);
    }


    public static function buscarAPI()
    {
$num_catalogo = $_GET['num_catalogo'];

        $sql = "SELECT
        pp.paraca_id AS id_paracaidista,
        mper.per_nom1 || ' ' || mper.per_ape1 AS nombre_paracaidista,
        grados.gra_desc_ct AS grado,
        NVL(pts.tipo_salto_detalle, 'Sin saltos') AS tipo_salto,
        COUNT(pm.mani_id) AS cantidad_de_saltos
    FROM
        par_paracaidista pp
    LEFT JOIN par_manifiesto pm ON pp.paraca_id = pm.mani_paraca_cod
    LEFT JOIN par_tipo_salto pts ON pm.mani_tipo_salto = pts.tipo_salto_id
    JOIN mper ON pp.paraca_codigo = mper.per_catalogo
    JOIN grados ON mper.per_grado = grados.gra_codigo
    WHERE
        mper.per_catalogo = '$num_catalogo'
    GROUP BY
        pp.paraca_id, mper.per_nom1, mper.per_ape1, grados.gra_desc_ct, pts.tipo_salto_detalle;
    ";

        try {
            $paracaidas = Paracaidista::fetchArray($sql);
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
