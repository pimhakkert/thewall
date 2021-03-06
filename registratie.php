<?php session_start();
if(isset($_SESSION['username'])){
    session_write_close();
    header("Location: index.php");
}
?>
<html lang="en">
<?php include '../../private/php_tools/settings.php';?>
<head>
  <title>The Wall</title>
  <meta charset="utf-8">
  <meta name="author" content="Pim Hakkert, Rai Griffioen, Casper Matauschek">
    <meta name="viewport" content="user-scalable=no, width=device-width">
  <link rel="stylesheet" href="css/bootstrap.css" >
  <link rel="stylesheet" href="css/bootstrap-grid.css">
  <link rel="stylesheet" href="css/bootstrap-reboot.css">
  <link rel="icon" href="site_images/TheWallLogo.png">
  <script src="js/bootstrap.js"></script>
  <script src="js/jquery-3.3.1.min.js"></script>
  <link rel="stylesheet" href="css/master2.scss">
  <link rel="stylesheet" href="css/registratie.css">
  <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
</head>
<body>

  <input type="checkbox" id="toggleMenu">
    <div class="wrapper">

        <nav class="upperNav" style=" opacity: 0%; height: 5em; background-color: dimgrey">
            <label class="uploadButtonLabel" for="uploadButton">Upload</label>
            <input type="button" value="Login" onclick="location.href = 'login.php'">
        </nav>

        <nav class="customNavbar">
            <img class="navbarLogoImg" style="margin-bottom: 0.5em" src="site_images/TheWallLogo.png" onclick="location.href = 'index.php'" alt="">
        </nav>

        <form class="login" action="" method="post">
            <input type="text" placeholder="Username" id="username" name="username">
            <input type="text" placeholder="E-mail" id="username" name="email">
            <input type="password" placeholder="Password" id="password" name="password">
            <input type="password" placeholder="Confirm password" id="password" name="passwordconfirm">
            <div class="errorMessage"><?php include '../../private/php_tools/signupbackend.php' ?></div>
            <input type="submit" value="Sign Up" id="submit" name="submit">
        </form>
        <div class="shadow"></div>

<footer>

</footer>
</body>
</html>
