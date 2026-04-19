<?php

use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\RolController;
use App\Controllers\UsuarioController;

$router->get('/', [AuthController::class, 'showLogin']);
$router->get('/login', [AuthController::class, 'showLogin']);
$router->post('/login', [AuthController::class, 'login']);
$router->get('/logout', [AuthController::class, 'logout'], ['auth' => true]);

$router->get('/dashboard', [DashboardController::class, 'index'], ['auth' => true, 'permission' => 'ver_dashboard']);

$router->get('/roles', [RolController::class, 'index'], ['auth' => true, 'permission' => 'gestionar_roles']);
$router->post('/roles/store', [RolController::class, 'store'], ['auth' => true, 'permission' => 'crear_roles']);
$router->post('/roles/update', [RolController::class, 'update'], ['auth' => true, 'permission' => 'editar_roles']);
$router->post('/roles/delete', [RolController::class, 'destroy'], ['auth' => true, 'permission' => 'eliminar_roles']);

$router->get('/usuarios', [UsuarioController::class, 'index'], ['auth' => true, 'permission' => 'gestionar_usuarios']);
$router->post('/usuarios/store', [UsuarioController::class, 'store'], ['auth' => true, 'permission' => 'crear_usuarios']);
$router->post('/usuarios/update', [UsuarioController::class, 'update'], ['auth' => true, 'permission' => 'editar_usuarios']);
$router->post('/usuarios/delete', [UsuarioController::class, 'destroy'], ['auth' => true, 'permission' => 'eliminar_usuarios']);
$router->post('/usuarios/reset-password', [UsuarioController::class, 'resetPassword'], ['auth' => true, 'permission' => 'editar_usuarios']);
