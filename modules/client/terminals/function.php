<?php 
	include '../library/config.php';

	$query = "SELECT * FROM transportation";
	$query = $connection->prepare($query);
	$query->execute([$_GET['place_id']]);
	$data =  $query->fetchAll(PDO::FETCH_OBJ);
	
?>