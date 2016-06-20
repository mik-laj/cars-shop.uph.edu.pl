<?php

namespace Uph\Miklaj\Model;

class Order extends Table
{
    protected static $fields = [
        'id',
        'price',
        'user_id',
        'created_at',
        'note',
        'comment',
        'line_1',
        'line_2',
        'line_3',
        'city',
        'zip_or_province',
        'country'
    ];
    protected static $table = 'order';


    public function getAbsoluteUrl()
    {
        return '/order/' . $this->id;
    }

    public function getAbsoluteEditUrl()
    {
        return '/order/' . $this->id . '/edit';
    }

}
