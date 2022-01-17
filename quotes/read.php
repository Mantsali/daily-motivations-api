<?php
require_once '../vendor/autoload.php';
include_once '../config/database.php';
include '../includes/myAutoloder.php';

$database = new Database();

$quotes = new Quotes($database->getCollection());

echo $quotes->getAllQuotes();
