<?php 
	include '../../library/config.php';
	include '../../classes/places.php';

	$place = new Places($connection);

	$output = array();

		$place = $place->search($_GET['searchvalue'], $_GET['minrate'], $_GET['maxrate']);

		if($place) {

			array_push($output, array(

				'data' => $place

			));

		} else {

			array_push($output, array(

				'data' => "No results found." 

			));
		}



	echo json_encode($output);

?>