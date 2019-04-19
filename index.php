<?php
session_start();
$timeout = 1199;
$voteId = null;
$upvoteCount = -999;
if(isset($_SESSION['timeout'])){
    $duration = time() - (int)$_SESSION['timeout'];
    if($duration > $timeout){
        session_unset();
        session_destroy();
        session_start();
        header('Location: login.php');
    }
}
$_SESSION['timeout'] = time();

include 'php_tools/settings.php';
include 'php_tools/showamount.php';

if(isset($_SESSION['username'])){
    $upvoteCount = 0;
    $username = $_SESSION['username'];
    $sql = "SELECT profilepicture FROM users WHERE user_name = ?";
    $statement = $database->prepare($sql);
    $statement->execute([$username]);
    $profilePicture = $statement->fetchColumn();
    $sql2 = "SELECT id FROM users WHERE user_name = ?";
    $statement = $database->prepare($sql2);
    $statement->execute([$username]);
    $userID = $statement->fetchColumn();
    $voteId = $userID;
    $countSql = "SELECT SUM(score) FROM images WHERE user_id = ?";
    $statement = $database->prepare($countSql);
    $statement->execute([$userID]);
    $upvoteCount = $statement->fetchColumn();
    if($upvoteCount==null){
        $upvoteCount = 0;
    }
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
    <link rel="icon" href="images/TheWallLogo.png">
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/master2.css">
</head>
<body>
<input type="checkbox" id="toggleMenu">
<div class="wrapper" id="wrapper">
    <input type="checkbox" id="searchMenuToggle" style="transform: translateY(20em); opacity: 0;">

    <nav class="upperNav" style="height: 11em; background-color: #3d3d3d; padding-top:15px; border-bottom-style: solid">
        <?php
        $sortText = "<select class=\"searchMenuSortBy2\" name=\"sortby2\" id=\"sortby2\" onchange=\"sortFunction2()\">
<option value=\"sortby\">Sort by</option>
<option value=\"newtoold\">Time: new - old</option>
<option value=\"oldtonew\">Time: old - new</option>
<option value=\"lowtohigh\">Score: low - high</option>
<option value=\"hightolow\">Score: high - low</option>
</select>";
        $searchText = "<select class=\"searchMenuSearchSelect2\" name=\"searchSelect2\" id=\"searchSelect2\">
<option value=\"title\">Title</option>
<option value=\"tag\">Tag</option>
<option value=\"user\">User</option>
</select>";
            if(isset($_SESSION['username'])){
                echo "<label class=\"uploadButtonLabel\" for=\"searchButton2\" id=\"uploadButton1\">Search</label>";
                echo $sortText;
                echo $searchText;
                echo "<input style='padding-left: 10px;' class='searchMenuInput' id=\"searchInput2\" type=\"text\" placeholder=\"Search..\">";
                echo "<button style='display: none' class='searchMenuSearchButton' id=\"searchButton2\" onclick=\"searchFunction2()\">&#x1F50E;</button>";
            }
            else {
                echo "<label class=\"uploadButtonLabel\" for=\"uploadButton2\" id=\"uploadButton1\" style=\"display: none\">Upload</label>";
                echo $sortText;
                echo $searchText;
                echo "<input class='searchMenuInput' id=\"searchInput2\" type=\"text\" placeholder=\"Search..\">";
                echo "<button style='display: none' class='searchMenuSearchButton'  onclick=\"searchFunction2()\">&#x1F50E;</button>";
                echo "<button style='height: 2.9em;' class='login2' id=\"searchButton2\" type=\"button\" value=\"Search\" onclick=\"searchFunction2()\">Search</button>";
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
            <div class="modalUploadContent modalUpload">
                <div>
                    <p>Title:</p>
                    <p>Description:</p>
                    <p style="margin-top: 4em">Tags:</p>
                </div>
                <div class="modalUploadInput">
                    <input class="modalUploadTitle" name="modalUploadTitle" type="text" >
                    <textarea class="modalUploadDescription" name="modalUploadDescription"></textarea>
                    <input class="modalUploadTags" name="modalUploadTags" type="text" >
                    <br><p>Separate Tags with commas</p>
                </div>
                <div class="modalUploadSubmit">
                    <input style="transform: translateY(-3em)" class="modalUploadSubmit" type="submit" value="Upload Image" name="submit">
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
            echo "<div class='navProfile navButton'><a href='dashboard.php'><img onclick='window.location = \" dashboard.php\"' class='navProfileIcon' src='profilepictures/".$profilePicture."' alt=''></a><a href='dashboard.php'><h3 class='navProfileUsername'>" . $_SESSION['username'] . "</h3></a><h3 class='navProfilePosts'>Upvotes: ".$upvoteCount."</h3><a class='navProfileLogout' href='php_tools/logoutbackend.php'>Logout</a></div>";
            echo "<button class=\"modalButton upload navButton gradient-border\" id=\"uploadButton2\" type=\"button\" name=\"button\" style=\"margin-left: auto\">Upload</button>";
        }
        else {
            echo "<button class='navButton loginButton' type=\"button\" name=\"button\" onclick=\"location.href = 'login.php'\">Login</button>";
            echo "<button class=\"modalButton upload navButton\" id=\"uploadButton2\" type=\"button\" name=\"button\" style=\"display: none\">Upload</button>";
        }
        ?>
        <label for="toggleMenu" id="navHamburger">&#9776;</label>
        <label for="searchMenuToggle" class="searchMenuToggleLabel" style="font-size: 4em; margin-right: 10px">&#9776;</label>
        </div>

    </nav>

    <nav class="searchMenu">
        <select style="padding-left: 10px;" class="searchMenuSearchSelect" name="searchSelect" id="searchMenuSelect">
            <option value="title">Title</option>
            <option value="tag">Tag</option>
            <option value="user">User</option>
        </select>
        <input style="padding-left: 10px;" id="searchInput" type="text" placeholder="Search..">
        <button id="searchButton" onclick="searchFunction()">Search</button>
        <select class="searchMenuSortBy" name="sortby" id="sortby" onchange="sortFunction()">
            <option value="sortby">Sort by</option>
            <option value="newtoold">Time: new - old</option>
            <option value="oldtonew">Time: old - new</option>
            <option value="lowtohigh">Score: low - high</option>
            <option value="hightolow">Score: high - low</option>
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
    <script src="js/imagescore.js"></script>


    <div class="footer">
        <?php include('php_tools/paginator.php'); ?>
        <h6>&#169; CRAP</h6>
    </div>
</div>
<?php
    if(isset($_SESSION['username'])){
        echo '<label class="mobileUpload" for="uploadButton2">&plus;</label>';
    }
if(isset($_GET['msg'])){
    echo '<script language="javascript">';
    echo 'alert("Error: Search results not found!")';
    echo '</script>';
}
?>
</body>
</html>
