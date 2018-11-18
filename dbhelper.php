<?php

function client_id($data, $dbconn) {
    $query 		= "SELECT `client_id` FROM `storage_reg_client` WHERE `client_email` = '$data'";
    $result 	= mysqli_query($dbconn, $query);
	$row 		= mysqli_fetch_assoc($result);
	$client_id	= $row['client_id'];
    return $client_id;
}

function client_name($data, $dbconn) {
    $query          = "SELECT `client_name` FROM `storage_reg_client` WHERE `client_id` = '$data'";
    $result         = mysqli_query($dbconn, $query);
    $row            = mysqli_fetch_assoc($result);
    $client_name    = $row['client_name'];
    return $client_name;
}

function own_id($data, $dbconn) {
    $query 		= "SELECT `own_id` FROM `storage_reg_owner` WHERE `storage_name` = '$data'";
    $result 	= mysqli_query($dbconn, $query);
	$row 		= mysqli_fetch_assoc($result);
	$own_id     = $row['own_id'];
    return $own_id;
}

function own_id_email($data, $dbconn) {
    $query      = "SELECT `own_id` FROM `storage_reg_owner` WHERE `owner_email` = '$data'";
    $result     = mysqli_query($dbconn, $query);
    $row        = mysqli_fetch_assoc($result);
    $own_id     = $row['own_id'];
    return $own_id;
}

function storage_id($data, $dbconn) {
    $query 		= "SELECT `storage_id` FROM `storage_info` WHERE `storage_name` = '$data'";
    $result 	= mysqli_query($dbconn, $query);
	$row 		= mysqli_fetch_assoc($result);
	$storage_id	= $row['storage_id'];
    return $storage_id;
}

function payment($data, $dbconn) {
    $query 		= "SELECT `payment` FROM `storage_info` WHERE `storage_name` = '$data'";
    $result 	= mysqli_query($dbconn, $query);
	$row 		= mysqli_fetch_assoc($result);
	$payment	= $row['payment'];
    return $payment;
}

function check_storage_name($data, $dbconn) {
    $query 		= "SELECT `storage_location` FROM `storage_info` WHERE `storage_name` = '$data'";
    $result 	= mysqli_query($dbconn, $query);
	$row 		= mysqli_fetch_assoc($result);
	$location	= $row['storage_location'];
    return $location;
}

function storage_name($data, $dbconn) {
    $query      = "SELECT `storage_name` FROM `storage_info` WHERE `storage_id` = '$data'";
    $result     = mysqli_query($dbconn, $query);
    $row        = mysqli_fetch_assoc($result);
    $str_name   = $row['storage_name'];
    return $str_name;
}

function storage_capacity($data, $dbconn) {
    $query      = "SELECT `storage_capacity` FROM `storage_info` WHERE `storage_location` = '$data'";
    $result     = mysqli_query($dbconn, $query);
    $row        = mysqli_fetch_assoc($result);
    $str_cap    = $row['storage_capacity'];
    return $str_cap;
}

function space_booked($data, $dbconn) {
    $query      = "SELECT `space_booked` FROM `storage_info` WHERE `storage_name` = '$data'";
    $result     = mysqli_query($dbconn, $query);
    $row        = mysqli_fetch_assoc($result);
    $str_bok    = $row['space_booked'];
    return $str_bok;
}

?>