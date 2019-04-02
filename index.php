<?php session_start(); ?>
<html lang="en">
<?php include 'php_tools/settings.php';?>
<head>
    <title>The Wall</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Pim Hakkert, Rai Griffioen, Casper Matauschek">
    <meta name="viewport" content="user-scalable=no, width=device-width" />
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-grid.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.css">
    <link rel="icon" href="images/TheWallLogo.png">
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery.smoothState.min.js"></script>
    <script src="js/pagetransition.js"></script>
    <link rel="stylesheet" type="text/css" href="css/master.scss">
</head>
<body>

<input type="checkbox" id="toggleMenu">
<div class="wrapper" id="main">

    <nav class="upperNav" style="height: 5em; background-color: dimgrey">
        <?php
            if(isset($_SESSION['username'])){
                echo "<label class=\"uploadButtonLabel\" for=\"uploadButton\">Upload</label>";
                echo "<a href='php_tools/logout.php'><input type=\"button\" value=\"Logout\" name=\"button\" id=\"mobileLogout\"></a>";
            }
            else {
                echo "<input type=\"button\" value=\"Login\" onclick=\"location.href = 'login.php'\">";
            }
        ?>

    </nav>

    <div class="modalContent">
        <div class="modalItemTitle2"></div>
        <form class="modalUploadForm" action="" method="post" enctype="multipart/form-data">

            <div class="ModalUploadDiv">
                Select image to upload:
            <input class="modalUploadFile" type="file" name="fileToUpload" id="fileToUpload" accept="images/*">
            </div>
            <div class="modalUploadContent">
                <div>
                    <p>Title:</p>
                    <p>Description:</p>
                    <p style="margin-top: 4em">Tags:</p>
                </div>
                <div class="modalUploadInput">
                    <input class="modalUploadTitle" name="modalUploadTitle" type="text" >
                    <textarea class="modalUploadDescription" name="modalUploadDescription"></textarea>
                    <input class="modalUploadTags" name="modalUploadTags" type="text" >
                </div>
                <div class="modalUploadSubmit">
                    <input class="modalUploadSubmit" type="submit" value="Upload Image" name="submit">
                </div>


            </div>
        </form>
        <?php include 'php_tools/uploadbackend.php'; ?>
    </div>

    <nav class="customNavbar">
        <img class="navbarLogo" src="images/TheWallLogo.png" alt="">
        <?php
        if(isset($_SESSION['username'])){
            echo "<button class=\"modalButton upload\" id=\"uploadButton\" type=\"button\" name=\"button\" style=\"margin-left: auto\">Upload</button>";
            echo "<a href='php_tools/logout.php'><button type=\"button\" name=\"button\" id=\"logout\">Logout</button></a>";
        }
        else {
            echo "<button class=\"modalButton upload\" id=\"uploadButton\" type=\"button\" name=\"button\" style=\"display: none\">Upload</button>";
            echo "<button type=\"button\" name=\"button\" onclick=\"location.href = 'login.php'\">Login</button>";
        }
        ?>


        <label for="toggleMenu" id="navHamburger">&#9776;</label>
    </nav>

    <div class="container gallery">
        <?php include 'php_tools/query.php'?>
    </div>

    <script src="js/modal.js"></script>
</div>
<div class="footer"></div>
</body>
</html>
