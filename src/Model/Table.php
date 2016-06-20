<?php

namespace Uph\Miklaj\Model;

class Table
{
    protected static $fields;
    protected static $table;

    public static function getTable()
    {
        return static::$table;
    }

    public static function getFields()
    {
        return static::$fields;
    }
}
