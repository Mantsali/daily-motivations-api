<?php

//common header files, object and database declarations
include_once 'common.php';

// get submitted quote data for edditing
$data = json_decode(file_get_contents("php://input"));


if (!empty($data->id)) {

    if ($quote->checkId($data->id)) {


        if (!empty($data->source)) {
            $quote->editSource($data->id, $data->source);
        }
        if (!empty($data->quote)) {
            $quote->editQuote($data->id, $data->quote);
        }
        if ($data->likes) { //if likes == true 0r 1

            $quote->updateLikes($data->id);
        }


        // set response code - 200 ok
        http_response_code(200);

        // response to client
        echo json_encode(array("message" => "Quote was updated."));
        //
    } else {
        // set response code - 404 Not found
        http_response_code(404);

        // tell the client quote does not exist
        echo json_encode(array("message" => "Quote does not exist."));
        //
    }
} else {
    http_response_code(400);

    // response to client
    echo json_encode(array("message" => "Unable to create quote. No ID specified."));
}
