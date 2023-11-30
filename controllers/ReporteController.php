<?php

namespace Controllers;

use Model\ActiveRecord;
use Mpdf\Mpdf;
use MVC\Router;

class ReporteController
{
    public static function pdf(Router $router)
    {
        $id_paracaidista = $_GET['id_paracaidista'];

        $data = static::GetInforme($id_paracaidista);
        $info = static::GetInfo($id_paracaidista);
        $mpdf = new Mpdf([
            "orientation" => "L",
            "default_font_size" => 12,
            "default_font" => "arial",
            "format" => "Letter",
            "mode" => 'utf-8'
        ]);
        $mpdf->SetMargins(30, 35, 25);

        $html = $router->load('reporte/pdf', [
            'dataSet' => $data,
            'info' => $info[0],

        ]);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
    private static function GetInfo($info)
    {
        $sql = " SELECT
                CASE WHEN p.paraca_codigo is null
                    THEN  trim(pc.paraca_civil_nom1)||' '||trim(pc.paraca_civil_nom2)||' '||trim(pc.paraca_civil_ape1)||' '||trim(pc.paraca_civil_ape2) 
                    ELSE trim(mper.per_nom1)||' '||trim(mper.per_nom2)||' '||trim(mper.per_ape1)||' '||trim(mper.per_ape2) 
                END AS nombre,
                CASE WHEN g.gra_codigo is null
                    THEN 'SIN GRADO (CIVIL)'
                    ELSE g.gra_desc_md 
                END AS grado,
                p.paraca_fecha_graduacion AS graduacion,
                p.paraca_id AS serie,
                CASE WHEN mdep.dep_llave is null
                    THEN 'SIN UNIDAD (CIVIL)'
                    ELSE mdep.dep_desc_lg 
                END AS unidad                      
            FROM
                par_paracaidista p
                LEFT JOIN mper  ON p.paraca_codigo = mper.per_catalogo
                LEFT JOIN par_paraca_civil pc ON p.paraca_civil_dpi = pc.paraca_civil_dpi
                LEFT JOIN grados g ON mper.per_grado = g.gra_codigo
                LEFT JOIN morg ON morg.org_plaza = mper.per_plaza
                LEFT JOIN mdep ON mdep.dep_llave = morg.org_dependencia
            WHERE
            p.paraca_codigo=$info or p.paraca_civil_dpi=$info";
        $resultados = ActiveRecord::fetchArray($sql);

        return $resultados;
    }

    private static function GetInforme($id_paracaidista)
    {

        $sql = "  SELECT         
        mdep.dep_desc_ct AS UNIDAD,
        PZ.zona_salto_nombre AS ZONA_SALTO,
        M.mani_fecha AS FECHA,
        DM.detalle_stick AS STICK,
        TA.aer_desc_aeronave AS AVION,
        TP.tipo_par_descripcion AS TIPO_PARACAIDAS,
        TS.tipo_salto_detalle AS TIPO_SALTO,
        trim(pj.per_nom1)||' '||trim(pj.per_nom2)||' '||trim(pj.per_ape1)||' '||trim(pj.per_ape2) AS JEFE,
        G.gra_desc_md AS GRADO_JEFE,
        M.mani_observacion AS OBSERVACION         
    FROM par_detalle_manifiesto DM
    INNER JOIN par_manifiesto M ON DM.detalle_mani_id = M.mani_id
    LEFT JOIN par_paracaidista P ON DM.detalle_paracaidista = P.paraca_id
    INNER JOIN mdep ON M.mani_unidad = mdep.dep_llave
    INNER JOIN par_zona_salto PZ ON M.mani_zona_salto = PZ.zona_salto_id
    INNER JOIN par_paracaidas PAR ON DM.detalle_paracaidas = PAR.paraca_id
    INNER JOIN par_tipo_paracaidas TP ON PAR.paraca_tipo = TP.tipo_par_id
    INNER JOIN fag_tip_aeronave TA ON M.mani_tipo_aeronave = TA.aer_tip_registro
    INNER JOIN par_tipo_salto TS ON M.mani_tipo_salto = TS.tipo_salto_id
    INNER JOIN mper pj ON M.mani_jefe = pj.per_catalogo
    INNER JOIN grados G ON G.gra_codigo = pj.per_grado
    WHERE (P.paraca_codigo = $id_paracaidista OR P.paraca_civil_dpi = $id_paracaidista)
    AND TS.tipo_salto_detalle = 'ENGANCHADO'
    ORDER BY M.mani_id ASC
    ";

        $resultados = ActiveRecord::fetchArray($sql);

        return $resultados;
    }
}