<?php
class Database
{
    function __construct(){
        
    
        $client = new MongoDB\Client(
            'mongodb+srv://mantsali:NgZ1QVqLq681LZRi@anyday.enonb.mongodb.net/anyday?retryWrites=true&w=majority'
        );
        $db = $client->test;   

        print_r($db);
    }
}

?>