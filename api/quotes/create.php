<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
//header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include_once 'common.php';


// get posted data
$data = json_decode(file_get_contents("php://input"));
//var_dump($data);

if (!empty($data->quote)) {
    $quote->setQuote($data->quote);

    if (!empty($data->source)) {
        $quote->setSource($data->source);
    }


    if ($quote->addQuote()) {
        // set response code - 201 created
        http_response_code(201);

        // response to client
        echo json_encode(array("message" => "Product was created."));
    } else {

        // set response code - 503 service unavailable
        http_response_code(503);

        // response to client
        echo json_encode(array("message" => "Unable to create quote."));
    }
} else {
    http_response_code(400);

    // response to client
    echo json_encode(array("message" => "Unable to create quote. Data is incomplete."));
}
