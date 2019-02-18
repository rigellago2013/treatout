<?php
	include '../../../library/config.php';

      
    $statement = $connection->prepare("DELETE FROM places WHERE place_id = ?");
    $res = $statement->execute([$_POST['place_id']]);

    $output = array(); 

	if($res){
		$output['msg'] = "Successfully canceled!";
	} else {
		$output['msg'] = "Error canceling place!";
	}

	echo json_encode($output);




?>