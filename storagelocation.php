<?php 

require 'dbconnection.php';

if (isset($_GET['name']) == '') {
    header('Location: index.php');
    exit();
}

$storage_info = array();
$location = mysqli_real_escape_string($dbconnect, $_GET['name']);
//$sqlquery1 = "SELECT `storage_name`, `contact` FROM `storage_info`";
$sqlquery1 = "SELECT `storage_name`, `contact` FROM `storage_info` WHERE `storage_location` = '$location'";
if ($result1 = $dbconnect->query($sqlquery1)) {
    while ($info_rows = $result1->fetch_array(MYSQLI_ASSOC)) {
        $storage_info[] = $info_rows;
    }
    $result1->close();
}

$arrstr_info = count($storage_info);

if($arrstr_info == 0){
    header('location: error.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Global Cold Storage</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="img/gcs.ico" rel="shortcut icon">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="lib/animate-css/animate.min.css" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="css/style.css" rel="stylesheet">
    
    <script src="js/jquery-1.12.4.min.js"></script>
    

</head>

<body>
    <div id="preloader"></div>

    <!--==========================
    Header Section
    ============================-->
    <header id="header">
        <div class="container">

            <div id="logo" class="pull-left">
                <a><img src="img/logo.png" alt="" title="" /></img></a>
            </div>

            <nav id="nav-menu-container">
                <ul class="nav-menu">
                    <li class="menu-active"><a href="index.php">Home</a></li>
                </ul>
            </nav>
            <!-- #nav-menu-container -->
        </div>
    </header>
    <!-- #header -->

    <!--==========================
    Services Section
    ============================-->
    <section id="services">
        <div class="container wow fadeInUp">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="section-title">Storage Location : <?php echo $location; ?></h3>
                    <h3 class="text-center"><?php echo $arrstr_info . " cold storage found in " . $location; ?> </h3>
                    <div class="section-title-divider"></div>
                </div>
            </div>
                    
            <div class="row">
                
                <?php
                    foreach ($storage_info as $info_row) {
                        echo '<div class="panel panel-default panel-horizontal">
                                <div class="panel-heading">
                                    <h3 class="panel-title">'. $info_row['storage_name'].'</h3>
                                </div>';
                        echo '<div class="panel-body"> Contact Info : '. $info_row['contact'].' <a href="storagename.php?name='.$info_row['storage_name'].'">View Details</a></div>
                            </div>';
                    }
                ?>
            </div>
        </div>
    </section>

    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

    <!-- Template Specisifc Custom Javascript File -->
    <script src="js/custom.js"></script>

    
</body>
</html>