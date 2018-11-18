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
	<title>Client login and Registration</title>
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
										<input type="email" name="client_log_email" id="email" tabindex="1" class="form-control" placeholder="Email">
									</div>
									<div class="form-group">
										<input type="password" name="client_log_password" id="password" class="form-control" placeholder="Password">
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="client_login_submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
											</div>
										</div>
									</div>
									<p id="error"></p>
									<p id="success"></p>
								</form>
								<form id="register-form" action="#" method="post" role="form" style="display: none;">
									<div class="form-group">
										<input type="text" name="client_name" id="name" tabindex="1" class="form-control" placeholder="Name">
									</div>
									<div class="form-group">
										<input type="text" name="client_contact" id="contact" tabindex="1" class="form-control" placeholder="Contact">
									</div>
									<div class="form-group">
										<input type="email" name="client_email" id="email" tabindex="1" class="form-control" placeholder="Email Address">
									</div>
									<div class="form-group">
										<input type="password" name="client_password" id="password" class="form-control" placeholder="Password">
									</div>
									<div class="form-group">
										<input type="password" name="client_confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="client_register_submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
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


if (isset($_POST['client_login_submit'])) {
	$email 				= validate_input($_POST['client_log_email']);
	$password 			= validate_input($_POST['client_log_password']);

	// echo $email . ":" . $password . ":";

	if (empty($email) || empty($password)) {
		echo "<script>document.getElementById('error').innerHTML = 'All Fields are required.';</script>";
	} else {
		$query = "SELECT `client_password` FROM `storage_reg_client` WHERE `client_email` = '$email'";
		$result= mysqli_query($dbconnect, $query);
		$rows = mysqli_fetch_array($result);
		$store_password = $rows['client_password'];
		$check = password_verify($password, $store_password);
		if ($check) {
			$_SESSION['client_login'] = $email;
			header('Location: client_dashboard.php');
		}else{
			echo "<script>document.getElementById('error').innerHTML = 'Username or Password Invalid.';</script>";
		}
	}
}

if (isset($_POST['client_register_submit'])) {
	$name 				= validate_input($_POST['client_name']);
	$contact 			= validate_input($_POST['client_contact']);
	$email 				= validate_input($_POST['client_email']);
	$password 			= validate_input($_POST['client_password']);
	$confirm_password 	= validate_input($_POST['client_confirm-password']);

	// echo $name . " : " . $contact . " : " . $email . " : " . $password . " : " . $confirm_password;

	if ($password != $confirm_password) {
		echo "<script>document.getElementById('error').innerHTML = 'Confirm password not matched.'</script>";
	} else {
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$password = password_hash($password, PASSWORD_BCRYPT);
			$sqlquery = "INSERT INTO `storage_reg_client`(`client_id`, `client_name`, `client_contact`, `client_email`, `client_password`) VALUES (NULL,'$name', '$contact', '$email', '$password')";
			$result = mysqli_query($dbconnect, $sqlquery);
			if ($result) {
				echo "<script>document.getElementById('success').innerHTML = 'Registration Successfull.'</script>";
			} else {
				echo "<script>document.getElementById('error').innerHTML = 'Registration failed.'</script>";
			}
		} else {
			echo "<script>document.getElementById('error').innerHTML = 'Enter a valid email.'</script>";
		}
	}
}

mysqli_close($dbconnect);
?>