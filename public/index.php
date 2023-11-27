<?php
require_once __DIR__ . '/../includes/app.php';

use Controllers\CartillaEnganchadoController;
use MVC\Router;
use Controllers\AppController;
use Controllers\TiposParacaidasController;
use Controllers\TipoSaltoController;
use Controllers\ZonaSaltoController;
use Controllers\AltimetroController;
use Controllers\PistaController;
use Controllers\AeronaveController;
use Controllers\CivilController;
use Controllers\ParacaidasController;  
use Controllers\ManifiestoController;  
use Controllers\ParacaidistaController;  
use Controllers\ListaParacaidasController; 
use Controllers\ListaParacaidasSaltosController; 
use Controllers\ControlController; 
use Controllers\ControlCivilController; 
use Controllers\ReporteController; 


$router = new Router();
$router->setBaseURL('/' . $_ENV['APP_NAME']);

$router->get('/', [AppController::class, 'index']);
$router->get('/tiposparacaidas', [TiposParacaidasController::class, 'index']);
$router->post('/API/tiposparacaidas/guardar', [TiposParacaidasController::class, 'guardarAPI']);
$router->post('/API/tiposparacaidas/modificar', [TiposParacaidasController::class, 'modificarAPI']);
$router->post('/API/tiposparacaidas/eliminar', [TiposParacaidasController::class, 'eliminarAPI']);
$router->get('/API/tiposparacaidas/buscar', [TiposParacaidasController::class, 'buscarAPI']);

$router->get('/tiposalto', [TipoSaltoController::class, 'index']);
$router->post('/API/tiposalto/guardar', [TipoSaltoController::class, 'guardarAPI']);
$router->post('/API/tiposalto/modificar', [TipoSaltoController::class, 'modificarAPI']);
$router->post('/API/tiposalto/eliminar', [TipoSaltoController::class, 'eliminarAPI']);
$router->get('/API/tiposalto/buscar', [TipoSaltoController::class, 'buscarAPI']);

$router->get('/zonasalto', [ZonaSaltoController::class, 'index']);
$router->post('/API/zonasalto/guardar', [ZonaSaltoController::class, 'guardarAPI']);
$router->post('/API/zonasalto/modificar', [ZonaSaltoController::class, 'modificarAPI']);
$router->post('/API/zonasalto/eliminar', [ZonaSaltoController::class, 'eliminarAPI']);
$router->get('/API/zonasalto/buscar', [ZonaSaltoController::class, 'buscarAPI']);

$router->get('/altimetro', [AltimetroController::class, 'index']);
$router->post('/API/altimetro/guardar', [AltimetroController::class, 'guardarAPI']);
$router->post('/API/altimetro/modificar', [AltimetroController::class, 'modificarAPI']);
$router->post('/API/altimetro/eliminar', [AltimetroController::class, 'eliminarAPI']);
$router->get('/API/altimetro/buscar', [AltimetroController::class, 'buscarAPI']);

$router->get('/pista', [PistaController::class, 'index']);
$router->post('/API/pista/guardar', [PistaController::class, 'guardarAPI']);
$router->post('/API/pista/modificar', [PistaController::class, 'modificarAPI']);
$router->post('/API/pista/eliminar', [PistaController::class, 'eliminarAPI']);
$router->get('/API/pista/buscar', [PistaController::class, 'buscarAPI']);

$router->get('/aeronave', [AeronaveController::class, 'index']);
$router->post('/API/aeronave/guardar', [AeronaveController::class, 'guardarAPI']);
$router->post('/API/aeronave/modificar', [AeronaveController::class, 'modificarAPI']);
$router->post('/API/aeronave/eliminar', [AeronaveController::class, 'eliminarAPI']);
$router->get('/API/aeronave/buscar', [AeronaveController::class, 'buscarAPI']);

$router->get('/civil', [CivilController::class, 'index']);
$router->post('/API/civil/guardar', [CivilController::class, 'guardarAPI']);
$router->post('/API/civil/modificar', [CivilController::class, 'modificarAPI']);
$router->post('/API/civil/eliminar', [CivilController::class, 'eliminarAPI']);
$router->get('/API/civil/buscar', [CivilController::class, 'buscarAPI']);

$router->get('/paracaidas', [ParacaidasController::class, 'index']);
$router->post('/API/paracaidas/guardar', [ParacaidasController::class, 'guardarAPI']);
$router->post('/API/paracaidas/modificar', [ParacaidasController::class, 'modificarAPI']);
$router->post('/API/paracaidas/eliminar', [ParacaidasController::class, 'eliminarAPI']);
$router->get('/API/paracaidas/buscar', [ParacaidasController::class, 'buscarAPI']);

$router->get('/listaparacaidas', [ListaParacaidasController::class, 'index']);
$router->post('/API/listaparacaidas/guardar', [ListaParacaidasController::class, 'guardarAPI']);
$router->post('/API/listaparacaidas/modificar', [ListaParacaidasController::class, 'modificarAPI']);
$router->post('/API/listaparacaidas/eliminar', [ListaParacaidasController::class, 'eliminarAPI']);
$router->get('/API/listaparacaidas/buscar', [ListaParacaidasController::class, 'buscarAPI']);

$router->get('/listaparacaidassaltos', [ListaParacaidasSaltosController::class, 'index']);
$router->post('/API/listaparacaidassaltos/guardar', [ListaParacaidasSaltosController::class, 'guardarAPI']);
$router->post('/API/listaparacaidassaltos/modificar', [ListaParacaidasSaltosController::class, 'modificarAPI']);
$router->post('/API/listaparacaidassaltos/eliminar', [ListaParacaidasSaltosController::class, 'eliminarAPI']);
$router->get('/API/listaparacaidassaltos/buscar', [ListaParacaidasSaltosController::class, 'buscarAPI']);

$router->get('/manifiesto', [ManifiestoController::class, 'index']);
$router->post('/API/manifiesto/guardar', [ManifiestoController::class, 'guardarAPI']);
$router->post('/API/manifiesto/modificar', [ManifiestoController::class, 'modificarAPI']);
$router->post('/API/manifiesto/eliminar', [ManifiestoController::class, 'eliminarAPI']);
$router->post('/API/manifiesto/aprobar', [ManifiestoController::class, 'aprobarAPI']);
$router->post('/API/manifiesto/denegar', [ManifiestoController::class, 'denegarAPI']);
$router->get('/API/manifiesto/buscar', [ManifiestoController::class, 'buscarAPI']);
$router->get('/API/manifiesto/getParacaidista', [ManifiestoController::class, 'getParacaidista']);
$router->get('/API/manifiesto/getJefeSalto', [ManifiestoController::class, 'getJefeSaltoAPI']);
$router->post('/API/manifiesto/guardarDetalle', [ManifiestoController::class, 'guardarDetalleAPI']);

$router->get('/paracaidista', [ParacaidistaController::class, 'index']);
$router->post('/API/paracaidista/guardar', [ParacaidistaController::class, 'guardarAPI']);
$router->post('/API/paracaidista/modificar', [ParacaidistaController::class, 'modificarAPI']);
$router->post('/API/paracaidista/eliminar', [ParacaidistaController::class, 'eliminarAPI']);
$router->get('/API/paracaidista/buscar', [ParacaidistaController::class, 'buscarAPI']);

$router->get('/control', [ControlController::class, 'index']);
$router->get('/API/control/buscar', [ControlController::class, 'buscarAPI']);


$router->get('/controlcivil', [ControlCivilController::class, 'index']);
$router->get('/API/controlcivil/buscar', [ControlCivilController::class, 'buscarAPI']);


$router->get('/cartillaenganchado', [CartillaEnganchadoController::class, 'index']);


//reporte

$router->get('/pdf', [ReporteController::class,'pdf']);

$router->comprobarRutas();
?>