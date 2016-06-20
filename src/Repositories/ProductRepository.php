<?php

namespace Uph\Miklaj\Repositories;

use Uph\Miklaj\Model\Product;

use \PDO;

class ProductRepository extends BaseRepository
{

    static protected $model = Product::class;

    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
    }
}
