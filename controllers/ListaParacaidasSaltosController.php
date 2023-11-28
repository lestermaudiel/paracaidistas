<?php

namespace Controllers;

use Exception;
use Model\Paracaidas;
use Model\TiposParacaidas;
use MVC\Router;

class ListaParacaidasSaltosController
{
    public static function index(Router $router)
    {
        $tipoparacaidas = new TiposParacaidas();
        $tipoparacaidas = $tipoparacaidas->getTipoParacaidas();
        $router->render('listaparacaidassaltos/index', [

            'tipoParacaidas' => $tipoparacaidas,
        ]);
    }


    public static function buscarAPI()
    {


        $sql = "SELECT 
        paraca_cupula AS cupula,
        paraca_arnes AS arnes,
        tipo_par_descripcion AS tipo_paracaidas,
        paraca_saltos_total AS saltos_totales,
        paraca_saltos_uso AS saltos_uso,
        paraca_saltos_total - paraca_saltos_uso AS saltos_disponibles,
        paraca_fecha_caducidad AS fecha_caducidad,
        LPAD(TRUNC((paraca_fecha_caducidad - TODAY) / 365), 2, '0') || ' a. ' ||
        LPAD(TRUNC(MOD((paraca_fecha_caducidad - TODAY) / 30, 12)), 2, '0') || ' m. ' ||
        LPAD(MOD((paraca_fecha_caducidad - TODAY), 30), 2, '0') || ' dd.' AS tiempo_restante_formateado
    FROM par_paracaidas 
    INNER JOIN par_tipo_paracaidas ON paraca_tipo = tipo_par_id
    WHERE paraca_situacion = 1;
    ";

        try {
            $paracaidas = Paracaidas::fetchArray($sql);
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



