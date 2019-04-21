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
  <link rel="stylesheet" href="css/master2.css">
  <link rel="stylesheet" href="css/login.css">
  <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
</head>
<body>
<input type="checkbox" id="toggleMenu">
  <div class="wrapper">
      <nav class="customNavbar">
          <div class="navbarLogo"><a href="index.php"><img class="navbarLogoImg" src="site_images/TheWallLogo.png" alt=""></a></div>
          <label for="toggleMenu" id="navHamburger">&#9776;</label>
      </nav>
          <form autocomplete="off" class="login" method="post" action="">
            <input type="text" placeholder="Username" id="username" name="username">
            <input type="password" placeholder="Password" id="password" name="password">
            <a href="#" class="forgot">forgot password?</a>
              <div class="errorMessage"><?php include '../../private/php_tools/loginbackend.php'; ?></div>
            <input type="submit" value="Sign In" id="submit">
            <input type="button" value="Sign Up" onclick="location.href = 'registratie.php'" id="submit2">
          </form>
          <div class="shadow"></div>
<footer>
</footer>
  </div>
</body>
</html>
