<?php
class Comments {

    protected $connection;

    public function __construct($connection) {

        $this->connection = $connection;
    }

    public function getCommentByPlaceId($id) {

        $query = "SELECT * FROM comments c INNER JOIN users u ON c.user_id = u.id WHERE c.place_id = ? ORDER BY date desc";

        $query = $this->connection->prepare($query);

        $query->execute([$id]);

        return $data =  $query->fetchAll(PDO::FETCH_OBJ);
        
    }

    public function getrate($userid, $placeid) {

        $query = "SELECT * FROM place_rate WHERE user_id = ? AND place_id = ? LIMIT 1";

        $query = $this->connection->prepare($query);

        $query->execute([$userid, $placeid]);

        return $data =  $query->fetchAll(PDO::FETCH_OBJ);
    }




}