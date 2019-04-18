<?php

namespace Core;

use mysql_xdevapi\Exception;

class Router
{
    /**
     * Associative array of routes
     * @var array
     */
    protected $routes = [];

    /**
     * Parameters from the matched rout
     * @var array
     */
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
        $route = '/^' . $route . '$/i';

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

        /*Match to the fixed URL format /controller/action
        $reg_exp = "/^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+$)/";*/

        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                //get named capture group values
                //$params = [];

                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }
                $this->params = $params;
                return true;
            }
        }
        return false;
    }


    /**
     * @param string $url the route URL
     * @return void
     */
    public function dispatch($url)
    {
        $url = $this->removeQueryStringVariables($url);

        if ($this->match($url)) {
            $controller = $this->params['controller'];
            $controller = $this->convertToStudlyCaps($controller);
//            $controller = "App\Controllers\\$controller";
            $controller = $this->getNamespace() . $controller;

            if (class_exists($controller)) {
                $controller_object = new $controller($this->params);

                $action = $this->params['action'];
                $action = $this->convertToCamelCase($action);

                if (is_callable([$controller_object, $action])) {
                    $controller_object->$action();

                } else {
//                    echo "Method $action (in controller $controller) not found";
                    throw new \Exception("Controller class $controller not found");
                }

            } else {
//                echo "Controller class $controller not found";
                throw new \Exception("Controller class $controller not found");
            }
        } else {
//            echo "No route matched.";
            throw new \Exception("No route matched");
        }
    }

    /**
     * Convert the string with hyphens to StudlyCaps,
     * e.g. post-autors => PostAutors
     *
     * @param string $string The string to convert
     * @return string
     */
    protected function convertToStudlyCaps($string)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }

    /**
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

    /**
     * @param string $url The full URL
     * @return string The URL with the query string variables removed
     */
    protected function removeQueryStringVariables($url)
    {
        if ($url != '') {
            $parts = explode('&', $url, 2);

            if (strpos($parts[0], '=') === false) {
                $url = $parts[0];
            } else {
                $url = '';
            }
        }
        return $url;
    }

    /**
     * Get the namespace for the controller class. The namespace defined in the
     * route parameters is added if present
     * @return string The request URL
     */
    protected function getNamespace()
    {
        $namespace = 'App\Controllers\\';
        if (array_key_exists('namespace', $this->params)) {
            $namespace .= $this->params['namespace'] . "\\";
        }
        return $namespace;
    }
}

