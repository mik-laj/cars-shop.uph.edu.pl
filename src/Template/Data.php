<?php

namespace Uph\Miklaj\Template;

use LogicException;

class Data
{
    protected $sharedVariables = [];

    public function add(array $data)
    {
        $this->sharedVariables = array_merge($this->sharedVariables, $data);
    }

    public function get()
    {
        return $this->sharedVariables;
    }
}
