<?php 
	include '../../library/config.php';
	include '../../classes/terminals.php';

	$terminals = new Terminals($connection);

	$output = array();

	if(!empty($_GET['place_id'])) {


		$list = $terminals->getTerminalsByPlaceId($_GET['place_id']);


		if($list) {

			array_push($output, array(

				'terminals' => $list,

			));

		} else {

			array_push($output, array(

				'response' => null 

			));
		}

	} else {

			array_push($output, array(

				'response' => "Please try again." 

			));
		
	}


	echo json_encode($output);

?>