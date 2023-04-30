<?php

use App\Controllers\PostController;
use Core\Router;


Router::get('/posts', [PostController::class, 'index']);
Router::get('/posts/{id}', [PostController::class, 'show']);
Router::post('/posts', [PostController::class, 'store']);
Router::post('/posts/{id}', [PostController::class, 'update']);
Router::delete('/posts/{id}', [PostController::class, 'destroy']);

Router::get("/register", [\App\Controllers\AuthController::class, 'registerPage']);
Router::post("/register", [\App\Controllers\AuthController::class, 'register']);

Router::get('/login', [\App\Controllers\AuthController::class, 'loginPage']);
Router::post('/login', [\App\Controllers\AuthController::class, 'login']);

Router::get("/users/profile", function () {
    \Core\Session::start();
    $user = \Core\Session::get('user');
    return $user ? view("index", ['test' => "test"]) : json(['message' => 'Unauthorized'], 401);
});