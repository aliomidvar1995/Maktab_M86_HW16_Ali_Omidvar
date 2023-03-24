<?php

require_once "../vendor/autoload.php";

use controller\BrainController;
use controller\GeneralController;
use controller\HeartController;
use controller\HomeController;
use controller\InternalController;
use controller\KidneyController;
use controller\LoginController;
use controller\LogoutController;
use controller\ManagerController;
use controller\PatientController;
use controller\PatientSearchController;
use controller\RegisterController;
use controller\DoctorController;
use core\Application;
use Dotenv\Dotenv;



$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ]
];


$app = new Application(dirname(__DIR__), $config);

$app->router->get('/', [HomeController::class, 'create']);

$app->router->get('/general', [GeneralController::class, 'create']);

$app->router->get('/brain', [BrainController::class, 'create']);

$app->router->get('/heart', [HeartController::class, 'create']);

$app->router->get('/kidney', [KidneyController::class, 'create']);

$app->router->get('/internal', [InternalController::class, 'create']);

$app->router->get('/doctor', [DoctorController::class, 'create']);

$app->router->post('/doctor', [DoctorController::class, 'store']);

$app->router->get('/patient', [PatientController::class, 'create']);

$app->router->post('/patient', [PatientController::class, 'store']);

$app->router->post('/patient/search', [PatientSearchController::class, 'index']);

$app->router->get('/manager', [ManagerController::class, 'create']);

$app->router->get('/register', [RegisterController::class, 'create']);

$app->router->post('/register', [RegisterController::class, 'store']);

$app->router->get('/login', [LoginController::class, 'create']);

$app->router->post('/login', [LoginController::class, 'show']);

$app->router->get('/logout', [LogoutController::class, 'create']);

$app->run();