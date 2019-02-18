<?php 

	include '../../library/config.php';
	include '../../classes/comments.php';


	$comments = new Comments($connection);


	$comment = $comments->getCommentByPlaceId($_GET['placeid']);

	$data = [];
	$x = 0;
	foreach ($comment as $value) {

		$rate = $comments->getrate($value->id, $_GET['placeid']);

		if(count($rate)) {

			foreach ($rate as $ratevalue) {
				
				$data[$x++] = [
					'place_id' => $_GET['placeid'],
					'comment' => $value->comment,
					'username' => $value->name,
					'rate' => (int)$ratevalue->rate,
					'date' => $value->date = date("F j, Y, g:i a")

				];

			}

		} else {

			$data[$x++] = [
					'place_id' => $_GET['placeid'],
					'comment' => $value->comment,
					'username' => $value->name,
					'rate' => 0,
					'date' => $value->date = date("F j, Y, g:i a")

				];

		}
	
		

	}


	echo json_encode($data);




?>