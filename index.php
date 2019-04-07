<?php
session_start();
$timeout = 1199;
if(isset($_SESSION['timeout'])){
    $duration = time() - (int)$_SESSION['timeout'];
    if($duration > $timeout){
        session_unset();
        session_destroy();
        session_start();
    }
}
$_SESSION['timeout'] = time();
?>
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
    <link rel="stylesheet" type="text/css" href="css/master2.css">
</head>
<body>
<input type="checkbox" id="toggleMenu">
<div class="wrapper" id="main">
    <input type="checkbox" id="searchMenuToggle" style="transform: translateY(20em); opacity: 0;">

    <nav class="upperNav" style="height: 5em; background-color: dimgrey">
        <?php
            if(isset($_SESSION['username'])){
                echo "<label class=\"uploadButtonLabel\" for=\"uploadButton\" id=\"uploadButton1\">Upload</label>";
                echo "<a href='php_tools/logoutbackend.php'><input type=\"button\" value=\"Logout\" name=\"button\" id=\"mobileLogout\"></a>";

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
        <div class="navbarLogo"><a href="index.php"><img class="navbarLogoImg" src="images/TheWallLogo.png" alt=""></a></div>
        <div class="navButtons">
        <?php
        if(isset($_SESSION['username'])){
            echo "<div class='navProfile navButton'><img class='navProfileIcon' src='images/angerypigeon.jpg' alt=''><a href='dashboard.php'><h3 class='navProfileUsername'>" . $_SESSION['username'] . "</h3></a><h3 class='navProfilePosts'>Posts: 102</h3><a class='navProfileLogout' href='php_tools/logoutbackend.php'>Logout</a></div>";
            echo "<button class=\"modalButton upload navButton\" id=\"uploadButton2\" type=\"button\" name=\"button\" style=\"margin-left: auto\">Upload</button>";
        }
        else {
            echo "<button class='navButton' type=\"button\" name=\"button\" onclick=\"location.href = 'login.php'\">Login</button>";
        }
        ?>
        <label for="toggleMenu" id="navHamburger">&#9776;</label>
        <label for="searchMenuToggle" class="searchMenuToggleLabel" style="font-size: 4em; margin-right: 10px">&#9776;</label>
        </div>

    </nav>

    <nav class="searchMenu">
        <select class="searchMenuSearchSelect" name="searchSelect" id="">
            <option value="title">Title</option>
            <option value="tag">Tag</option>
            <option value="user">User</option>
        </select>
        <input id="searchInput" type="text" placeholder="Search..">
        <button id="searchButton">Search</button>
        <select class="searchMenuSortBy" name="sortby" id="sortby">
            <option value="sortby">Sort By</option>
            <option value="newtoold">New/old</option>
            <option value="oldtonew">Old/new</option>
        </select>
    </nav>

    <div class="container gallery">
        <?php include 'php_tools/query.php'?>
    </div>
    <div class="aside sort">

    </div>

    <script src="js/modal.js"></script>
    <script src="js/sessioncheck.js"></script>
    <script src="js/search.js"></script>
</div>
<div class="footer"></div>
</body>
</html>
