<?php 
	include '../library/config.php';
	include '../classes/user.php';

	$users = new User($connection);

	$data = $users->adminlogin($_POST['email'],md5($_POST['password']));

	$output = array();

	if($data){

		$output['login'] = true;
		$output['is_admin'] = 1;

	} else {

		
		$output['login'] = false;
		$output['is_admin'] = 0;
	}

 
	echo json_encode($output);
?>