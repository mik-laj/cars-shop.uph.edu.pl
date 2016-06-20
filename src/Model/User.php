<?php

namespace Uph\Miklaj\Model;

class User extends Table
{
    protected static $fields = [
        'id',
        'name',
        'login',
        'password'
    ];
    protected static $table = 'user';


    public function getAbsoluteUrl()
    {
        return '/user/' . $this->id;
    }
}
