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

        //Convert variables with custom expressions e.g. {id:\d+}
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

        //Add start and end delimiters, and  case insensitive flag
        $route = '/^'.$route.'$/i';

        $this->routes[$route] = $params;
    }

    //Get routes table
    public function getRoutes()
    {
        return $this->routes;
    }
    //Get the currently matched parameters
    public function getParams()
    {
        return $this->params;
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


    /*
     *
     *
     * @param string $url the route URL
     *
     * @return void
     */

    public function dispatch($url)
    {
        if ($this->match($url))
        {
            $controller = $this->params['controller'];
            $controller = $this->convertToStudlyCaps($controller);

            if (class_exists($controller))
            {
                $controller_object = new $controller();

                $action = $this->params['action'];
                $action = $this->convertToCameCase($action);

                if (is_callable([$controller_object, $action]))
                {
                    $controller_object->$action();

                } else {
                    echo "Method $action (in controller $controller) not found";
                }

            } else {
                echo "Controller class $controller not found";
            }

        }
    }

    /*
     * Convert the string with hyphens to StudlyCaps,
     * e.g. post-autors => PostAutors
     *
     * @param string $string The string to convert
     */
    protected function convertToStudlyCaps($string)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }

    /*
     * Convert the string with hyphens to camelCase,
     * e.g. add-new => addNew
     *
     * @param string $string The string to convert
     * @return string
     */
    protected function convertToCamelCase($string)
    {
        return lcfirst($this->convertToStudlyCaps($string));
    }
}

