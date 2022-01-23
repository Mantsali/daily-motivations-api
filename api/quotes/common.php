<?php
require_once '../../vendor/autoload.php';
include_once '../../config/database.php';
include '../../includes/myAutoloder.php';


$database = new Database();

$quote = new Quotes($database->getCollection());
