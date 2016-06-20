<?php

namespace Uph\Miklaj\Repositories;

use Uph\Miklaj\Model\Address;

use \PDO;

class AddressRepository extends BaseRepository
{

    static protected $model = Address::class;

    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
    }
}
