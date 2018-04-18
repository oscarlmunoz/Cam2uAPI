<?php
class Database{
 
    // specify your own database credentials TODO local

    private $host = "localhost";
    private $db_name = "cam2uDB";
    private $username = "root";
    private $password = "root";

    // specify your own database credentials TODO server

    // private $host = "mysql377int.srv-hostalia.com";
    // private $db_name = "db5771333_cam2uDB";
    // private $username = "u5771333_omunoz";
    // private $password = "EXT4Lyey";


    public $conn;
 
    // get the database connection
    public function getConnection(){
 
        $this->conn = null;
        // handling errors
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . 
                    $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>