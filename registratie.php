<html lang="en">
<?php include 'php_tools/settings.php';?>
<head>
  <title>The Wall</title>
  <meta charset="utf-8">
  <meta name="author" content="Pim Hakkert, Rai Griffioen, Casper Matauschek">
  <link rel="stylesheet" href="css/bootstrap.css" >
  <link rel="stylesheet" href="css/bootstrap-grid.css">
  <link rel="stylesheet" href="css/bootstrap-reboot.css">
  <link rel="icon" href="images/TheWallLogo.png">
  <script src="js/bootstrap.js"></script>
  <script src="js/jquery-3.3.1.min.js"></script>
  <link rel="stylesheet" href="css/master2.scss">
  <link rel="stylesheet" href="css/registratie.css">
</head>
<body>

  <input type="checkbox" id="toggleMenu">
    <div class="wrapper">

        <nav class="upperNav" style="height: 5em; background-color: dimgrey">
            <label class="uploadButtonLabel" for="uploadButton">Upload</label>
            <input type="button" value="Login" onclick="location.href = 'login.php'">
        </nav>

        <nav class="customNavbar">
            <img class="navbarLogoImg" style="margin-bottom: 0.5em" src="images/TheWallLogo.png" onclick="location.href = 'index.php'" alt="">
            <button class="modalButton upload" id="uploadButton" type="button" name="button" style="margin-left: auto">Upload</button>
            <button type="button" name="button" onclick="location.href = 'login.php'">Login</button>
            <label for="toggleMenu" id="navHamburger">&#9776;</label>
        </nav>

        <form class="login" action="" method="post">
            <input type="text" placeholder="Username" id="username" name="username">
            <input type="text" placeholder="E-mail" id="username" name="email">
            <input type="password" placeholder="Password" id="password" name="password">
            <input type="password" placeholder="Confirm password" id="password" name="passwordconfirm">
            <?php include 'php_tools/signupbackend.php' ?>
            <input type="submit" value="Sign Up" id="submit" name="submit">
        </form>
        <div class="shadow"></div>

<footer>

</footer>
</body>
</html>
