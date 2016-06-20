<?php

namespace Uph\Miklaj\Model;

class Category extends Table
{
    protected static $fields = ['id', 'name'];
    protected static $table = 'category';


    public function getAbsoluteUrl()
    {
        return '/category/' . $this->id;
    }

    public function getAbsoluteEditUrl()
    {
        return '/category/' . $this->id . '/edit';
    }

    public function getAbsoluteDeleteUrl()
    {
        return '/category/' . $this->id . '/delete';
    }
}
