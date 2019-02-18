<?php
class Terminals {

    protected $connection;

    public function __construct($connection) {

        $this->connection = $connection;
    }

    public function getTerminalsByPlaceId($id) {

        $query = "SELECT t.place_id, t.fare_rate_max, t.fare_rate_max, t.longitude, t.latitude, tt.trans_name as transportation, tt.description, p.name as place FROM terminals t INNER JOIN transportation tt ON t.trans_id = tt.trans_id INNER JOIN places p ON t.place_id = p.place_id WHERE t.place_id = ?";

        $query = $this->connection->prepare($query);

        $query->execute([$id]);

        return $data =  $query->fetchAll(PDO::FETCH_OBJ);
        
    }



     public function getTerminals($place_id) {

        $query = "SELECT t.latitude, t.longitude,  t.fare_rate_max,t.fare_rate_min, t.description, tt.trans_name FROM terminals t INNER JOIN transportation tt ON t.trans_id = tt.trans_id INNER JOIN places p ON t.place_id = p.place_id WHERE t.place_id = ?";

        $query = $this->connection->prepare($query);

        $query->execute([$place_id]);

        return $data =  $query->fetchAll(PDO::FETCH_OBJ);
        
    }




    
}