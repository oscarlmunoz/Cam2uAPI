<?php
class Article
{

    // database connection and table name
    private $conn;

    // object properties
    public $id_prenda;
    public $tamano;
    public $color;
    public $precio;
    public $publicado;
    public $imagen;
    public $nombre;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    /**
     * Return all published articles
     *
     * @return void
     */
    public function read()
    {

        // select all query
        $query = "SELECT *  FROM ARTICULO WHERE publicado = true";

        // prepare query statement
        $statement = $this->conn->prepare($query);

        // execute query
        $statement->execute();

        return $statement;
    }
    /**
     * Return all articles, published or not
     *
     * @return void
     */
    public function readALL()
    {

        // select all query
        $query = "SELECT *  FROM ARTICULO";

        // prepare query statement
        $statement = $this->conn->prepare($query);

        // execute query
        $statement->execute();

        return $statement;
    }

    /**
     * Function that add article to DB
     *
     * @return void
     */
    public function create()
    {

        // sanitize
        $this->id_prenda = htmlspecialchars(strip_tags($this->id_prenda));
        $this->tamano = htmlspecialchars(strip_tags($this->tamano));
        $this->color = htmlspecialchars(strip_tags($this->color));
        $this->precio = htmlspecialchars(strip_tags($this->precio));
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));

        // query to insert record
        $query = "INSERT INTO ARTICULO
        (`id_prenda`, `tamano`, `color`, `precio`, `publicado`, `imagen`, `nombre`)
        VALUES ('{$this->id_prenda}', '{$this->tamano}', '{$this->color}',
        '{$this->precio}', true, '{$this->imagen}', '{$this->nombre}')";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // execute query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    /**
     * Update article function
     *
     * @return void
     */
    public function update()
    {
        $query = "UPDATE ARTICULO a
                SET
                    a.precio = '{$this->precio}',
                    a.publicado = '{$this->publicado}',
                    a.nombre = '{$this->nombre}'
                WHERE
                    a.id_articulo LIKE '{$this->id_articulo}'";

        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute the query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Delete specific article from DB
     *
     * @return void
     */
    public function delete()
    {
        $query = "DELETE FROM ARTICULO WHERE id_articulo LIKE '{$this->id_articulo}'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute the query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Search a specific article from DB
     *
     * @param [string] $id
     * @return void
     */
    public function search($id)
    {
        $query = "SELECT * FROM ARTICULO c
        WHERE
        c.id_articulo LIKE '{$id}'";

        // prepare query statement
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute()) {
            return $stmt;
            echo ($stmt);
        } else {
            return "";
        }
    }

}
