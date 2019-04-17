<?php
/**
 *  Front Controller
 *  PHP 7.2
 */

require_once '../vendor/autoload.php';

$router = new \Core\Router();

/*
 * Add the routes in routes table
 */
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);

$router->dispatch($_SERVER['QUERY_STRING']);