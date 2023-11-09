<?php
require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\AppController;
use Controllers\TiposParacaidasController;
use Controllers\TipoSaltoController;
use Controllers\ZonaSaltoController;
use Controllers\AltimetroController;
use Controllers\PistaController;
use Controllers\AeronaveController;
use Controllers\CivilController;

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

$router->comprobarRutas();
?>