<?php
	include '../../../library/config.php';


if(isset($_POST['placeid'])){

 $output = array();

 $id = $_POST['placeid'];

 $statement = $connection->prepare("SELECT * FROM places WHERE place_id = ?");

 $statement->execute([$id]);

 $result = $statement->fetchAll(PDO::FETCH_OBJ);

 foreach($result as $row)
 {
	  $output["maxrate"] = $row->rate_max;
	  $output["minrate"] = $row->rate_min;
 }

 echo json_encode($output);
}

?>
