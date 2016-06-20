<?php

namespace Uph\Miklaj\Template;

use Uph\Miklaj\Template\Data;
use Uph\Miklaj\Template\Func;
use Uph\Miklaj\Template\Functions;
use Uph\Miklaj\Template\Name;
use Uph\Miklaj\Template\Template;

class TemplateEngine
{
    protected $functions;
    protected $data;

    public function __construct($directory = null)
    {
        $this->directory = $directory;
        $this->functions = new Functions();
        $this->data = new Data();
    }

    public function getDirectory()
    {
        return $this->directory;
    }

    public function addData(array $data)
    {
        $this->data->add($data);
        return $this;
    }

    public function getData()
    {
        return $this->data->get();
    }

    public function registerFunction($name, $callback)
    {
        $this->functions->add($name, $callback);
        return $this;
    }

    public function getFunction($name)
    {
        return $this->functions->get($name);
    }

    public function doesFunctionExist($name)
    {
        return $this->functions->exists($name);
    }

    public function make($name)
    {
        return new Template($this, $name);
    }

    public function render($name, array $data = array())
    {
        return $this->make($name)->render($data);
    }
}
