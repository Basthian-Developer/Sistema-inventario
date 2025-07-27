<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Vistas\Home_View::index');
$routes->get('dashboard', 'Vistas\Dashboard_View::index');

$routes->post('auth/login', 'Auth\AuthController::login');
$routes->post('auth/logout', 'Auth\AuthController::logout');
$routes->post('auth/renovar', 'Auth\AuthController::renovarAccessToken');

$routes->post('tablas/obtenerAuditoria', 'Tablas\TablasController::obtenerAuditoria');
$routes->post('tablas/exportarAuditoria', 'Tablas\TablasController::exportarAuditoria');

$routes->get('csrf', 'Csrf\CsrfController::getCsrf');
