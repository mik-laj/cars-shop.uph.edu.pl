<?php

namespace Uph\Miklaj\Repositories;

use Uph\Miklaj\Model\User;

use \PDO;

class UserRepository extends BaseRepository
{

    static protected $model = User::class;

    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
    }

    public function insert($data){
        if(isset($data['password'])) {
            $data['password'] = md5($data['login']);
        }
        parent::insert($data);
    }

    public function getUserByLoginAndPassword($login, $password)
    {

        $query = $this->pdo->query(<<<EOT
            SELECT
                *
            FROM
                `{$this->getTable()}`
            WHERE
                `login` = :login AND
                `password` = :password
            LIMIT 1
EOT
        );
        $query->execute([
            'login' => $login,
            'password' => md5($password)
        ]);

        $results = $query->fetchAll(PDO::FETCH_CLASS, User::class);
        return count($results) > 0 ? $results[0] : null;
    }
}
