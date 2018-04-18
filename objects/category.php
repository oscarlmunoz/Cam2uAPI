<?php
    class Category{
    
        // database connection and table name
        private $conn;
        
        // object properties
        public $id_tipo;
        public $tipo;
        public $genero;

        // constructor with $db as database connection
        public function __construct($db){
            $this->conn = $db;
        }

        /**
         * This returns all garments from DB
         *
         * @return void
         */
        function read(){
     
            // select all query
            $query = "SELECT *  FROM PRENDA_BASE" ;
                    
            // prepare query statement
            $statement = $this->conn->prepare($query);
        
            // execute query
            $statement->execute();
        
            return $statement;
        }
    }
?>