<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'mobile_store');
define('DB_PASS', 'root');
define('DB_NAME', 'doc_channel_sys');

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
  die('Connection failed: ' . $conn->connect_error);
}

// echo 'Connected successfully';
