<html lang="en">
<?php include 'settings.php';?>
<head>
    <title>The Wall</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.45">
    <meta name="author" content="Pim Hakkert, Rai Griffioen, Casper Matauschek">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-grid.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.css">
    <link rel="icon" href="images/TheWallLogo.png">
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="css/master.css">
</head>
<body>


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


    <nav class="customNavbar">
        <img class="navbarLogo" src="images/TheWallLogo.png" alt="">
        <button class="modalButton upload" type="button" name="button" style="margin-left: auto">Upload</button>
        <button type="button" name="button" onclick="location.href = 'login.php'">Login</button>
    </nav>


    <div class="modalContent">
        <h1>Hallo</h1>
    </div>
    <div class="container gallery">


        <!--Gebruik deze galleryItem AUB om je modaleContent mee te testen. Dat gaat beter dan dat je een hele database verbinding moet hebben met mijn laptop
        die toch bijna niet aan staat.-->
        <div class="galleryItem ">
            <img class="galleryItemImg modalButton" src="images/meme1.jpg" alt="meme" height="469" width="469"/>
            <h3 class="galleryItemTitle"></h3>

            <div class="modalContent">
                <h1 class="modalItemTitle"></h1>
                <img class="modalItemImg" src="images/meme1.jpg" alt="">
                <p class="modalItemDesc"></p>
                <h3 class="modalItemOwner"></h3>
                <p class="modalItemTags"></p>
            </div>
        </div>


        <?php

           $sql = "SELECT * FROM images";
           foreach ($database->query($sql) as $results) {
           echo "<div class=\"galleryItem\">";
           echo "<img class=\"galleryItemImg modalButton\" src=\"images/" . $results['image_name'] . "\" alt=\"" . "Picture: " .  $results['image_title'] . "\"/>";
           echo "<h3 class=\"galleryItemTitle\">" . $results['image_title'] . "</h3>";
           echo    "<div class=\"modalContent\">";
           echo        "<h1 class=\"modalItemTitle\">";
           echo        "<img class=\"modalItemImg\" src=\"images/" . $results['image_name'] . "\" alt=\"" . "Picture: " . $results['image_title'] . "\">";
           echo        "<p class=\"modalItemDesc\"></p>";
           echo        "<h3 class=\"modalItemOwner\"></h3>";
           echo        "<p class=\"modalItemTags\"></p>";
           echo    "</div>";
           echo "</div>";
          }

           ?>


    </div>
    <script src="js/modal.js"></script>
</div>

<footer>

</footer>
</body>
</html>
