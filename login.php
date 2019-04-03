<?php session_start(); ?>
<html lang="en">
<?php include 'php_tools/settings.php';?>
<head>
  <title>The Wall</title>
  <meta charset="utf-8">
  <meta name="author" content="Pim Hakkert, Rai Griffioen, Casper Matauschek">
    <meta name="viewport" content="user-scalable=no, width=device-width">
  <link rel="stylesheet" href="css/bootstrap.css" >
  <link rel="stylesheet" href="css/bootstrap-grid.css">
  <link rel="stylesheet" href="css/bootstrap-reboot.css">
  <link rel="icon" href="images/TheWallLogo.png">
  <script src="js/bootstrap.js"></script>
  <script src="js/jquery-3.3.1.min.js"></script>
  <link rel="stylesheet" href="css/master2.scss">
  <link rel="stylesheet" href="css/login.css">

</head>
<body>


<input type="checkbox" id="toggleMenu">
  <div class="wrapper">

      <nav class="customNavbar">
          <img class="navbarLogoImg" src="images/TheWallLogo.png" style="margin-bottom: 0.5em"  onclick="location.href = 'index.php'" alt="">
          <label for="toggleMenu" id="navHamburger">&#9776;</label>
          </nav>

          <form class="login" method="post" action="">
            <input type="text" placeholder="Username" id="username" name="username">
            <input type="password" placeholder="Password" id="password" name="password">
            <a href="#" class="forgot">forgot password?</a>
            <?php include 'php_tools/loginbackend.php'; ?>
            <input type="submit" value="Sign In" id="submit">
            <input type="button" value="Sign Up" onclick="location.href = 'registratie.php'" id="submit2">
          </form>

          <div class="shadow"></div>

<footer>

</footer>
  </div>
</body>
</html>
