<?php

namespace Uph\Miklaj\Template;

use Uph\Miklaj\Template\TemplateEngine;
use LogicException;

class Template
{
    protected $engine;
    protected $name;
    protected $data = [];
    protected $sections = [];
    protected $layoutName;
    protected $layoutData;

    public function __construct(TemplateEngine $engine, $name)
    {
        $this->engine = $engine;
        $this->name = new Name($engine, $name);
        $this->data = $this->engine->getData($name);
    }

    public function __call($name, $arguments)
    {
        return $this->engine->getFunction($name)->call($arguments);
    }

    public function data(array $data)
    {
        $this->data = array_merge($this->data, $data);
    }

    public function path()
    {
        return $this->name->getPath();
    }

    public function render(array $data = [])
    {
        $this->data($data);
        unset($data);
        extract($this->data);
        ob_start();
        include $this->path();
        $content = ob_get_clean();

        // Inheritance
        if (isset($this->layoutName)) {
            $layout = $this->engine->make($this->layoutName);
            $layout->sections = array_merge($this->sections, ['content' => $content]);
            $content = $layout->render($this->layoutData);
        }

        return $content;
    }

    protected function layout($name, array $data = array())
    {
        $this->layoutName = $name;
        $this->layoutData = $data;
    }

    protected function start($name)
    {
        $this->sections[$name] = '';
        ob_start();
    }

    protected function stop()
    {
        end($this->sections);
        $this->sections[key($this->sections)] = ob_get_clean();
    }

    protected function section($name, $default = null)
    {
        if (!isset($this->sections[$name])) {
            return $default;
        }

        return $this->sections[$name];
    }

    protected function fetch($name, array $data = array())
    {
        return $this->engine->render($name, $data);
    }

    protected function insert($name, array $data = array())
    {
        echo $this->fetch($name, $data);
    }

    protected function batch($var, $functions)
    {
        foreach (explode('|', $functions) as $function) {
            if ($this->engine->doesFunctionExist($function)) {
                $var = call_user_func(array($this, $function), $var);
            } elseif (is_callable($function)) {
                $var = call_user_func($function, $var);
            } elseif ($function == 'escape') {
                $var = $this->escape($var);
            } else {
                throw new LogicException(
                    'The batch function could not find the "' . $function . '" function.'
                );
            }
        }

        return $var;
    }

    protected function escape($string)
    {
        return htmlspecialchars($string, ENT_SUBSTITUTE, 'UTF-8');
    }

    protected function e($string)
    {
        return $this->escape($string);
    }
}
