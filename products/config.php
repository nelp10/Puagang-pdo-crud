<?php

$host = 'localhost';
$dbname = 'u593341949_db_puagang';
$username = 'root';
$password = '';

/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'u593341949_db_puagang');

// define('DB_SERVER', 'localhost');
// define('DB_NAME', 'u593341949_db_puagang');
// define('DB_USERNAME', 'u593341949_dev_puagang');
// define('DB_PASSWORD', '20191124Puagang');

try {
 $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
 die("Database connection failed: " . $e->getMessage());
}