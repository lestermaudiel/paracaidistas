<?php

namespace Controllers;

use Exception;
use Model\ActiveRecord;
use Model\DetalleManifiesto;
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
use Model\Grado;

use MVC\Router;

class ManifiestoController
{
    
    public static function index(Router $router)
    {
        // $pistaObjeto = new Pista();
        // $pistas = $pistaObjeto->getPista();

        $pista = new Pista();
        $pistas = $pista->getPista();

        $pista2 = new Pista();
        $pistas2 = $pista2->getPista2();


        // $tiposParacaidasObjeto = new TiposParacaidas();
        // $tiposParacaidas = $tiposParacaidasObjeto->getTipoParacaidas();

        $aeronaveObjeto = new Aeronave();
        $aeronaves = $aeronaveObjeto->getAeronave();

        $altimetroObjeto = new Altimetro();
        $altimetros = $altimetroObjeto->getAltimetro();

        // $civilObjeto = new Civil();
        // $civiles = $civilObjeto->getCivil();

        $dependenciaObjeto = new Dependencia();
        $dependencias = $dependenciaObjeto->getDependencia();

        // $organizacionObjeto = new Organizacion();
        // $organizaciones = $organizacionObjeto->getOrganizacion();

        $paracaidasObjeto = new Paracaidas();
        $paracaidas = $paracaidasObjeto->getParacaidas();

        // $paracaidistaObjeto = new Paracaidista();
        // $paracaidistas = $paracaidistaObjeto->getParacaidista(); 

        // $gradoObjeto = new Grado();
        // $grado = $gradoObjeto->getGrado(); 


        $tipoSaltoObjeto = new TipoSalto();
        $tiposSalto = $tipoSaltoObjeto->getPeTipoSalto();

        $zonaSaltoObjeto = new ZonaSalto();
        $zonasSalto = $zonaSaltoObjeto->getZonaSalto();

        $router->render('manifiesto/index', [
            'pistas' => $pistas,
            'pistas2' => $pistas2,
            // 'tiposParacaidas' => $tiposParacaidas,
            'aeronaves' => $aeronaves,
            // 'altimetros' => $altimetros,
            // 'civiles' => $civiles,
            'dependencias' => $dependencias,
            // 'grado' => $grado,
            // 'organizaciones' => $organizaciones,
            'paracaidas' => $paracaidas,
            // 'paracaidistas' => $paracaidistas,
            'tiposSalto' => $tiposSalto,
            'zonasSalto' => $zonasSalto,

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

    public static function modificarAPI()
    {
        // Implementa la lógica para modificar según tus necesidades
    }

    public static function eliminarAPI()
    {
        // Implementa la lógica para eliminar según tus necesidades
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
            'detalle_mani_id'=>$_POST['detalle_mani_id'], 
            'detalle_paracaidista' =>$idParacaidista['paraca_id'],
            'detalle_paracaidas' =>$idParacaidas['paraca_id'], 
            'detalle_altimetro' =>$idAltimetro['altimetro_id']
            );


        // $_POST['detalle_mani_id'] = $_POST['detalle_manifiesto'];
        // $_POST['detalle_paracaidista'] = $idParacaidista;
        // $_POST['detalle_paracaidas'] = $idParacaidas;
        // $_POST['detalle_altimetro'] = $idAltimetro;
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

//     public static function getParacaidista()
//     {
//         $codigo_paracaidista = $_GET['codigo_paracaidista'];
//         if ($codigo_paracaidista != '') {
//             $sql = "SELECT 
//                     p.paraca_id,
//                     case 
//                         when p.paraca_codigo is null
//                             then trim(pc.paraca_civil_nom1)||' '||trim(pc.paraca_civil_nom2)||' '||trim(pc.paraca_civil_ape1)||' '||trim(pc.paraca_civil_ape2)
//                         else trim(pm.per_nom1)||' '||trim(pm.per_nom2)||' '||trim(pm.per_ape1)||' '||trim(pm.per_ape2)
//                     end nombre_paracaidista
//                 from par_paracaidista p
//                 LEFT JOIN par_paraca_civil pc on pc.paraca_civil_dpi=p.paraca_civil_dpi
//                 LEFT JOIN mper pm on p.paraca_codigo=pm.per_catalogo
//                 where p.paraca_situacion = 1 
//                 and (p.paraca_civil_dpi = $codigo_paracaidista 
//                 or p.paraca_codigo = $codigo_paracaidista)";
//         } else {
//             echo json_encode([]);
//         }
//         try {
//             $paracaidista = Paracaidista::fetchArray($sql);
//             echo json_encode($paracaidista);
//         } catch (Exception $e) {
//             echo json_encode([
//                 'detalle' => $e->getMessage(),
//                 'mensaje' => 'Ocurrió un error',
//                 'codigo' => 0
//             ]);
//         }
//     }
// }