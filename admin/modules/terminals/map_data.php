<?php
include '../../../library/config.php';
include '../../../classes/terminals.php';

$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

$terminals = new Terminals($connection);

$list = $terminals->getTerminals($_GET['placeid']);

header("Content-type: text/xml");

foreach($list as $value){
	$node = $dom->createElement("marker");
	$newnode = $parnode->appendChild($node);
	$newnode->setAttribute("transportation", $value->trans_name);
	$newnode->setAttribute("minfare", $value->fare_rate_min);
	$newnode->setAttribute("maxfare", $value->fare_rate_max);
	$newnode->setAttribute("description", $value->description);
	$newnode->setAttribute("lat", $value->latitude);
	$newnode->setAttribute("lng", $value->longitude);
}

echo $dom->saveXML();