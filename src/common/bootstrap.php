<?php
require __DIR__ . '/../vendor/autoload.php';


use common\DatabaseService\DatabaseService;
use common\HelperService\HelperService;

HelperService::loadENV();
$dbService = new DatabaseService();
$dbService->connect($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_NAME']);