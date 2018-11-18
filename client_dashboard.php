<?php
session_start();
require 'dbconnection.php';
if (!isset($_SESSION['client_login'])) {
	header('Location: index.php');
	exit();
}

$storage_info = array();
$sqlquery1 = "SELECT `storage_name`, `storage_location` FROM `storage_info`";
if ($result1 = $dbconnect->query($sqlquery1)) {
	while ($info_rows = $result1->fetch_array(MYSQLI_ASSOC)) {
		$storage_info[] = $info_rows;
	}
	$result1->close();
}
sort($storage_info);

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
                    <li><a >Email : <?php echo $_SESSION['client_login']; ?></a></li>
                    <li><a href="client_dashboard.php">Dashboard</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 col-md-2 sidebar">
                <ul class="nav nav-sidebar">
                    <li class="active"><a href="#">Cold Storage List <span class="sr-only">(current)</span></a></li>
                    <?php
                    	foreach ($storage_info as $info_row) {
                    		echo "<li><a>" . ucfirst($info_row['storage_location']) . " (" . $info_row['storage_name'] . ")</a></li>";
                    	}
                    ?>
                </ul>
            </div>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h1 class="page-header">Client Dashboard</h1>
                <div class="col-md-6 col-md-offset-3">
                	<h3 class="text-center">Book for cold storage</h3>
                	<div class="form-area">  
	                    <form role="form" method="post" action="#">
	                        <br style="clear:both">
	                        <div class="form-group">
	                            <input type="text" class="form-control" id="storage_name" name="storage_name" placeholder="Storage Name" required>
	                        </div>
	                        <div class="form-group">
	                            <select class="form-control" id="storage_location" name="storage_location" placeholder="Storage Location" required>
	                            	<?php
	                            		foreach ($storage_info as $info_row) {
	                            			echo "<option>" . $info_row['storage_location'] ."</option>";
	                            		}
	                            	?>
	                            </select>
	                        </div>
	                        <div class="form-group">
	                            <input type="text" class="form-control" id="space" name="require_space" placeholder="Required Space (Example: 1kg, 2kg)" required>
	                        </div>
	                        <button type="submit" id="submit" name="form_datasubmit" class="btn btn-primary pull-right">Submit</button>
	                        <p id="error"></p>
	                        <p id="success"></p>
	                    </form>
	                </div>
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
require 'dbhelper.php';

if (isset($_POST['form_datasubmit'])) {
	$storage_name_book 			= $_POST['storage_name'];
	$storage_location_book 		= $_POST['storage_location'];
	$required_space 			= $_POST['require_space'];

	// echo $storage_name_book . " : " . $storage_location_book . " : " . $required_space;
	$chk_name          = check_storage_name($storage_name_book, $dbconnect);
    echo $chk_name;
	if ($chk_name == $storage_location_book) {
		$client_email 	= $_SESSION['client_login'];
		$client_id 		= client_id($client_email, $dbconnect);
		$own_id 		= own_id($storage_name_book, $dbconnect);
		$storage_id 	= storage_id($storage_name_book, $dbconnect);
		$payment 		= payment($storage_name_book, $dbconnect);
		$total_bill 	= $required_space * $payment;
		// echo $client_email . " : " . $client_id . " : " . $own_id . " : " . $storage_id . " : " . $payment;

        $space_booked = space_booked($storage_name_book, $dbconnect);
        $space_booked2 = $space_booked - $required_space;

        if ($space_booked2 >= 0) {
            $sqlquery2  = "INSERT INTO `booking`(`booking_id`, `client_id`, `owner_id`, `storage_id`, `storage_location`, `booking_space`, `total_bill`) VALUES (NULL,'$client_id','$own_id','$storage_id','$storage_location_book','$required_space','$total_bill')";
            $sqlquery3 = "UPDATE `storage_info` SET `space_booked`='$space_booked2' WHERE `storage_name` = '$storage_name_book'";
            $result2    = mysqli_query($dbconnect, $sqlquery2);
            $result3    = mysqli_query($dbconnect, $sqlquery3);
            if ($result2 && $result3) {
                echo "<script>document.getElementById('success').innerHTML = 'Storage Booked.'</script>";
            } else {
                echo "<script>document.getElementById('success').innerHTML = 'Failed.'</script>";
            }
        } else {
            echo "<script>document.getElementById('error').innerHTML = 'Not Enough Space'</script>";
        }
	} else {
		echo "<script>document.getElementById('error').innerHTML = 'Storage Name with " . $storage_name_book." is not found at " . $storage_location_book . "'</script>";
	}
}
?>