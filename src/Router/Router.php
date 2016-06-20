<?php

namespace Uph\Miklaj\Router;

use Uph\Miklaj\Router\Route;
use Uph\Miklaj\Core\View;
use Uph\Miklaj\Core\Request;

class Router
{
    protected $routes = [];
    protected $default = null;

    public function any(Route $route)
    {
        $this->routes[] = $route;
    }

    public function get(Route $route)
    {
        $this->routes[] = new MethodRoute(['GET'], $route);
    }

    public function post(Route $route)
    {
        $this->routes[] = new MethodRoute(['POST'], $route);
    }

    public function setDefault($view)
    {
        $this->default = $view;
    }

    public function findRoute(Request $request)
    {
        foreach ($this->routes as $route) {
            if ($route->match($request)) {
                return $route->getView();
            }
        }
        return $this->default;
    }
}
