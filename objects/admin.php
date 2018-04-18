<?php
class Admin
{
    // database connection and table name
    private $conn;

    // object properties
    public $nombre;
    public $pass;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    /**
     * Check if Admin exist
     *
     * @param [string] $nombre
     * @return void
     */
    public function search($nombre)
    {
        $query = "SELECT * FROM ADMINISTRADOR a
            WHERE
            a.nombre LIKE '{$nombre}'";

        // prepare query statement
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute()) {
            return $stmt;
        } else {
            return "";
        }
    }

    /**
     * Update administrator
     *
     * @return void
     */
    public function update()
    {
        $query = "UPDATE ADMINISTRADOR a
                    SET
                        a.nombre = '{$this->nombre}',
                        a.pass = '{$this->pass}'
                    WHERE
                        a.nombre LIKE '{$this->nombre}'";

        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute the query
        return ($stmt->execute());
    }
}
