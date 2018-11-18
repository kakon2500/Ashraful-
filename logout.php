<?php
session_start();
if (isset($_SESSION['client_login']) || isset($_SESSION['owner_login'])) {
	session_destroy();
	session_unset(); 
	header('Location: index.php');
}else{
	header('Location: index.php');
}

?>