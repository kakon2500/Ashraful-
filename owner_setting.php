<?php
session_start();
require 'dbconnection.php';
if (!isset($_SESSION['owner_login'])) {
	header('Location: index.php');
	exit();
}

$ownerEmail = $_SESSION['owner_login'];

$sqlquery1 = "SELECT `storage_name`, `storage_location`, `owner_contact` FROM `storage_reg_owner` WHERE `owner_email` = '$ownerEmail'";
$result1 = mysqli_query($dbconnect, $sqlquery1);
$row = mysqli_fetch_assoc($result1);
$storage_name       = $row['storage_name'];
$storage_location   = $row['storage_location'];
$owner_contact      = $row['owner_contact'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Client Dashboard</title>
    <link href="img/gcs.ico" rel="shortcut icon">

    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="lib/animate-css/animate.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/ownerdashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="css/Reglog.css">
</head>

<body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">GLOBAL COLD STORAGE</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="owner_dashboard.php">Dashboard</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="form-area">  
                    <form role="form" method="post" action="#">
                        <br style="clear:both">
                        <h3 style="margin-bottom: 25px; text-align: center;">Profile Settings</h3>
                        <div class="form-group">
                            <input type="text" class="form-control" id="storage_name" name="storage_name" placeholder="Storage Name" value="<?php echo $storage_name ?>" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="storage_location" name="storage_location" placeholder="Storage Location" value="<?php echo $storage_location ?>" required>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="product_type" name="storage_product_type" placeholder="Product Type" required>
                                <option>Egg</option>
                                <option>Vegetable</option>
                                <option>Chicken</option>
                                <option>Fish</option>
                                <option>Fruit</option>
                                <option>Meat</option>
								<option>Rice</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="payment" name="storage_payment" placeholder="Payment/KG" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="contact" name="storage_contact" placeholder="Contact" value="<?php echo $owner_contact ?>" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="storage_capacity" name="storage_capacity" placeholder="Storage Capacity" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="storage_temperature" name="storage_temperature" placeholder="Storage Temperature" required>
                        </div>
                        <button type="submit" id="submit" name="form_datasubmit" class="btn btn-primary pull-right">Submit</button>
                        <p id="error"></p>
                        <p id="success"></p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery-1.11.1.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery-1.11.1.min.js"><\/script>')</script>
    <script src="lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/holder.min.js"></script>
</body>
</html>
<?php

function validate_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['form_datasubmit'])) {
    $storage_name2              = validate_input($_POST['storage_name']);
    $storage_location2          = validate_input($_POST['storage_location']);
    $storage_product_type       = validate_input($_POST['storage_product_type']);
    $storage_payment            = validate_input($_POST['storage_payment']);
    $storage_contact            = validate_input($_POST['storage_contact']);
    $storage_capacity           = validate_input($_POST['storage_capacity']);
    $storage_temperature        = validate_input($_POST['storage_temperature']);

    // echo $storage_name . " : " . $storage_location . " : " . $storage_product_type . " : " . $storage_payment . " : " . $storage_contact . " : " . $storage_capacity . " : " . $storage_temperature;

    if ($storage_name == $storage_name2 && $storage_location == $storage_location2) {
        $sqlquery2 = "UPDATE `storage_info` SET `product_type` = '$storage_product_type',`payment` = '$storage_payment',`contact` = '$storage_contact',`storage_capacity` = '$storage_capacity',`storage_temperature` = '$storage_temperature', `space_booked` = '$storage_capacity' WHERE `storage_name` = '$storage_name2' AND `storage_location` = '$storage_location2'";
        $result2 = mysqli_query($dbconnect, $sqlquery2);
        echo $result2;
        if ($result2) {
            echo "<script>document.getElementById('success').innerHTML = 'Profile Updated.'</script>";
        } else {
            echo "<script>document.getElementById('error').innerHTML = 'Profile Updated failed.'</script>";
        }
    } else {
        echo "<script>document.getElementById('error').innerHTML = 'Storage Not Found.'</script>";
    }
}