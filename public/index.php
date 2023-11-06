<?php
require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\AppController;
use Controllers\TiposParacaidasController; 
use Controllers\TipoSaltoController; 

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

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
?>