<?php
class Database
{
    function __construct(){
        
    
        $client = new MongoDB\Client(
            
        );
        $db = $client->test;   

        print_r($db);
    }
}
