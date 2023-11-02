<?php
require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\AppController;
use Controllers\TiposParacaidasController; // Cambia el nombre del controlador

$router = new Router();
$router->setBaseURL('/' . $_ENV['APP_NAME']);

$router->get('/', [AppController::class, 'index']);
$router->get('/tiposparacaidas', [TiposParacaidasController::class, 'index']); // Cambia la ruta
$router->post('/API/tiposparacaidas/guardar', [TiposParacaidasController::class, 'guardarAPI']); // Cambia la ruta
$router->post('/API/tiposparacaidas/modificar', [TiposParacaidasController::class, 'modificarAPI']); // Cambia la ruta
$router->post('/API/tiposparacaidas/eliminar', [TiposParacaidasController::class, 'eliminarAPI']); // Cambia la ruta
$router->get('/API/tiposparacaidas/buscar', [TiposParacaidasController::class, 'buscarAPI']); // Cambia la ruta

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
