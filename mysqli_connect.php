<?php 
// This creates a connection to the onlineshopdb database and to MySQL, 
// It also sets the encoding.
// Set the access details as constants:
DEFINE('DB_USER', 'root');
DEFINE('DB_PASSWORD', 'root');
DEFINE('DB_HOST', 'localhost');
DEFINE('DB_NAME', 'onlineshopdb');
DEFINE('DB_PORT', '8889');
// Make the connection:
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);
// Set the encoding...optional but recommended
$conn->set_charset("utf8");
?>
