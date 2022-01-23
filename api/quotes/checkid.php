<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
//header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, Access-Control-Allow-Headers, Authorization, X-Requested-With");


require_once '../../vendor/autoload.php';
include_once '../../config/database.php';
include '../../includes/myAutoloder.php';

$database = new Database();

$quote = new Quotes($database->getCollection());


// get posted data
$data = json_decode(file_get_contents("php://input"));

$quote->checkId($data->id);
