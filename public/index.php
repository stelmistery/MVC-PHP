<?php
/**
 *   Front Controller
 *   PHP 7.2
 */

/*
 * Require the controller class
 */
require '../App/Controllers/Posts.php';

/*
 * Routing
 */
require '../Core/Router.php';
$router = new Router();

/*
 * Add the routes in routes table
 */
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');


/*//Display the routing table
echo '<pre>';
var_dump($router->getRoutes());
echo '</pre>';

//Match the requested url
$url = $_SERVER['QUERY_STRING'];

if ($router->match($url))
{
    echo '<pre>';
    var_dump($router->getParams());
    echo '</pre>';
} else {
    echo "No route found for URL: ". $url;
}*/

$router->dispatch($_SERVER['QUERY_STRING']);