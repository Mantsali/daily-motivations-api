<?php

class Quotes
{
    private $id;
    private $source;
    private $quote;
    private $likes;
    private $createdAt;
    private $updatedAt;

    private $quotesCollection;

    public function __construct($collection)
    {
        $this->source = 'unknown';
        $this->likes = 0;
        $this->quotesCollection = $collection;
    }


    public function getAllQuotes()
    {
        $quotesArr = array();
        $quotesArr["records"] = array();
        $quotesCursor = $this->quotesCollection->find();

        foreach ($quotesCursor as $document) {
            $quote_doc = array(
                "id" => $document["_id"],
                "source" => $document["source"],
                "quote" => $document["quote"],
                "likes" => $document["likes"],
                "createdAt" => $document["createdAt"]
            );
            if (isset($document["updatedAt"])) {
                $quote_doc  = array_merge(
                    $quote_doc,
                    ["updatedAt" => $document["updatedAt"]]
                );
            }

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

        if ($this->checkId($id)) {
            $quotesArr = array();
            $quotesArr["records"] = array();

            $document =  $this->quotesCollection->findOne(array('_id' => new \MongoDB\BSON\ObjectID($id)));
            $quote_doc = array(
                "id" => $document["_id"],
                "source" => $document["source"],
                "quote" => $document["quote"],
                "likes" => $document["likes"],
                "createdAt" => $document["createdAt"]
            );
            if (isset($document["updatedAt"])) {
                $quote_doc  = array_merge(
                    $quote_doc,
                    ["updatedAt" => $document["updatedAt"]]
                );
            }

            array_push($quotesArr["records"], $quote_doc);

            // set response code - 200 OK
            http_response_code(200);

            return json_encode($quotesArr);
        }
        return json_encode(array("message" => "Quote does not exist"));
    }


    public function checkId($id)
    {

        try {
            $cursor =  $this->quotesCollection->findOne(array('_id' => new \MongoDB\BSON\ObjectID($id)));
            if (!empty($cursor)) {
                return true;
            }
            return false;
        } catch (Exception $e) {
            echo "The ID you have entered is not valid";
            return false;
        }
        //        return false;
    }
    public function editQuote($id, $quote)
    {
        $results = $this->quotesCollection->updateOne(
            ['_id' => new \MongoDB\BSON\ObjectID($id)],
            ['$set' => ['quote' => $quote, "updatedAt" => date('Y-m-d H:i:s')]]
        );
        //create and update - updatedAt
    }
    public function editSource($id, $source)
    {
        $results = $this->quotesCollection->updateOne(
            ['_id' => new \MongoDB\BSON\ObjectID($id)],
            ['$set' => ['source' => $source, "updatedAt" => date('Y-m-d H:i:s')]]
        );
        //create and update - updatedAt
        //echo $results->getModifiedCount();

    }
    public function updateLikes($id)
    {

        $results = $this->quotesCollection->updateOne(
            ['_id' => new \MongoDB\BSON\ObjectID($id)],
            ['$set' => array("updatedAt" => date('Y-m-d H:i:s'))],
            ['$inc' => array('likes' => 1)]
        );

        //create and update - updatedAt
        //
        // echo $results->getMatchedCount();

    }



    public function addQuote()
    {
        $newCollection =  $this->quotesCollection->insertOne(
            ["source" => $this->source, "quote" => $this->quote, "likes" => $this->likes, "createdAt" => date('Y-m-d H:i:s')]
        );

        if ($newCollection->getInsertedCount() > 0) {
            return true;
        }

        return false;
    }
    public function deleteQuote($id)
    {
        $results = $this->quotesCollection->deleteOne(
            ['_id' => new \MongoDB\BSON\ObjectID($id)]
        );

        //$results->getDeletedCount();
    }



    ////setters
    public function setSource($source)
    {
        $this->source = $source;
    }
    public function setQuote($quote)
    {
        $this->quote = $quote;
    }
}
