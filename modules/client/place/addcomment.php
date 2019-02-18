<?php
	include '../../../library/config.php';

	$statement = $connection->prepare("INSERT INTO comments(place_id, comment, user_id, date) VALUES ( :placeid, :comment, :user_id, NOW())");
		$result = $statement->execute(
			array(
				':placeid' => 	$_POST['placeid'],
				':comment'	=>	$_POST['comment'],
				':user_id'	=>	$_POST['userid']
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