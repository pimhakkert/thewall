<html lang="en">
<?php include 'php_tools/settings.php';?>
<head>
    <title>The Wall</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.45">
    <meta name="author" content="Pim Hakkert, Rai Griffioen, Casper Matauschek">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-grid.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.css">
    <link rel="icon" href="images/TheWallLogo.png">
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="css/master.css">
</head>
<body>

<input type="checkbox" id="toggleMenu">
<div class="wrapper">

    <!--<nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" id="no" href="#"><img src="images/TheWallLogo.png" alt="" style="height: 100%;"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item modalButton">
                    <a class="nav-link" href="#">Upload</a>
                </li>
            </ul>
        </div>
    </nav>--->

    <nav class="upperNav" style="height: 5em; background-color: dimgrey">
        <label class="uploadButtonLabel" for="uploadButton">Upload</label>
        <input type="button" value="Login" onclick="location.href = 'login.php'">
    </nav>

    <div class="modalContent">
        <h1>Hallo</h1>
    </div>

    <nav class="customNavbar">
        <img class="navbarLogo" src="images/TheWallLogo.png" alt="">
        <button class="modalButton upload" id="uploadButton" type="button" name="button" style="margin-left: auto">Upload</button>
        <button type="button" name="button" onclick="location.href = 'login.php'">Login</button>
        <label for="toggleMenu" id="navHamburger">&#9776</label>
    </nav>

    <div class="container gallery">
        <?php include 'php_tools/query.php'?>
    </div>
    <script src="js/modal.js"></script>
</div>
<footer>
</footer>
</body>
</html>
