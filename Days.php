<?php
class Days
{
     const TABLE_NAME = 'days';
     public $connection;
     public function __construct(Connection $connection)
     {
         $this->connection = $connection;
     }

     public function insert($day, $type_id, $holiday_id, $year)
     {
         try {
             $table_name = self::TABLE_NAME;
             $query = "INSERT INTO {$table_name} (day, type_id, holiday_id, year) VALUES (:day, :type_id, :holiday_id, :year)";
             $days= $this->connection->pdo->prepare($query);
             $days->execute(['day'=>$day, 'type_id'=>$type_id, 'holiday_id'=>$holiday_id, 'year'=>$year]);
         } catch (PDOException $e) {
             throw new Exception('Ошибка вставки значений');
         }
     }

     public function yearIsset($year)
     {
         try {
             $table_name = self::TABLE_NAME;
             $query = "SELECT count(*) FROM {$table_name} WHERE year = :year";
             $days = $this->connection->pdo->prepare($query);
             $days->execute(['year'=>$year]);
             $count = $days->fetch(PDO::FETCH_ASSOC)['count(*)'];
             return $count > 0 ? true : false;
         } catch (PDOException $e) {
             throw new Exception('Ошибка выполнения запроса' . $e->getMessage());
         }
     }

     public function select($year)
     {
         try {
             $table_name = self::TABLE_NAME;
             $query = "SELECT * FROM {$table_name} WHERE year = :year";
             $days = $this->connection->pdo->prepare($query);
             $days->execute(['year'=>$year]);
             return $records = $days->fetchAll(PDO::FETCH_ASSOC);
         } catch (PDOException $e) {
             throw new Exception('Ошибка выполнения запроса' . $e->getMessage());
         }
     }
}