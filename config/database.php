<?php

use MongoDB\Operation\ListCollections;

class Database
{
    private $quotesCol;


    function __construct()
    {
        include_once 'keys.php';
        $this->quotesCol = NULL;
        try {
            $client = new MongoDB\Client(
                'mongodb+srv://' . $username . ':' . $password . '@' . $cluster . '/' . $collection . '?retryWrites=true&w=majority'
            );


            $anydaydb = $client->anyday;

            $this->quotesCol = $anydaydb->quotes;
        } catch (Throwable $e) {
            // catch throwables when the connection is not a success
            // echo "Connection error: " . $e->getMessage() . PHP_EOL;\
            echo  "Connection error: Failed to connect to database server";
        }
    }

    public function getCollection()
    {
        // if($this->quotesCol == NULL) return false;
        return $this->quotesCol;
    }
}//
