<?php

namespace Uph\Miklaj\Repositories;

use Uph\Miklaj\Model\Category;
use Uph\Miklaj\Model\Product;

use \PDO;

class CategoryRepository extends BaseRepository
{

    static protected $model = Category::class;

    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
    }

    public function getCategoryProducts($category_id)
    {
        $sql = <<<EOT
            SELECT
                `product`.*
            FROM
                `product`
            INNER JOIN
                `category`
                ON
                    `category`.`id` = `product`.`category_id`
            WHERE
                `category_id` = ?
EOT;

        $query = $this->pdo->query($sql);
        $query->execute([$category_id]);
        return $query->fetchAll(PDO::FETCH_CLASS, Product::class);
    }

    public function getCategoryKeyPair()
    {
        $sql = <<<EOT
            SELECT
                `category`.id, `category`.name
            FROM
                `category`

EOT;

        $query = $this->pdo->query($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_KEY_PAIR);
    }
}
