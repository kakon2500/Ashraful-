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
    <script type="text/javascript">
        $(document).ready(function(){
            $('.search-box input[type="text"]').on("keyup input", function(){
                /* Get input value on change */
                var inputVal = $(this).val();
                var resultDropdown = $(this).siblings(".result");
                if(inputVal.length){
                    $.get("search.php", {term: inputVal}).done(function(data){
                        // Display the returned data in browser
                        resultDropdown.html(data);
                    });
                } else{
                    resultDropdown.empty();
                }
            });
            
            // Set search input value on click of result item
            $(document).on("click", ".result p", function(){
                $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
                $(this).parent(".result").empty();
            });
        });
    </script>

</head>

<body>
    <div id="preloader"></div>

    <div id="mySidenav" class="sidenav">
        <a href="client_reg.php" id="client">Client Login/Registration</a>
        <a href="owner_reg.php" id="owner">Owner Login/Registration</a>
    </div>

    <!--==========================
    Hero Section
    ============================-->
    <section id="hero">
        <div class="hero-container">
            <div class="wow fadeIn">

                <h1>Welcome to Global Cold Storage</h1>

                <div class="row">
                    <div class="col-xs-6 col-xs-offset-3 col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 mt-2">
                        <form class="input-group search-box" method="post" action="#">
                            <input type="text" class="form-control" name="searchlocation" autocomplete="off" placeholder="Search for Cold Storage...">
                            <div class="result"></div>
                            <span class="input-group-btn">
                                <button class="btn btn-default" name="search_btn" type="submit">Search!</button>
                            </span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--==========================
    Header Section
    ============================-->
    <header id="header">
        <div class="container">

            <div id="logo" class="pull-left">
                <a href="#hero"><img src="img/logo.png" alt="" title="" /></img></a>
            </div>

            <nav id="nav-menu-container">
                <ul class="nav-menu">
                    <li class="menu-active"><a href="#hero">Home</a></li>
                    <li><a href="#about">About Us</a></li>
                </ul>
            </nav>
            <!-- #nav-menu-container -->
        </div>
    </header>
    <!-- #header -->

    <!--==========================
    About Section
    ============================-->
    <section id="about">
        <div class="container wow fadeInUp">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="section-title">About Us</h3>
                    <div class="section-title-divider"></div>
                    <p class="section-description">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam</p>
                </div>
            </div>
        </div>
        <div class="container about-container wow fadeInUp">
            <div class="row">

                <div class="col-lg-6 about-img">
                    <img src="img/about-img.jpg" alt="">
                </div>

                <div class="col-md-6 about-content">
                    <h2 class="about-title">We provide great services</h2>
                    <p class="about-text">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                        in reprehenderit in voluptate
                    </p>
                    <p class="about-text">
                        Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim
                        id est laborum
                    </p>
                    <p class="about-text">
                        Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt molli.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

    <!-- Required JavaScript Libraries -->
    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="lib/superfish/hoverIntent.js"></script>
    <script src="lib/superfish/superfish.min.js"></script>
    <script src="lib/morphext/morphext.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/stickyjs/sticky.js"></script>
    <script src="lib/easing/easing.js"></script>

    <!-- Template Specisifc Custom Javascript File -->
    <script src="js/custom.js"></script>
</body>
</html>
<?php

if (isset($_POST['search_btn'])) {
    $searchlocation = $_POST['searchlocation'];
    echo "<script>javascript:document.location='storagelocation.php?name=".$searchlocation."'</script>";
}

?>