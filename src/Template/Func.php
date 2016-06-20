<?php

namespace Uph\Miklaj\Template;

use LogicException;


class Func
{
    protected $name;
    protected $callback;

    public function __construct($name, $callback)
    {
        $this->name = $name;
        $this->callback = $callback;
    }

    /**
     * Call the function.
     * @param  Template $template
     * @param  array    $arguments
     * @return mixed
     */
    public function call($arguments = array())
    {
        return call_user_func_array($this->callback, $arguments);
    }
}
