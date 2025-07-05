<?php
require_once '../core/Router.php';
require_once '../core/Controller.php';
require_once '../app/Controllers/HomeController.php';
require_once '../app/Models/User.php';

$router = new Router();

$router->get('/', [HomeController::class, 'index']);

$router->post('/api/upload', [HomeController::class, 'upload']);


$router->dispatch();
