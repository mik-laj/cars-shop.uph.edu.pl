<?php

namespace Uph\Miklaj\Model;

class OrderItem extends Table
{
    protected static $fields = [
        'id',
        'product_variant_id',
        'order_id',
        'price'
    ];
    protected static $table = 'order_item';


    public function getAbsoluteUrl()
    {
        return '/category/' . $this->id;
    }
}
