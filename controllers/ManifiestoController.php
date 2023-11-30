<?php

namespace Controllers;

use Exception;
use Model\ActiveRecord;
use Model\DetalleManifiesto;
use Model\Manifiesto;
use Model\Aeronave;
use Model\Altimetro;
use Model\Dependencia;
use Model\Paracaidas;
use Model\Personal;
use Model\TipoSalto;
use Model\ZonaSalto;
use Model\Pista;
use Model\Plantrabajo;

use MVC\Router;

class ManifiestoController
{

    public static function index(Router $router)
    {

        $pista = new Pista();
        $pistas = $pista->getPista();

        $pista2 = new Pista();
        $pistas2 = $pista2->getPista2();

        $aeronaveObjeto = new Aeronave();
        $aeronaves = $aeronaveObjeto->getAeronave();

        $altimetroObjeto = new Altimetro();
        $altimetros = $altimetroObjeto->getAltimetro();

        $dependenciaObjeto = new Dependencia();
        $dependencias = $dependenciaObjeto->getDependencia();

        $paracaidasObjeto = new Paracaidas();
        $paracaidas = $paracaidasObjeto->getParacaidas();

        $tipoSaltoObjeto = new TipoSalto();
        $tiposSalto = $tipoSaltoObjeto->getPeTipoSalto();

        $zonaSaltoObjeto = new ZonaSalto();
        $zonasSalto = $zonaSaltoObjeto->getZonaSalto();

        $plantrabajoObjeto = new Plantrabajo();
        $plantrabajo = $plantrabajoObjeto->getPlantrabajo();

        $router->render('manifiesto/index', [
            'pistas' => $pistas,
            'pistas2' => $pistas2,
            'aeronaves' => $aeronaves,
            'dependencias' => $dependencias,
            'paracaidas' => $paracaidas,
            'tiposSalto' => $tiposSalto,
            'zonasSalto' => $zonasSalto,
            'plantrabajo' => $plantrabajo,

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
                    'mensaje' => 'Ocurrió un error al insertar',
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

    public static function getJefeSaltoAPI()
    {
        $codigo_jefe = $_GET['codigo_jefe'];
        if ($codigo_jefe != '') {
            $sql = "SELECT 
                    trim(pm.per_nom1)||' '||trim(pm.per_nom2)||' '||trim(pm.per_ape1)||' '||trim(pm.per_ape2) nombre_jefe
                FROM mper pm
                WHERE pm.per_catalogo = $codigo_jefe";
        } else {
            echo json_encode([]);
        }

        try {
            $jefeSalto = Personal::fetchArray($sql);
            echo json_encode($jefeSalto);
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

        $sql = "SELECT 
                    mani_id,
                    mani_plan_trabajo,
                    mani_no_avion,
                    mani_no_vuelo,
                    tipo_salto_detalle,
                    mani_fecha,
                    mani_altura,
                    mani_observacion,
                    trim(pm.per_nom1)||' '||trim(pm.per_nom2)||' '||trim(pm.per_ape1)||' '||trim(pm.per_ape2) nombre_jefe
                FROM par_manifiesto 
                inner join par_tipo_salto on mani_tipo_salto=tipo_salto_id
                inner join mper pm on per_catalogo=mani_jefe
                WHERE mani_situacion = 1";

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

    public static function aprobarAPI()
    {
        try {
            $manifiesto_id = $_POST['mani_id'];
            $manifiesto = Manifiesto::find($manifiesto_id);
            $manifiesto->mani_situacion = 2;
            $resultado = $manifiesto->actualizar();

            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Registro eliminado correctamente',
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

    public static function denegarAPI()
    {
        try {
            $manifiesto_id = $_POST['mani_id'];
            $manifiesto = Manifiesto::find($manifiesto_id);
            $manifiesto->mani_situacion = 3;
            $resultado = $manifiesto->actualizar();

            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Registro eliminado correctamente',
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

    public static function guardarDetalleAPI()
    {

        $catalogo = $_POST['detalle_paracaidista'];
        $paracaidas = $_POST['detalle_paracaidas'];
        $altimetro = $_POST['detalle_altimetro'];
        $stick = $_POST['detalle_stick'];


        $sqlParacaidista = " SELECT 
                                paraca_id 
                            FROM par_paracaidista
                            WHERE paraca_codigo = '$catalogo'
                            or paraca_civil_dpi= '$catalogo'";

        $idParacaidista = ActiveRecord::fetchFirst($sqlParacaidista);


        $sqlParacaidas = "SELECT 
                            paraca_id
                        FROM par_paracaidas
                        WHERE paraca_cupula = '$paracaidas'";

        $idParacaidas = ActiveRecord::fetchFirst($sqlParacaidas);


        $sqlAltimetro = "SELECT 
                            altimetro_id
                        FROM par_altimetro
                        WHERE altimetro_serie =$altimetro";

        $idAltimetro = ActiveRecord::fetchFirst($sqlAltimetro);

        $arr = array(
            'detalle_mani_id' => $_POST['detalle_mani_id'],
            'detalle_paracaidista' => $idParacaidista['paraca_id'],
            'detalle_paracaidas' => $idParacaidas['paraca_id'],
            'detalle_altimetro' => $idAltimetro['altimetro_id'],
            'detalle_stick' => $stick
        );

        $paracaidasID = $idParacaidas['paraca_id'];
        $paracaidasObject = Paracaidas::find($paracaidasID);
        $paracaidasObject->paraca_saltos_uso++;
        $resultado = $paracaidasObject->actualizar();

        try {
            $detalleManifiesto = new DetalleManifiesto($arr);
            $resultado = $detalleManifiesto->crear();

            if ($resultado['resultado'] == 1) {


                echo json_encode([
                    'mensaje' => 'Registro guardado correctamente',
                    'codigo' => 1
                ]);
            } else {
                echo json_encode([
                    'mensaje' => 'Ocurrió un error al insertar',
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

}