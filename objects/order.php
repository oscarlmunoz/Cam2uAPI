<?php
class Order
{

    // database connection and table name
    private $conn;

    // object properties
    public $estado;
    public $nifCliente;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }
    /**
     * Create order in DB
     *
     * @return void
     */
    public function create()
    {
        // Query to inster new record
        $query = "INSERT INTO PEDIDO
            (`estado`, `nifCliente`)
            VALUES ('{$this->estado}', '{$this->nifCliente}')";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // execute query
        if ($this->nifCliente && $stmt->execute()) {
            return $this->search($this->nifCliente); //Whe we create the order we return the id of that order.
        }
        return false;
    }

    /**
     * Get id_pedido from an specific customer
     *
     * @param [string] $dni
     * @return void
     */
    public function search($dni)
    {
        $query = "SELECT p.id_pedido FROM PEDIDO p
            WHERE
            p.nifCliente LIKE '{$dni}'
            ORDER BY p.nifCliente DESC
            LIMIT 1";

        //prepare query statement
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute()) {
            return $stmt;
        } else {
            return "";
        }
    }

    /**
     * Get all the orders
     *
     * @return void
     */
    public function readAll()
    {
        $query = "SELECT * FROM PEDIDO";
        // prepare query statement
        $statement = $this->conn->prepare($query);

        // execute query
        $statement->execute();

        return $statement;
    }

    /**
     * Update an existent order
     *
     * @return void
     */
    public function update()
    {
        $query = "UPDATE PEDIDO p
                    SET
                        p.estado = '{$this->estado}'
                    WHERE
                        p.id_pedido LIKE '{$this->id_pedido}'";

        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute the query
        return ($stmt->execute());

    }

    /**
     * Get orders with status = 0
     *
     * @return void
     */
    public function readOrdersForPrinter()
    {
        $query = "SELECT * FROM PEDIDO WHERE estado = 0";
        // prepare query statement
        $statement = $this->conn->prepare($query);

        // execute query
        $statement->execute();

        return $statement;
    }
    
    /**
     * This get all the orders from an specific customer
     *
     * @param [string] $dni
     * @return void
     */
    public function searchAllOf($dni)
    {
        $query = "SELECT * FROM PEDIDO p
            WHERE
            p.nifCliente LIKE '{$dni}'
            ORDER BY p.nifCliente DESC";

        //prepare query statement
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute()) {
            return $stmt;
        } else {
            return "";
        }

    }

}
