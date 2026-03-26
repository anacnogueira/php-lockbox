<?php

use Core\Route;

use App\Controllers\IndexController;
use App\Controllers\LoginController;
use App\Controllers\LogoutController;
use App\Controllers\RegisterController;
use App\Controllers\Notas;

use App\Middlewares\AuthMiddleware;
use App\Middlewares\GuestMiddleware;

(new Route())

    // Guest
    ->get('/', IndexController::class, GuestMiddleware::class)
    ->get('/login', [LoginController::class, 'index'], GuestMiddleware::class)
    ->post('/login', [LoginController::class, 'login'], GuestMiddleware::class)
    ->get('/registrar', [RegisterController::class, 'index'], GuestMiddleware::class)
    ->post('/registrar', [RegisterController::class, 'register'], GuestMiddleware::class)

    // Auth
     ->get('/logout', LogoutController::class, AuthMiddleware::class)
    ->get('/notas', Notas\IndexController::class, AuthMiddleware::class)
    ->get('/notas/criar', [Notas\CriarController ::class, 'index'], AuthMiddleware::class)
    ->post('/notas/criar', [Notas\CriarController ::class, 'store'], AuthMiddleware::class)
    ->put('/nota', Notas\AtualizarController ::class, AuthMiddleware::class)
    ->delete('/nota', Notas\ExcluirController ::class, AuthMiddleware::class)

    ->get('/confirmar', [Notas\VisualizarController ::class, 'confirm'], AuthMiddleware::class)
    ->post('/mostrar', [Notas\VisualizarController ::class, 'show'], AuthMiddleware::class)
    ->get('/esconder', [Notas\VisualizarController ::class, 'hide'], AuthMiddleware::class)


    
->run();
