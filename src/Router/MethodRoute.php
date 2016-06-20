<?php

namespace Uph\Miklaj\Router;

use Uph\Miklaj\Core\Request;
use Uph\Miklaj\Core\View;

class MethodRoute implements Route
{
    protected $allowed_methods;
    protected $route;

    public function __construct($allowed_methods, Route $route)
    {
        $this->allowed_methods = $allowed_methods;
        $this->route = $route;
    }

    public function match(Request $request)
    {
        if (in_array($request->method, $this->allowed_methods)) {
            return $this->route->match($request);
        }
        return false;
    }

    public function getView()
    {
        return $this->route->getView();
    }
}
