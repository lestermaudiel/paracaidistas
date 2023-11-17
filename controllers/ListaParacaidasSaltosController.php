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
        *,
        paraca_saltos_total-paraca_saltos_uso saltos_disponibles,
        paraca_fecha_caducidad - TODAY || ' DIAS' tiempo_restante,
        tipo_par_descripcion
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



