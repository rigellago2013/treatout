<?php
	include '../../../library/config.php';



	$data = [
			'place_id' => $_POST['place_id'],
			'trans_id' => $_POST['trans_id'],
			'fare_rate_min' => $_POST['fare_rate_min'],
			'fare_rate_max' => $_POST['fare_rate_max'],
			'description' => $_POST['description'],
			'latitude'	=> $_POST['latitude'],
			'longitude' => $_POST['longitude']
		];

		$q1 = "INSERT INTO terminals(place_id, trans_id, fare_rate_min, fare_rate_max, description, latitude, longitude) VALUES (:place_id, :trans_id, :fare_rate_min, :fare_rate_max, :description, :latitude, :longitude)";
		
		$stmt= $connection->prepare($q1);
		$res = $stmt->execute($data);

		$output = array();


		if($res) {
			$output['msg'] = "Data inserted!";

			echo json_encode($output);
		} else {
			
			$output['msg'] = "Error!";
			
			echo json_encode($output);
		} 
?>