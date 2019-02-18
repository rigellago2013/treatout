<?php
	include '../../../library/config.php';

	$statement = $connection->prepare("UPDATE places SET rate_max = :maxrate WHERE place_id = :placeid");
		$result = $statement->execute(
			array(
				':maxrate' =>	$_POST['maxrate'],
				':placeid' => $_POST['placeid']
			)
		);


	$output = array();

	if($statement){

		$output['msg'] = 'Successfully updated!';

	} else {

		$output['msg'] = 'Error updating data!';

	}

 
	echo json_encode($output);


?>