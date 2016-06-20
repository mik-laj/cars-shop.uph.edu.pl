<?php

namespace Uph\Miklaj\Model;

class Address extends Table
{
    protected static $fields = [
        'id',
        'user_id',
        'line_1',
        'line_2',
        'line_3',
        'city',
        'zip_or_province',
        'country'
    ];
    protected static $table = 'address';


    public function getAbsoluteUrl()
    {
        return '/user/' . $this->user_id . '/address/'. $this->id;
    }
}
