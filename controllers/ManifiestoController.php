<?php

namespace Controllers;

use Exception;
use Model\ActiveRecord;
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
use Model\TipoSalto;
use Model\ZonaSalto;
use Model\Pista;

use MVC\Router;

class ManifiestoController
{
    public static function index(Router $router)
    {
        // $pistaObjeto = new Pista();
        // $pistas = $pistaObjeto->getPista();

        // $tiposParacaidasObjeto = new TiposParacaidas();
        // $tiposParacaidas = $tiposParacaidasObjeto->getTipoParacaidas();

        // $aeronaveObjeto = new Aeronave();
        // $aeronaves = $aeronaveObjeto->getAeronave();

        // $altimetroObjeto = new Altimetro();
        // $altimetros = $altimetroObjeto->getAltimetro();

        // $civilObjeto = new Civil();
        // $civiles = $civilObjeto->getCivil();

        $dependenciaObjeto = new Dependencia();
        $dependencias = $dependenciaObjeto->getDependencia();

        // $organizacionObjeto = new Organizacion();
        // $organizaciones = $organizacionObjeto->getOrganizacion();

        // $paracaidasObjeto = new Paracaidas();
        // $paracaidas = $paracaidasObjeto->getParacaidas();

        // $paracaidistaObjeto = new Paracaidista();
        // $paracaidistas = $paracaidistaObjeto->getParacaidista(); 

        // $tipoSaltoObjeto = new TipoSalto();
        // $tiposSalto = $tipoSaltoObjeto->getPeTipoSalto();

        // $zonaSaltoObjeto = new ZonaSalto();
        // $zonasSalto = $zonaSaltoObjeto->getZonaSalto();

        $router->render('manifiesto/index', [
            // 'pistas' => $pistas,
            // 'tiposParacaidas' => $tiposParacaidas,
            // 'aeronaves' => $aeronaves,
            // 'altimetros' => $altimetros,
            // 'civiles' => $civiles,
            'dependencias' => $dependencias,
            // 'organizaciones' => $organizaciones,
            // 'paracaidas' => $paracaidas,
            // 'paracaidistas' => $paracaidistas,
            // 'tiposSalto' => $tiposSalto,
            // 'zonasSalto' => $zonasSalto,
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



    public static function getParacaidista()
    {
        $codigo_paracaidista = $_GET['codigo_paracaidista'];
        if ($codigo_paracaidista != '') {
            $sql = "SELECT 
                    case 
                        when p.paraca_codigo is null
                            then trim(pc.paraca_civil_nom1)||' '||trim(pc.paraca_civil_nom2)||' '||trim(pc.paraca_civil_ape1)||' '||trim(pc.paraca_civil_ape2)
                        else trim(pm.per_nom1)||' '||trim(pm.per_nom2)||' '||trim(pm.per_ape1)||' '||trim(pm.per_ape2)
                    end nombre_paracaidista
                from par_paracaidista p
                LEFT JOIN par_paraca_civil pc on pc.paraca_civil_dpi=p.paraca_civil_dpi
                LEFT JOIN mper pm on p.paraca_codigo=pm.per_catalogo
                where p.paraca_situacion = 1 
                and (p.paraca_civil_dpi = $codigo_paracaidista 
                or p.paraca_codigo = $codigo_paracaidista)";
        } else {
            echo json_encode([]);
        }
        try {
            $paracaidista = Paracaidista::fetchArray($sql);
            echo json_encode($paracaidista);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
}