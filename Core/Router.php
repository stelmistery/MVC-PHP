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
    public function add($route, $params = [])
    {
        //Convert the route to regular expression escape forward slashes
        $route = preg_replace('/\//', '\\/', $route);

        //Convert variables e.g.{controller}
        $route = preg_replace('/\{([a-z-]+)\}/', '(?P<\1>[a-z-]+)', $route);

        //Add start and end delimiters, and  case insensitive flag
        $route = '/^'.$route.'$/i';

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

        //Match to the fixed URL format /controller/action
        //$reg_exp = "/^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+$)/";

        foreach ($this->routes as $route => $params)
        {
            if(preg_match($route, $url, $matches))
            {
                //get named capture group values
                //$params = [];

                foreach ($matches as $key => $match)
                {
                    if (is_string($key))
                    {
                        $params[$key] = $match;
                    }
                }
                $this->params = $params;
                return true;
            }
        }


        return false;
    }

    //Get the currently matched parameters
    public function getParams()
    {
        return $this->params;
    }

}

