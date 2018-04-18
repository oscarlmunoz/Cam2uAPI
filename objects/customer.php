<?php
class Customer
{

    // database connection and table name
    private $conn;

    // object properties
    public $dni;
    public $nombre;
    public $telefono;
    public $direccion;
    public $pass;
    public $activo;

    // cocurrence variable
    public $formOk = false;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }
    /**
     * This create a new customer in DB
     *
     * @return void
     */
    public function create()
    {
        // Hash creation
        $hash = password_hash($this->pass, PASSWORD_BCRYPT);
        // Insert
        $query = "INSERT INTO CLIENTE
                (`dni`, `nombre`, `telefono`, `direccion`, `pass`, `activo`)
                VALUES ('{$this->dni}', '{$this->nombre}', '{$this->telefono}',
                '{$this->direccion}', '{$hash}', '{$this->activo}')";
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute()) {
            $formOk = true;
        } else {
            // as dni is primary key, if it already exist we wont be able to create it again
            $formOk = false;
        }
        return $formOk;
    }

    /**
     * Get data from an specific dni
     *
     * @param [string] $dni
     * @return void
     */
    public function search($dni)
    {
        $query = "SELECT * FROM CLIENTE c
            WHERE
            c.dni LIKE '{$dni}'";

        // prepare query statement
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute()) {
            return $stmt;
            echo ($stmt);
        } else {
            return "";
        }
    }

    /**
     * This update a customer data
     *
     * @return void
     */
    public function update()
    {
        $query = "UPDATE CLIENTE c
                    SET
                        c.nombre = '{$this->nombre}',
                        c.telefono = '{$this->telefono}',
                        c.direccion = '{$this->direccion}',
                        c.pass = '{$this->pass}',
                        c.activo = '{$this->activo}'
                    WHERE
                        c.dni LIKE '{$this->dni}'";

        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute the query
        return ($stmt->execute());

    }
}
