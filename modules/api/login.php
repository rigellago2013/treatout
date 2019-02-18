<?php

	include '../../library/config.php';

	include '../../classes/user.php';

	$users = new User($connection);

	$data = $users->login($_GET['email'],md5($_GET['password']));

	$output = array();

	if($data){

		array_push($output, array(

			'login' => $_SESSION['login'],

			'name' => $_SESSION['name'],

			'email' => $_SESSION['email'],

			'userid' => $_SESSION['id']
		));


	} else {

		array_push($output, array('login'=>false));
	}

	echo json_encode($output);


?>
