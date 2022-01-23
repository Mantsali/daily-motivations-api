<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
//header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'common.php';

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->id)) {
    $quote->deleteQuote($data->id);
    // set response code - 200 ok
    http_response_code(200);

    // response to client
    echo json_encode(array("message" => "Quote was removed."));
} else {
    http_response_code(400);

    // response to client
    echo json_encode(array("message" => "Unable to create quote. No ID specified."));
}
