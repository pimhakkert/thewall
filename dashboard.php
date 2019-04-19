<?php
session_start();
$timeout = 1199;
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

if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM users WHERE user_name = ?";
    $statement = $database->prepare($sql);
    $statement->execute([$username]);
    $result = $statement->fetch(PDO::FETCH_ASSOC);
}
else {
    header('Location: login.php');
}
include ('php_tools/dashboardbackend.php');
$upvoteCount = null;
$sql2 = "SELECT id FROM users WHERE user_name = ?";
$statement = $database->prepare($sql2);
$statement->execute([$username]);
$userID = $statement->fetchColumn();
$countSql = "SELECT SUM(score) FROM images WHERE user_id = ?";
$statement = $database->prepare($countSql);
$statement->execute([$userID]);
$upvoteCount = $statement->fetchColumn();
if($upvoteCount==null){
    $upvoteCount = 0;
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
    <link rel="icon" href="images/TheWallLogo.png">
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
        <?php
        if(isset($_SESSION['username'])){
            echo "<a href='php_tools/logout.php'><input type=\"button\" value=\"Logout\" name=\"button\" id=\"mobileLogout\"></a>";
        }
        else {
            echo "<input type=\"button\" value=\"Login\" onclick=\"location.href = 'login.php'\">";
        }
        ?>

    </nav>

    <nav class="customNavbar">
        <div class="navbarLogo" onclick="window.location = 'index.php';"><img class="navbarLogoImg" src="images/TheWallLogo.png" alt=""></div>
        <div class="navButtons">
            <?php
            if(isset($_SESSION['username'])){
                echo "<div class='navProfile navButton'><a href='dashboard.php'><img class='navProfileIcon' src='profilepictures/".$result['profilepicture']."' alt=''></a><a href='dashboard.php'><h3 class='navProfileUsername'>".$_SESSION['username']."</h3></a><h3 class='navProfilePosts'>Upvotes: ".$upvoteCount."</h3><a class='navProfileLogout' href='php_tools/logoutbackend.php'>Logout</a></div>";
            }
            else {
                echo "<button class=\"modalButton upload navButton\" id=\"uploadButton\" type=\"button\" name=\"button\" style=\"display: none\">Upload</button>";
                echo "<button class='navButton' type=\"button\" name=\"button\" onclick=\"location.href = 'login.php'\">Login</button>";
            }
            ?>
            <label for="toggleMenu" id="navHamburger">&#9776;</label>
        </div>
    </nav>

    <div class="dashboard" id="dashboard">
        <div class="dashboardBar" id="dashboardBar">Dashboard</div>
        <div style="overflow-y: scroll; grid-column-start: 1; grid-column-end: 3;">
            <div class="dashboardContent">

                <form method="post" action="" class="dashboardProfileSettings">
                    <h3 style="margin-bottom: 1em">Settings</h3>
                    <div class="dashboardProfileSetting"><h5>New username:</h5><input name="newUsername" class="usernameSetting" type="text" value="<?php echo $result['user_name']; ?>"></div>
                    <div class="dashboardProfileSetting"><h5>New email:</h5><input name="newEmail" class="emailSetting" type="text" value="<?php echo $result['user_email']; ?>"></div>
                    <div style="display: flex; justify-content: flex-end"><input name="submit2" type="submit" value="Apply" class="dashboardEditButton" style="background-color: #1e7e34; transform: translateX(-80px)" ></div>
                </form>

                <form method="post" action="" class="dashboardProfileSettings" enctype="multipart/form-data">
                    <div class="dashboardProfileSetting"><h5>Profile-icon:</h5><br><input class="profileIconSetting" type="file" name="fileToUpload" id="fileToUpload" accept="images/*"></div>
                    <div style="display: flex; justify-content: flex-end">
                        <input type="submit" name="submit1" value="Apply" class="dashboardEditButton" style="background-color: #1e7e34; transform: translateX(-80px)">
                    </div>
                </form>

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