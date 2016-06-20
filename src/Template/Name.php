<?php

namespace Uph\Miklaj\Template;

use Uph\Miklaj\Template\TemplateEngine;
use LogicException;

class Name
{
    protected $engine;
    protected $name;

    public function __construct(TemplateEngine $engine, $name)
    {
        $this->engine = $engine;
        $this->name = $name;
    }

    public function setTemplateEngine(TemplateEngine $engine)
    {
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getFileName()
    {
        return $this->name . '.php';
    }

    public function getPath()
    {
        $directory = $this->engine->getDirectory();
        return $directory . DIRECTORY_SEPARATOR . $this->getFileName();
    }
}
