<?php

use CodeIgniter\Router\RouteCollection;
 
/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/Admin', 'Admin::index',['filter' => 'auth']);
$routes->get('/Admin/index', 'Admin::index',['filter' => 'auth']);
$routes->get('/Admin/success', 'Admin::success',['filter' => 'auth']);
$routes->get('/Admin/edit', 'Admin::edit',['filter' => 'auth']);
$routes->get('/Admin/delete', 'Admin::delete',['filter' => 'auth']);
$routes->setAutoRoute(true);
