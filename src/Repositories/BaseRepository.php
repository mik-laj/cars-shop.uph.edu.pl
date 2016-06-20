<?php

namespace Uph\Miklaj\Repositories;

use Uph\Miklaj\Template\TemplateEngine;
use \PDO;

class BaseRepository
{

    static protected $pdo;

    static protected $model;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function get($obj_id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `{$this->getTable()}` WHERE `id` = ? LIMIT 1");
        $stmt->execute([$obj_id]);
        $results = $stmt->fetchAll(PDO::FETCH_CLASS, static::$model);
        return is_array($results) && count($results) > 0 ? $results[0] : null;
    }

    public function getAll()
    {
        $stmt = $this->pdo->query("SELECT * FROM `{$this->getTable()}`");
        return $stmt->fetchAll(PDO::FETCH_CLASS, static::$model);
    }

    public function insert($data)
    {
        $setValues = $this->buildSetValues($data);
        $set = $setValues['set'];
        $values = $setValues['values'];

        $sql = "INSERT INTO `{$this->getTable()}` SET {$set}";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($values);
        return $this->pdo->lastInsertId();
    }

    public function update($id, $data)
    {
        $setValues = $this->buildSetValues($data);
        $set = $setValues['set'];
        $values = $setValues['values'];

        $values['where_id'] = $id;

        $stmt = $this->pdo->prepare("UPDATE `{$this->getTable()}` SET {$set} WHERE `id` = :where_id");
        $stmt->execute($values);
    }

    public function delete($id)
    {
        $values = ['where_id' => $id];

        $stmt = $this->pdo->prepare("DELETE FROM `{$this->getTable()}` WHERE `id` = :where_id");
        $stmt->execute($values);
    }

    private function buildSetValues($data)
    {
        $values = [];
        $set = "";
        $allowed_fields = $this->getfields();
        foreach ($allowed_fields as $field) {
            if (isset($data[$field])) {
                $set .= '`'. $field . '`'. '=:' . $field . ', ';
                $values[$field] = $data[$field];
            }
        }
        $set = substr($set, 0, -2);
        return ['values' => $values, 'set' => $set];
    }

    public function getTable()
    {
        return call_user_func(static::$model.'::getTable');
    }

    public function getFields()
    {
        return call_user_func(static::$model.'::getFields');
    }
}
