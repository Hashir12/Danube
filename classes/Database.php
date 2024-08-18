<?php

class Database
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "pre_interview";

    // Get the database connection
    public function getConnection()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host={$this->servername};dbname={$this->dbname}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        return $this->conn;
    }
}
