<?php
	include '../../../library/config.php';

$output = array();
$target_dir = "../../../images/places/";
$target_file = $target_dir . rand(1000,1000000). '_' . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


if(isset($_POST["submit"])) {
	$check = getimagesize($_FILES["image"]["tmp_name"]);
	if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
	} else {
			echo "File is not an image.";
			$uploadOk = 0;
	}
}

if (file_exists($target_file)) {
	echo "Sorry, file already exists.";
	$uploadOk = 0;
}

if ($_FILES["image"]["size"] > 500000) {
	echo "Sorry, your file is too large.";
	$uploadOk = 0;
}

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {

	echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	$uploadOk = 0;
}

if ($uploadOk == 0) {

	echo "Sorry, your file was not uploaded.";

} else {

	move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

}

	$id = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 5);

	$q1 = $connection->prepare("INSERT INTO places(place_id, latitude, longitude, name, address, rate_max, rate, image, type, user_id, contact, approved) VALUES (:place_id, :lat, :lng, :name, :address, :rate_max, :rate, :image, :type, :user_id, :contact, 1)");

	$q1->bindValue(':place_id', $id , PDO::PARAM_STR);
	$q1->bindValue(':lat', $_POST['latitude'], PDO::PARAM_STR);
	$q1->bindValue(':lng', $_POST['longitude'], PDO::PARAM_STR);
	$q1->bindValue(':name', $_POST['name'], PDO::PARAM_STR);
	$q1->bindValue(':address', $_POST['address'], PDO::PARAM_STR);
	$q1->bindValue(':rate_max', $_POST['pricerate'], PDO::PARAM_INT);
	$q1->bindValue(':rate', $_POST['rate'], PDO::PARAM_INT);
	$q1->bindValue(':image', $target_file, PDO::PARAM_STR);
	$q1->bindValue(':type', $_POST['type'], PDO::PARAM_STR);
	$q1->bindValue(':user_id', $_POST['user_id'], PDO::PARAM_INT);
	$q1->bindValue(':contact', $_POST['contact'], PDO::PARAM_STR);
	
	$res = $q1->execute();

	if($res) {

		$output['msg'] = "Data inserted!";

	} else {
			
		$output['msg'] = "Error!";

	} 

	echo json_encode($output);
?>