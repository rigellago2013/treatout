<?php
	include '../../../library/config.php';

      
    $statement = $connection->prepare("UPDATE places SET approved = 1 WHERE place_id = ?");
    $res = $statement->execute([$_POST['place_id']]);

    $output = array(); 

	if($res){
		$output['msg'] = "Place successfully approved!";
	} else {
		$output['msg'] = "Error updating place!";
	}

	echo json_encode($output);




?>