<?php

namespace Uph\Miklaj\Repositories;

use Uph\Miklaj\Model\OrderItem;

use \PDO;

class OrderItemRepository extends BaseRepository
{

    static protected $model = OrderItem::class;

    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
    }
}
