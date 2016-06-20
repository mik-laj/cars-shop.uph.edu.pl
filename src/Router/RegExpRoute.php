<?php

namespace Uph\Miklaj\Router;

use Uph\Miklaj\Core\Request;

class RegExpRoute implements Route
{
    protected $pattern;
    protected $view;

    public function __construct($pattern, $view)
    {
        $this->pattern = $pattern;
        $this->view = $view;
    }

    public function match(Request $request)
    {
        if (preg_match($this->pattern, $request->filename, $matches)) {
            $request->router_data = $matches;
            return true;
        }
        return false;
    }

    public function getView()
    {
        return $this->view;
    }
}
