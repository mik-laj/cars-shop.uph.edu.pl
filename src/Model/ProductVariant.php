<?php

namespace Uph\Miklaj\Model;

class ProductVariant extends Table
{
    protected static $fields = [
        'id',
        'name'
    ];
    protected static $table = 'product_variant';


    public function getAbsoluteUrl()
    {
        return '/product/' . $this->product_id . '/' . $this->id;
    }

    public function getAbsoluteEditUrl()
    {
        return '/product/' . $this->product_id . '/' . $this->id . '/edit';
    }

    public function getAbsoluteDeleteUrl()
    {
        return '/product/' . $this->product_id . '/' . $this->id . '/delete';
    }

    public function getAbsoluteApiUrl()
    {
        return '/product/' . $this->product_id . '/' . $this->id . '/api';
    }
}
