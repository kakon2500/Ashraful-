<?php
session_start();
require 'dbhelper.php';
require 'dbconnection.php';
error_reporting(0);
if (!isset($_SESSION['owner_login'])) {
	header('Location: index.php');
	exit();
}
$owner_email = $_SESSION['owner_login'];
$owner_id = own_id_email($owner_email, $dbconnect);
//echo $owner_email . " : " . $owner_id;

$booking_info = array();
$sqlquery1 = "SELECT `booking_id`, `client_id`, `owner_id`, `storage_id`, `storage_location`, `booking_space`, `total_bill` FROM `booking` WHERE `owner_id` = '$owner_id'";
if ($result1 = $dbconnect->query($sqlquery1)) {
    while ($info_rows = $result1->fetch_array(MYSQLI_ASSOC)) {
        $booking_info[] = $info_rows;
    }
    $result1->close();
}
$totalSpace = 0;
$bookarrylen = count($booking_info);
foreach ($booking_info as $info_row) {
    $totalSpace         += $info_row['booking_space'];
    $storage_location   = $info_row['storage_location'];
}
$spaceleft = storage_capacity($storage_location, $dbconnect) - $totalSpace;

$totalCap = storage_capacity($storage_location, $dbconnect);
$parcent = ($totalSpace * 100) / $totalCap;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Owner Dashboard</title>
    <link href="img/gcs.ico" rel="shortcut icon">

    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="lib/animate-css/animate.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/ownerdashboard.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/dash.css" rel="stylesheet">
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
                    <li><a >Email : <?php echo $_SESSION['owner_login']; ?></a></li>
                    <li><a href="owner_dashboard.php">Dashboard</a></li>
                    <li><a href="owner_setting.php">Settings</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <!-- <div class="col-sm-3 col-md-2 sidebar">
                <ul class="nav nav-sidebar">
                    <li class="active"><a href="#">Overview <span class="sr-only">(current)</span></a></li>
                    <li><a href="#">Reports</a></li>
                    <li><a href="#">Analytics</a></li>
                    <li><a href="#">Export</a></li>
                </ul>
                <ul class="nav nav-sidebar">
                    <li><a href="">Nav item</a></li>
                    <li><a href="">Nav item again</a></li>
                    <li><a href="">One more nav</a></li>
                    <li><a href="">Another nav item</a></li>
                    <li><a href="">More navigation</a></li>
                </ul>
                <ul class="nav nav-sidebar">
                    <li><a href="">Nav item again</a></li>
                    <li><a href="">One more nav</a></li>
                    <li><a href="">Another nav item</a></li>
                </ul>
            </div> -->
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h1 class="page-header">Owner Dashboard</h1>
                <div class="row placeholders">
                    
                    <div class="col-md-4">
                        <div class="dash-box dash-box-color-1">
                            <div class="dash-box-icon">
                                <i class="glyphicon glyphicon-cloud"></i>
                            </div>
                            <div class="dash-box-body">
                                <span class="dash-box-title">Total Client</span>
                                <span class="dash-box-count"><?php echo $bookarrylen; ?></span>
                            </div>           
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="dash-box dash-box-color-2">
                            <div class="dash-box-icon">
                                <i class="glyphicon glyphicon-download"></i>
                            </div>
                            <div class="dash-box-body">
                                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $parcent; ?>%;" data-toggle="tooltip" data-placement="top" title="HTML / HTML5">
                                    <!-- <span class="sr-only"><?php echo $parcent; ?>%</span> -->
                                    <span class="progress-type"><?php echo $parcent; ?>%</span>
                                </div>
                                <br>
                                <span class="dash-box-count">Space Booked</span>
                            </div>          
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="dash-box dash-box-color-3">
                            <div class="dash-box-icon">
                                <i class="glyphicon glyphicon-heart"></i>
                            </div>
                            <div class="dash-box-body">
                                <span class="dash-box-title">Space Left</span>
                                <span class="dash-box-count"><?php echo $spaceleft . "KG"; ?></span>
                            </div>           
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <h3 class="page-header">Booking History</h3>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Client Name</th>
                                <th>Storage Name</th>
                                <th>Storage Location</th>
                                <th>Booked Space</th>
                                <th>Total Bill</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($booking_info as $info_row) {
                                    echo "<tr>";
                                    echo "<td>" . ucfirst(client_name($info_row['client_id'], $dbconnect))  . "</td>";
                                    echo "<td>" . ucfirst(storage_name($info_row['storage_id'], $dbconnect)) . "</td>";
                                    echo "<td>" . ucfirst($info_row['storage_location']) . "</td>";
                                    echo "<td>" . $info_row['booking_space'] . " KG</td>";
                                    echo "<td>BDT " . $info_row['total_bill'] . "</td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
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