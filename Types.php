<?php
class Types
{
    const TABLE_NAME = 'types';
    public $connection;
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
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