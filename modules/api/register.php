<?php 
	include '../../library/config.php';
	include '../../classes/user.php';

	$users = new User($connection);

	$output = array();

	if($_GET['password'] == $_GET['confirm_password']) {


		$register = $users->register($_GET['name'], $_GET['email'], md5($_GET['password']));

		if($register) {

			array_push($output, array(

				'response' => 'User success	!',
				'login' => true

			));

		} else {

			array_push($output, array(

				'response' => "Whoops! Looks like there's something wrong.." 

			));
		}

	} else {

			array_push($output, array(

				'response' => "Please match both passwords." 

			));
		
	}


	echo json_encode($output);

?>