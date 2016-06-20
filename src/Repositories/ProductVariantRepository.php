<?php

namespace Uph\Miklaj\Repositories;

use Uph\Miklaj\Model\ProductVariant;

use \PDO;

class ProductVariantRepository extends BaseRepository
{

    static protected $model = ProductVariant::class;

    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
    }

    public function getAllForProductId($product_id)
    {
        $sql = <<<EOT
            SELECT
                `product_variant`.*
            FROM
                `product_variant`
            WHERE
                `product_id` = ?
EOT;

        $query = $this->pdo->query($sql);
        $query->execute([$product_id]);
        return $query->fetchAll(PDO::FETCH_CLASS, ProductVariant::class);
    }
}
