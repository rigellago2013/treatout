<?php 
	include '../../library/config.php';

	$statement = $connection->prepare("INSERT INTO comments(place_id, comment, user_id, date) VALUES ( :placeid, :comment, :user_id, NOW())");
		$result = $statement->execute(
			array(
				':placeid' => 	$_GET['place_id'],
				':comment'	=>	$_GET['comment'],
				':user_id'	=>	$_GET['user_id']
			)
	);

	$output = array();

	if($statement){

		$output['msg'] = 'Data successfully inserted!';

	} else {

		$output['msg'] = 'Error inserting data!';

	}
 
	echo json_encode($output);






?>