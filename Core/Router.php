<?php

class Router
{
    //Associative array of routes
    // @var array
    protected $routes = [];

    //Parameters from the matched rout
    //@var array
    protected $params = [];

    // Add rout to the routing table
    public function add($route, $params)
    {
        $this->routes[$route] = $params;
    }

    //Get routes table
    public function getRoutes()
    {
        return $this->routes;
    }

    //Match the route to the routes in the routing table, settings the $params
    public function match($url)
    {
        /*foreach ($this->routes as $route => $params) {
            if ($url == $route) {
                $this->params = $params;
                return true;
            }
        }
        return false;*/


    }

    //Get the currently matched parameters
    public function getParams()
    {
        return $this->params;
    }

}

