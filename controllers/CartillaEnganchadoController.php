<?php

namespace Controllers;

use Exception;
use Model\Paracaidista; 
use Model\Manifiesto;
use MVC\Router;

class CartillaEnganchadoController
{
    public static function index(Router $router)
    {
        $router->render('cartillaenganchado/index', []);
    }

    
}
