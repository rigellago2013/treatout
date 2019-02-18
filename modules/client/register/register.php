<?php 
	include '../../../library/config.php';
	include '../../../classes/user.php';

	$users = new User($connection);

	$output = array();

	if($_POST['password'] == $_POST['confirmpassword']) {

		$name = $_POST['fname']." ".$_POST['lname'];

		$register = $users->register($name, $_POST['email'], md5($_POST['password']));

		if( $register) {

			$login = $users->login($_POST['email'], md5($_POST['password']));

			if($login){

				 $output = array('response' => true);

			}
				$output = array('response' => "We've sent a link to your email please verify your account to continue.");

		} else {

			$output = array('response' => "Email already exist. Please try a new one.");
		}

	} else {

		 $output = array('response' => "Please match password");
	}

	echo json_encode($output);

?>	