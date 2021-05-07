<?php

class Database {
   
    public $conn;
   
    public function __construct() {
        $this->getConnection();
    }

    public function getConnection(){
   
        $this->conn = null;
   
        $this->conn = new mysqli('localhost','coeus','Gh_12345678','attendance_system');

        if ($this->conn->connect_error){

            die("Failed to connect to MySQL: " . $this->conn->connect_error);

        }
    }

    public function closeDBConn() {

        $this->conn->close();

    }
}
?>