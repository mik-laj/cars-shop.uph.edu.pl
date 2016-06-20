<?php

namespace Uph\Miklaj\Template;

use LogicException;

class Functions
{
    protected $functions = array();

    public function add($name, $callback)
    {
        $this->functions[$name] = new Func($name, $callback);
        return $this;
    }

    public function remove($name)
    {
        unset($this->functions[$name]);
        return $this;
    }

    public function get($name)
    {
        return $this->functions[$name];
    }

    public function exists($name)
    {
        return isset($this->functions[$name]);
    }
}
