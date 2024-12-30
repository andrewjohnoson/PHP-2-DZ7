<?php

namespace App;

class Db
{
    protected $dbh;
    public function __construct()
    {
        $config = (include __DIR__ . '/configTemplate.php')['db'];
        $dsn = 'mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'];

        try {
            $this->dbh = new \PDO($dsn, $config['user'], $config['password']);
        } catch (\PDOException $error) {
            throw new \App\Exceptions\DbException('Ошибка в подключении к БД. Неверные данные для подключения.', 1);
        }
    }

    public function query($query, $class, $data) : array
    {
        try {
            $sth = $this->dbh->prepare($query);
            $sth->execute($data);
        } catch (\PDOException $error) {
            throw new \App\Exceptions\DbException('Запрос не может быть выполнен.', 2);
        }

        return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
    }

    public function queryEach($query, $class, $data)
    {
        try {
            $sth = $this->dbh->prepare($query);
            $sth->execute($data);
            $sth->setFetchMode(\PDO::FETCH_CLASS, $class);

            $i = $sth->rowCount();
            while ($i > 0) {
                yield $sth->fetch();
                $i--;
            }
        } catch(\PDOException $error) {
            throw new \App\Exceptions\DbException('Запрос не может быть выполнен.', 2);
        }
    }

    public function execute($query, array $data) : bool
    {
        try {
            $sth = $this->dbh->prepare($query);
            return $sth->execute($data);
        } catch (\PDOException $error) {
            throw new \App\Exceptions\DbException('Запрос не может быть выполнен.', 2);
        }
    }

    public function checkID($query, array $data)
    {
        try {
            $sth = $this->dbh->prepare($query);
            $sth->execute($data);
            return $sth->fetchColumn();
        } catch (\PDOException $error) {
            throw new \App\Exceptions\DbException('Запрос не может быть выполнен.', 2);
        }
    }

    public function getLastId() : int
    {
        return $this->dbh->lastInsertId();
    }
}