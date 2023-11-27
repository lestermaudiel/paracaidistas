<?php

namespace Controllers;

use Model\ActiveRecord;
use Mpdf\Mpdf;
use MVC\Router;

class ReporteController {
    public static function pdf (Router $router){
        $id_paracaidista = $_GET['id_paracaidista'];

        $data = static::GetInforme($id_paracaidista);
        $mpdf = new Mpdf([
            "orientation" => "L",
            "default_font_size" => 12,
            "default_font" => "arial",
            "format" => "Letter",
            "mode" => 'utf-8'
        ]);
        $mpdf->SetMargins(30,35,25);

        $html = $router->load('reporte/pdf',[
            'dataSet' => $data,
        ]);
        // $htmlHeader = $router->load('reporte/header', [
        //     'saludo' => $saludo
        // ]);
        // $htmlFooter = $router->load('reporte/footer');
        // $mpdf->SetHTMLHeader($htmlHeader);
        // $mpdf->SetHTMLFooter($htmlFooter);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    private static function GetInforme($id_paracaidista) {

        $sql="  SELECT         
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
    INNER JOIN par_paracaidas PAR ON DM.detalle_paracaidas = PAR.paraca_tipo
    INNER JOIN par_tipo_paracaidas TP ON PAR.paraca_tipo = TP.tipo_par_id
    INNER JOIN fag_tip_aeronave TA ON M.mani_tipo_aeronave = TA.aer_tip_registro
    INNER JOIN par_tipo_salto TS ON M.mani_tipo_salto = TS.tipo_salto_id
    INNER JOIN mper pj ON M.mani_jefe = pj.per_catalogo
    INNER JOIN grados G ON G.gra_codigo = pj.per_grado
    WHERE (P.paraca_codigo = $id_paracaidista OR P.paraca_civil_dpi = $id_paracaidista)
    AND TS.tipo_salto_detalle = 'ENGANCHADO'
    ORDER BY M.mani_id ASC";

        $resultados = ActiveRecord::fetchArray($sql);

        return $resultados;        
    }
}