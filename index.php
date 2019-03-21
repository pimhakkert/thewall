<html lang="en">
<?php include 'settings.php'; ?>
<head>
    <title>The Wall</title>
    <meta charset="utf-8">
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

    <nav class="navbar navbar-expand-lg navbar-dark">
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
                <li class="nav-item">
                    <a class="nav-link" href="#">Upload</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid gallery">


        <!--Gebruik deze galleryItem AUB om je modaleContent mee te testen. Dat gaat beter dan dat je een hele database verbinding moet hebben met mijn laptop
        die toch bijna niet aan staat.-->
        <div class="galleryItem modalButton">
            <img class="galleryItemImg" src="images/meme1.jpg" alt="meme" height="469" width="469"/>
            <h3 class="galleryItemTitle"></h3>
        </div>
        <div class="modalContent">
            <h1 class="modalItemTitle"></h1>
            <img class="modalItemImg" src="images/meme1.jpg" alt="">
            <p class="modalItemDesc"></p>
            <h3 class="modalItemOwner"></h3>
            <p class="modalItemTags"></p>
        </div>

        <!--<?php
        $sql = "SELECT * FROM images";
        foreach ($database->query($sql) as $results) {
            echo "<div class=\"galleryitem\">";
            echo "<img class=\"galleryItemImg\" src=\"images/" . $results['image_name'] . "\" alt=\"" . "Picture: " . $results['image_title'] . "\"/>";
            echo "<h3 class=\"galleryItemTitle\">" . $results['image_title'] . "</h3>";
            echo "<div class=\"modalItemContent\">";
            echo "<h1 class=\"modalItemTitle\">";
            echo "<img class=\"modalItemImg\" src=\"images/" . $results['image_name'] . "\" alt=\"" . "Picture: " . $results['image_title'] . "\">";
            echo "<p class=\"modalItemDesc\"></p>";
            echo "<h3 class=\"modalItemOwner\"></h3>";
            echo "<p class=\"modalItemTags\"></p>";
            echo "</div>";
            echo "</div>";
        }
        ?>-->
    </div>
</div>
<script src="js/modal.js"></script>
<footer>

</footer>
</body>
</html>
