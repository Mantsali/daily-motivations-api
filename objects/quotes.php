<?php

class Quotes
{
    private $id;
    private $source;
    private $quote;
    private $likes;
    private $createdAt;

    private $quotesCollection;

    public function __construct($collection)
    {
        $this->source = 'unknown';
        $this->quotesCollection = $collection;
    }


    public function getAllQuotes()
    {
        $quotesArr = array();
        $quotesArr["records"] = array();
        $quotesCursor = $this->quotesCollection->find();

        foreach ($quotesCursor as $document) {
            $quote_doc = array(
                "id" => $document["index"],
                "source" => $document["source"],
                "quote" => $document["quote"],
                "likes" => $document["likes"],
                "createdAt" => $document["createdAt"]
            );


            array_push($quotesArr["records"], $quote_doc);
        }


        // set response code - 200 OK
        http_response_code(200);

        // show products data in json format
        //echo json_encode($products_arr);
        return json_encode($quotesArr);
    }


    public function getQuote($id)
    {
    }
    public function editQuote($id)
    {
    }
    public function addQuote()
    {
    }
    public function deleteQuote($id)
    {
    }
}
