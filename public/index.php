<?php
/**
 *   Front Controller
 *   PHP 7.2
 */
require '../Core/Router.php';

$router = new Router();

//echo get_class($router);

// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('posts', ['controller' => 'Posts', 'action' => 'index']);
//$router->add('posts/new', ['controller' => 'Posts', 'action' => 'new']);

$router->add('{controller}/{action}');
$router->add('admin/{controller}/{action}');

/*//Display the routing table
echo '<pre>';
var_dump($router->getRoutes());
echo '</pre>';*/

//Match the requested url
$url = $_SERVER['QUERY_STRING'];

if ($router->match($url))
{
    echo '<pre>';
    var_dump($router->getParams());
    echo '</pre>';
} else {
    echo "No route found for URL: ". $url;
}