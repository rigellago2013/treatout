<?php
	include '../../../library/config.php';
	include '../../../classes/places.php';

if(!empty($_POST['placename'])){

	$place = new Places($connection);

	$res = $place->validatePlace($_POST['placename']);

	if($res){

		echo ' &nbsp; Place already exist!.<br/>';

	}

	else {

		echo ' &nbsp; Place is qualified.<br/>';
	}
}
else
	echo '';
?>
