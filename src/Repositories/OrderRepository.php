<?php

namespace Uph\Miklaj\Repositories;

use Uph\Miklaj\Model\Order;

use \PDO;

class OrderRepository extends BaseRepository
{

    static protected $model = Order::class;

    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
    }

    public function getAllForUser($user_id){
        $sql = <<<EOT
            SELECT
                `order`.*
            FROM
                `order`
            WHERE
                `user_id` = ?
EOT;

        $query = $this->pdo->query($sql);
        $query->execute([$user_id]);
        return $query->fetchAll(PDO::FETCH_CLASS, Order::class);
    }

    public function getWithProductsInfo($order_id){
        $sql = <<<EOT
            SELECT
                `order_item`.`price` as `order_item_price`,
                `product_variant`.`name` as `variant_name`,
                `product_variant`.`id` as `variant_id`,
                `product`.`name` as `product_name`,
                `product`.`id` as `product_id`
            FROM
                `order`
                INNER JOIN
                    `order_item`
                    ON
                        `order`.`id` = `order_item`.`order_id`
                INNER JOIN
                    `product_variant`
                    ON
                        `order_item`.`product_variant_id` = `product_variant`.`id`
                INNER JOIN
                    `product`
                    ON
                        `product_variant`.`product_id` = `product`.`id`
            WHERE
                `order`.`id` = ?
EOT;

        $query = $this->pdo->query($sql);
        $query->execute([$order_id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
