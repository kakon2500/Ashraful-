<?php 

require 'dbconnection.php';

if (isset($_GET['name']) == '') {
    header('Location: index.php');
    exit();
}

if (isset($_GET)) {
    $str_name = mysqli_real_escape_string($dbconnect, $_GET['name']);
    $sqlQuery = "SELECT * FROM `storage_info` WHERE `storage_name` = '$str_name'";
    $result= mysqli_query($dbconnect, $sqlQuery);
    $rows = mysqli_fetch_assoc($result);
    if ($rows) {
        $product_type   = $rows['product_type'];
        $payment        = $rows['payment'];
        $contact        = $rows['contact'];
        $str_cap        = $rows['storage_capacity'];
        $str_temp       = $rows['storage_temperature'];
    }
}

if(isset($product_type) == NULL || isset($payment) == NULL || isset($contact) == NULL || isset($str_cap) == NULL){
    header('location: error.php');
}

//echo $product_type . " : " . $payment . " : " . $contact . " : " . $str_cap;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Global Cold Storage</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

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
                    <h3 class="section-title">Storage Name : <?php echo $str_name; ?></h3>
                    <div class="section-title-divider"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 service-item">
                    <h4 class="service-title"><a href="">Type of product you can store : <?php echo $product_type ?></a></h4>
                    <p class="service-description">
                        <img class="proType" src="img/<?php echo $product_type ?>.png" alt="">
                    </p>
                </div>
                <div class="col-md-6">
                    <div class="col-md-6 service-item">
                        <div class="service-icon"><i class="fa fa-money"></i></div>
                        <h4 class="service-title"><a href="">Payment</a></h4>
                        <p class="service-description"> BDT <?php echo $payment ?> per KG</p>
                    </div>
                    <div class="col-md-6 service-item">
                        <div class="service-icon"><i class="fa fa-phone-square"></i></div>
                        <h4 class="service-title"><a href="">Contact</a></h4>
                        <p class="service-description"><?php echo $contact ?></p>
                    </div>
                    <div class="col-md-6 service-item">
                        <div class="service-icon"><i class="fa fa-money"></i></div>
                        <h4 class="service-title"><a href="">Capacity</a></h4>
                        <p class="service-description"><?php echo $str_cap ?> KG</p>
                    </div>
                    <div class="col-md-6 service-item">
                        <div class="service-icon"><i class="fa fa-phone-square"></i></div>
                        <h4 class="service-title"><a href="">Temperature</a></h4>
                        <p class="service-description"><?php echo $str_temp ?>°C</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

    <!-- Template Specisifc Custom Javascript File -->
    <script src="js/custom.js"></script>

    
</body>
</html>