<?php

class dbh {
    private $db_server;
    private $db_user;
    private $db_password;
    private $db_name;
    private $conn;

    public function __construct() {
        $this->db_server = "localhost";
        $this->db_user = "root";
        $this->db_password = "";
        $this->db_name = "ksiegarnia";
        $this->connect();
    }

    private function connect() {
        $this->conn = new mysqli($this->db_server, $this->db_user, $this->db_password, $this->db_name);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}

?>