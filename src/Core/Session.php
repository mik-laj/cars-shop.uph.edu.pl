<?php

namespace Uph\Miklaj\Core;

class Session implements \ArrayAccess
{
    public function __construct()
    {
    }

    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $_SESSION[] = $value;
        } else {
            $_SESSION[$offset] = $value;
        }
    }

    public function offsetExists($offset)
    {
        return isset($_SESSION[$offset]);
    }

    public function offsetUnset($offset)
    {
        unset($_SESSION[$offset]);
    }

    public function offsetGet($offset)
    {
        return isset($_SESSION[$offset]) ? $_SESSION[$offset] : null;
    }
}
