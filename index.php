<?php
require_once __DIR__ . '/vendor/autoload.php';
include_once  __DIR__ . '/config/database.php';
include __DIR__ . '/includes/myAutoloder.php';

$database = new Database();

$quotes = new Quotes($database->getCollection());

echo $quotes->getAllQuotes();
