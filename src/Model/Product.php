<?php

namespace Uph\Miklaj\Model;

class Product extends Table
{
    protected static $fields = [
        'id',
        'name',
        'description',
        'image_url',
        'category_id'
    ];
    protected static $table = 'product';


    public function getAbsoluteUrl()
    {
        return '/product/' . $this->id;
    }

    public function getAbsoluteEditUrl()
    {
        return '/product/' . $this->id . '/edit';
    }

    public function getAbsoluteDeleteUrl()
    {
        return '/product/' . $this->id . '/delete';
    }

    public function getAbsoluteVaraintCreateUrl()
    {
        return '/product/' . $this->id .'/create-variant';
    }
}
