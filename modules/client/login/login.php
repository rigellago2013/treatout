<?php 
	include '../../../library/config.php';
	include '../../../classes/user.php';

	$users = new User($connection);

	$data = $users->login($_POST['email'],md5($_POST['password']));

	$output = array();

	if($data){

		$output['login'] = true;

	} else {

		array_push($output, array('login'=>false));
	}

 
	echo json_encode($output);
?>