<?php
class Transportation {

    protected $connection;

    public function __construct($connection) {

        $this->connection = $connection;
    }

    public function getAll() {

        $query = "SELECT * FROM transportation";

        $query = $this->connection->prepare($query);

        $query->execute();

        return $data =  $query->fetchAll(PDO::FETCH_OBJ);
        
    }
}