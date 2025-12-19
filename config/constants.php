<?php
session_start();

define('SITEURL', 'http://localhost:8081/');
define('LOCALHOST', 'mysql-food-db');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'foodorder');

$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);
if (!$conn) die(mysqli_error($conn));

$db_select = mysqli_select_db($conn, DB_NAME);
if (!$db_select) die(mysqli_error($conn));
