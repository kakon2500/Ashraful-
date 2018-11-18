<?php

//error handling for database connection
// set_error_handler("databaseError",E_ALL);
// function databaseError($errno, $errstr)
// {
// 	echo "No Database Connection.";
// 	die();
// }

//database connection variable
$host = "localhost";
$user = "root";
$pass = "";
$db = "db_coldStorage";

//database connection
$dbconnect = mysqli_connect($host, $user, $pass, $db) or die ("Error while connecting to database.");

?>