<?php
	include '../../../library/config.php';



	$data = [
			'name' => $_POST['name'],
			'description' => $_POST['desc']
		];

		$q1 = "INSERT INTO transportation(name, description) VALUES (:name, :description)";
		
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