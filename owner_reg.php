<?php
session_start();
if (isset($_SESSION['owner_login'])) {
	header('Location: owner_dashboard.php');
	exit();
}
if (isset($_SESSION['client_login'])) {
	header('Location: client_dashboard.php');
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Owner login and Registration</title>
	<link href="img/gcs.ico" rel="shortcut icon">
	<link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<script src="js/jquery-1.11.1.min.js"></script>
	<link rel="stylesheet" href="css/Reglog.css">
	<script src="js/Reglog.js"></script>
</head>
<body>
	<div class="container">
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<a href="#" class="active" id="login-form-link">Login</a>
							</div>
							<div class="col-xs-6">
								<a href="#" id="register-form-link">Register</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form" action="#" method="post" role="form" style="display: block;">
									<div class="form-group">
										<input type="email" name="owner_log_email" id="email" tabindex="1" class="form-control" placeholder="Email">
									</div>
									<div class="form-group">
										<input type="password" name="owner_log_password" id="password" tabindex="2" class="form-control" placeholder="Password">
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="owner_login_submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
											</div>
										</div>
									</div>
									<p id="error"></p>
									<p id="success"></p>
								</form>
								<form id="register-form" action="#" method="post" role="form" style="display: none;">
									<div class="form-group">
										<input type="text" name="owner_name" id="name" tabindex="1" class="form-control" placeholder="Name">
									</div>
									<div class="form-group">
										<input type="text" name="owner_contact" id="contact" tabindex="1" class="form-control" placeholder="Contact">
									</div>
									<div class="form-group">
										<input type="text" name="storage_name" id="sto_name" tabindex="1" class="form-control" placeholder="Storage name">
									</div>
									<div class="form-group">
										<input type="text" name="storage_location" id="location" tabindex="1" class="form-control" placeholder="Storage location">
									</div>
									<div class="form-group">
										<input type="email" name="owner_email" id="email" tabindex="1" class="form-control" placeholder="Email Address">
									</div>
									<div class="form-group">
										<input type="password" name="owner_password" id="password" tabindex="2" class="form-control" placeholder="Password">
									</div>
									<div class="form-group">
										<input type="password" name="owner_confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="owner_register_submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<?php

require 'dbconnection.php';

function validate_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


if (isset($_POST['owner_login_submit'])) {
	$email 				= validate_input($_POST['owner_log_email']);
	$password 			= validate_input($_POST['owner_log_password']);

	// echo $email . ":" . $password . ":";

	if (empty($email) || empty($password)) {
		echo "<script>document.getElementById('error').innerHTML = 'All Fields are required.';</script>";
	} else {
		$query = "SELECT `owner_password` FROM `storage_reg_owner` WHERE `owner_email` = '$email'";
		$result= mysqli_query($dbconnect, $query);
		$rows = mysqli_fetch_array($result);
		$store_password = $rows['owner_password'];
		$check = password_verify($password, $store_password);
		if ($check) {
			$_SESSION['owner_login'] = $email;
			header('Location: owner_dashboard.php');
		}else{
			echo "<script>document.getElementById('error').innerHTML = 'Username or Password Invalid.';</script>";
		}
	}
}

if (isset($_POST['owner_register_submit'])) {
	$name 				= validate_input($_POST['owner_name']);
	$contact 			= validate_input($_POST['owner_contact']);
	$storage_name		= validate_input($_POST['storage_name']);
	$storage_location	= validate_input($_POST['storage_location']);
	$email 				= validate_input($_POST['owner_email']);
	$password 			= validate_input($_POST['owner_password']);
	$confirm_password 	= validate_input($_POST['owner_confirm-password']);

	// echo $name . " : " . $contact . " : " . $storage_name . " : " . $storage_location . " : " . $email . " : " . $password . " : " . $confirm_password;

	if ($password != $confirm_password) {
		echo "<script>document.getElementById('error').innerHTML = 'Confirm password not matched.'</script>";
	} else {
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$password = password_hash($password, PASSWORD_BCRYPT);
			$sqlquery1 = "INSERT INTO `storage_info`(`storage_id`, `storage_name`, `storage_location`) VALUES (NULL, '$storage_name', '$storage_location')";
			$result1 = mysqli_query($dbconnect, $sqlquery1);
			if ($result1) {
				$sqlquery2 = "SELECT `storage_id` FROM `storage_info` WHERE `storage_name` = '$storage_name'";
				$result2 = mysqli_query($dbconnect, $sqlquery2);
				$row = mysqli_fetch_assoc($result2);
				$storage_info_id = $row['storage_id'];
				if ($storage_info_id) {
					$sqlquery3 = "INSERT INTO `storage_reg_owner`(`storage_id`, `storage_name`, `storage_location`, `own_id`, `owner_name`, `owner_email`, `owner_password`, `owner_contact`) VALUES ('$storage_info_id','$storage_name','$storage_location',NULL,'$name','$email','$password','$contact')";
					$result3 = mysqli_query($dbconnect, $sqlquery3);
					if ($result3) {
						echo "<script>document.getElementById('success').innerHTML = 'Registration Successfull.'</script>";
					} else {
						echo "<script>document.getElementById('error').innerHTML = 'Registration failed.1'</script>";
					}
				} else {
					echo "<script>document.getElementById('error').innerHTML = 'Registration failed.2'</script>";
				}
			} else {
				echo "<script>document.getElementById('error').innerHTML = 'Registration failed.3'</script>";
			}
		} else {
			echo "<script>document.getElementById('error').innerHTML = 'Enter a valid email.'</script>";
		}
	}
}

mysqli_close($dbconnect);
?>