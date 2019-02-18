<?php
	include '../../../library/config.php';

	$statement = $connection->prepare("INSERT INTO place_tags( tag_name, place_id) VALUES ( :tagname, :placeid)");
		$result = $statement->execute(
			array(
				':tagname' => $_POST['tagname'],
				':placeid' => $_POST['placeid']
			)
		);


	$output = array();

	if($statement){

		$output['msg'] = 'tag successfully added!';

	} else {

		$output['msg'] = 'Error adding tag to place!';

	}

 
	echo json_encode($output);


?>