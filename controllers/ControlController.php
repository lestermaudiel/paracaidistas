<?php

namespace Controllers;

use Exception;
use Model\ActiveRecord;
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

    public static function getAlas()
    {
        $num_catalogo = $_GET['num_catalogo'];

        $sql = "SELECT
                    'TOTALES' descripcion,
                    FLOOR(count(1)/30*100) porcentaje
                FROM
                    par_detalle_manifiesto dm
                    INNER JOIN par_paracaidista p ON dm.detalle_paracaidista=p.paraca_id
                
                WHERE
                    p.paraca_codigo = $num_catalogo
                    or
                    p.paraca_civil_dpi = $num_catalogo
            
                UNION

                SELECT
                    'TACTICOS' descripcion,
                    FLOOR(count(1)/15*100) porcentaje
                FROM
                    par_detalle_manifiesto dm
                    INNER JOIN par_paracaidista p ON dm.detalle_paracaidista=p.paraca_id  
                    INNER JOIN par_manifiesto m ON dm.detalle_mani_id = m.mani_id
                    INNER JOIN par_tipo_salto ts ON m.mani_tipo_salto = ts.tipo_salto_id
                
                WHERE
                    ts.tipo_salto_detalle = 'TACTICO'
                    and
                    (p.paraca_codigo = $num_catalogo or p.paraca_civil_dpi = $num_catalogo)
                UNION  
                SELECT
                    'JEFE' descripcion,
                    FLOOR(count(1)/2*100) porcentaje
                FROM
                    par_manifiesto m   
                WHERE
                    m.mani_jefe= $num_catalogo";

        try {
            $alas = ActiveRecord::fetchArray($sql);
            echo json_encode($alas);
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
        $num_catalogo = $_GET['num_catalogo'];

        $sql = "SELECT
        pp.paraca_id,
        mper.per_nom1 || ' ' || mper.per_ape1 AS nombre_paracaidista,
        grados.gra_desc_ct AS grado,
        pp.paraca_codigo AS codigo, 
        detalle.detalle_paracaidista,
        pts.tipo_salto_detalle,
        detalle.cantidad_saltos
    FROM
        par_paracaidista pp
    LEFT JOIN (
        SELECT
            pds.detalle_paracaidista,
            pm.mani_tipo_salto AS detalle_tipo_salto,
            COUNT(*) AS cantidad_saltos
        FROM
            par_detalle_manifiesto pds
        INNER JOIN
            par_manifiesto pm ON pds.detalle_mani_id = pm.mani_id
        GROUP BY
            pds.detalle_paracaidista, pm.mani_tipo_salto
    ) detalle ON pp.paraca_id = detalle.detalle_paracaidista
    LEFT JOIN par_tipo_salto pts ON detalle.detalle_tipo_salto = pts.tipo_salto_id
    LEFT JOIN mper ON pp.paraca_codigo = mper.per_catalogo
    LEFT JOIN grados ON mper.per_grado = grados.gra_codigo
    WHERE
        pp.paraca_codigo = '$num_catalogo';
    
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
