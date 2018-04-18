<?php
    class Content{

        // database connection and table name
        private $conn;

        // object properties
        public $id_pedido;
        public $id_articulo;
        public $cantidad;

        // constructor with $db as database connection
        public function __construct($db){
            $this->conn = $db;
        } 
        /**
         * Create content in DB
         *
         * @return void
         */
        function create() {
            // Query to inster new record
            $query = "INSERT INTO CONTIENE
            (`id_pedido`, `id_articulo`, `cantidad`) 
            VALUES ('{$this->id_pedido}', '{$this->id_articulo}', '{$this->cantidad}')";

            // prepare query
            $stmt = $this->conn->prepare($query);
        
            // execute query
            if($this->id_pedido && $this->id_articulo && $this->cantidad && $stmt->execute()){
                return true;
            }
            return false;
        }
        /**
         * This get the information from and specific id_pedido
         *
         * @param [string] $id_pedido
         * @return void
         */
        function search($id_pedido){
            $query = "SELECT * FROM CONTIENE c
            WHERE
            c.id_pedido LIKE '{$id_pedido}'" ;
        
            // prepare query statement
            $stmt = $this->conn->prepare($query);
            if($stmt->execute()){
                return $stmt;
                echo ($stmt);
            } else {
                return "";
            }
        }
    }