<?php

class Holidays
{
    const TABLE_NAME = 'holidays';
    public $connection;
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function holidayIsset($title)
    {
        try {
            $table_name = self::TABLE_NAME;
            $query = "SELECT count(*) FROM {$table_name} WHERE title = :title";
            $days = $this->connection->pdo->prepare($query);
            $days->execute(['title'=>$title]);
            $count = $days->fetch(PDO::FETCH_ASSOC)['count(*)'];
            return $count > 0 ? true : false;
        } catch (PDOException $e) {
            throw new Exception('Ошибка выполнения запроса' . $e->getMessage());
        }
    }

    public function insert($title)
    {
        try {
            $table_name = self::TABLE_NAME;
            $query = "INSERT INTO {$table_name} (title) VALUES (:title)";
            $days= $this->connection->pdo->prepare($query);
            $days->execute(['title'=>$title]);
        } catch (PDOException $e) {
            throw new Exception('Ошибка вставки значений');
        }
    }

    public function getTitle($id)
    {
        try {
            $table_name = self::TABLE_NAME;
            $query = "SELECT title FROM {$table_name} WHERE id = :id";
            $days= $this->connection->pdo->prepare($query);
            $days->execute(['id'=>$id]);
            return $record = $days->fetch(PDO::FETCH_ASSOC)['title'];
        } catch (PDOException $e) {
            throw new Exception('Ошибка выполнения запроса' . $e->getMessage());
        }
    }
}