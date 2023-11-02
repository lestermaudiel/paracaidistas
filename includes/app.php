<?php session_start();
use Dotenv\Dotenv;
use Model\ActiveRecord;


require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

ini_set('display_errors', $_ENV['DEBUG_MODE']);
ini_set('display_startup_errors', $_ENV['DEBUG_MODE']);
error_reporting(-$_ENV['DEBUG_MODE']);

require 'funciones.php';
require 'database.php';
// Conectarno s a la base de datos prueba2


ActiveRecord::setDB($db);