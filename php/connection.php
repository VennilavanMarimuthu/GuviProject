<?php
require 'vendor/autoload.php';

$mysqli = new mysqli("localhost", "root", "", "webproject");

if ($mysqli->connect_error) {
    die("MySQL Connection failed: " . $mysqli->connect_error);
}

$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
$mongoDB = $mongoClient->webproject;

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

if (!$redis->ping()) {
    die("Redis Connection failed");
}
?>
