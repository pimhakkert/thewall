<?php
session_start();
$timeout = 300;
if(isset($_SESSION['timeout'])){
    $duration = time() - (int)$_SESSION['timeout'];
    if($duration > $timeout){
        session_unset();
        session_destroy();
        session_start();
        header('Refresh:0');
    }
}
$_SESSION['timeout'] = time();

include 'php_tools/settings.php';

if($_SERVER['REQUEST_METHOD']==='POST'&&isset($_POST['submit'])){
    if($_POST['password']!='fY7ctq4iQk7kxhtsUxJavNIVRN9x36LjJihlqJ4K7OTAdo4mricfzVSbRyP47yF8'){
        header('Location: index.php');
    }
}
else {
    header('Location: index.php');
}

foreach($errorsArray as $echo){
    echo '<script>alert('.$echo.');</script>';
}

?>
<html lang="en">
<head>
    <title>The Wall</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Pim Hakkert, Rai Griffioen, Casper Matauschek">
    <meta name="viewport" content="user-scalable=no, width=device-width" />
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-grid.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.css">
    <link rel="icon" href="site_images/TheWallLogo.png">
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery.smoothState.min.js"></script>
    <script src="js/pagetransition.js"></script>
    <link rel="stylesheet" type="text/css" href="css/master2.scss">
    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
</head>
<body>
<input type="checkbox" id="toggleMenu">
<div class="wrapper" id="main">
    <input type="checkbox" id="searchMenuToggle" style="transform: translateY(20em); opacity: 0;">

    <nav class="upperNav" style="height: 5em; background-color: dimgrey">
    </nav>

    <nav class="customNavbar">
        <div class="navbarLogo" onclick="window.location = 'index.php';"><img class="navbarLogoImg" src="site_images/TheWallLogo.png" alt=""></div>
    </nav>

    <div class="dashboard" id="dashboard">
        <div class="dashboardBar" id="dashboardBar">Administration</div>
        <div style="overflow-y: scroll; grid-column-start: 1; grid-column-end: 3;">
            <div class="dashboardContent">
                <h3 style="margin-bottom: 1em">Posts</h3>
                <?php include('php_tools/dashboardedit.php'); ?>
            </div>
        </div>

    </div>
    <script src="js/sessioncheck.js"></script><!--on submit check if in session-->
</div>
<script src="js/modal.js"></script>
<div class="footer"></div>
</body>
</html>