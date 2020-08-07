<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database file
include_once '../../config/Mongo.php';

$dbname = 'dataCPU';
$collection = 'data';

//DB connection
$db = new DbManager();
$conn = $db->getConnection();

//record to add

$tipe = php_uname('s');
$platform = php_uname('m');
$rilis = php_uname('r');


// hitung ram

$data = [];
$data['namacpu'] = gethostname(); 
$data['tipe'] = $tipe;
$data['platform'] = $platform;
$data['rilis'] = $rilis;
$data['ramSisa'] = "";
$data['ramTotal'] = "";


// insert record
$insert = new MongoDB\Driver\BulkWrite();
$insert->insert($data);

$result = $conn->executeBulkWrite("$dbname.$collection", $insert);

// verify
if ($result->getInsertedCount() == 1) {
    echo json_encode(
		array("message" => "Record successfully created")
	);
} else {
    echo json_encode(
            array("message" => "Error while saving record")
    );
}

?>