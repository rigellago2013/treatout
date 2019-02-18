1<?php 
	include '../../library/config.php';
	include '../../classes/places.php';

	$place = new Places($connection);

	$output = array();

		$place = $place->show($_GET['placeid']);

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