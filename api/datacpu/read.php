<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database file
include_once '../../config/Mongo.php';

$dbname = 'dataCPU';
$collection = 'data';



$db = new DbManager();
$conn = $db->getConnection();


$filter = [];
$option = [];
$read = new MongoDB\Driver\Query($filter, $option);

$records = $conn->executeQuery("$dbname.$collection", $read);

echo json_encode(iterator_to_array($records));

?>