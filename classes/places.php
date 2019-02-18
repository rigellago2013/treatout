<?php
class Places {

    protected $connection;

    public function __construct($connection) {

        $this->connection = $connection;
    }

    public function getAll() {

        $query = "SELECT * FROM places";

        $query = $this->connection->prepare($query);

        $query->execute();

        return $data =  $query->fetchAll(PDO::FETCH_OBJ);
        
    }


    public function search($searchvalue, $maxrate) {


        if($searchvalue) {

            $query = "SELECT * FROM place_tags pt INNER JOIN places p ON pt.place_id = p.place_id  WHERE pt.tag_name = ? ;";

            $query = $this->connection->prepare($query);

            $query->execute([$searchvalue]);

            return $data =  $query->fetchAll(PDO::FETCH_OBJ);

        } else {

            $query = "SELECT * FROM places WHERE rate_max <= ? AND rate_max < ? ;";

            $query = $this->connection->prepare($query);

            $query->execute([$maxrate, $maxrate]);

            return $data =  $query->fetchAll(PDO::FETCH_OBJ);

        } 
       
        
    }


    public function getTags($id) {

        $query = "SELECT DISTINCT(tag_name) FROM place_tags WHERE place_id = ?";

        $query = $this->connection->prepare($query);

        $query->execute([$id]);

        return $data =  $query->fetchAll(PDO::FETCH_OBJ);

    }



    public function checkPlace($id) {

        $query = "SELECT * FROM places WHERE place_id = ?";

        $query = $this->connection->prepare($query);

        $query->execute([$id]);

        // $data =  $query->fetchAll(PDO::FETCH_OBJ);

        return $count = $query->rowCount();
    }


    public function show($id) {

        $query = "SELECT * FROM places WHERE place_id = ?";

        $query = $this->connection->prepare($query);

        $query->execute([$id]);

        return $data =  $query->fetchAll(PDO::FETCH_OBJ);

    }

    public function validatePlace($placename) {

        $query = "SELECT * FROM places WHERE name LIKE ?";

        $query = $this->connection->prepare($query);

        $query->execute([$placename]);

        return $data =  $query->fetchAll(PDO::FETCH_OBJ);

    }

    public function getPendingPlaces()
    {
        $query = "SELECT * FROM places WHERE approved = 0";

        $query = $this->connection->prepare($query);

        $query->execute();

        return $data =  $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getByType($type)
    {
        $query = "SELECT * FROM places WHERE type LIKE ? AND approved = 1";

        $query = $this->connection->prepare($query);

        $query->execute([$type]);

        return $data =  $query->fetchAll(PDO::FETCH_OBJ);
    }







}