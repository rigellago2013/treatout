<?php
	include '../../../library/config.php';

	if(!empty($_POST['password'])) {

		$statement = $connection->prepare("UPDATE users SET name = :name, password = :password WHERE id = :id");
		$result = $statement->execute(
			array(
				':name'     =>	$_POST['name'],
				':password' =>	md5($_POST['password']),
				':id'       =>   $_POST['id']
			)
		);


	$output = array();

	if($statement){

		$output['msg'] = 'Successfully updated!';

	} else {

		$output['msg'] = 'Error updating data!';

	}

 
	echo json_encode($output);


	} else {

		$statement = $connection->prepare("UPDATE users SET name = :name WHERE id = :id");
		$result = $statement->execute(
			array(
				':name' => $_POST['name'],
				':id' 	=> $_POST['id']
			)
		);


	$output = array();

	if($statement){

		$output['msg'] = 'Successfully updated!';

	} else {

		$output['msg'] = 'Error updating data!';

	}

 
	echo json_encode($output);

	}



?>