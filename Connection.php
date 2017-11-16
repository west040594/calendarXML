<?php

class Connection
{
    public $servername = 'localhost';
    public $username = 'root';
    public $password = '';
    public $dbname = 'calendar';
    public $pdo;

    public function __construct($servername, $username, $password, $dbname)
    {

        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;

        try {
            $this->pdo = new PDO(
                "mysql:host={$this->servername};dbname={$this->dbname}",
                "{$this->username}",
                "{$this->password}"
            );
        } catch (PDOException $e) {
            throw new Exception('Ошибка соединения');
        }
    }
}