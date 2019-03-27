<html lang="en">
<?php include 'settings.php';?>
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
  <link rel="stylesheet" href="css/master.css">
  <link rel="stylesheet" href="css/login.css">
</head>
<body>


<input type="checkbox" id="toggleMenu">
  <div class="wrapper">

      <nav class="upperNav" style="height: 5em; background-color: dimgrey">
          <label class="uploadButtonLabel" for="uploadButton">Upload</label>
          <input type="button" value="Login" onclick="location.href = 'login.php'">
      </nav>

      <nav class="customNavbar">
          <img class="navbarLogo" src="images/TheWallLogo.png" alt="">
          <button class="modalButton upload" id="uploadButton" type="button" name="button" style="margin-left: auto">Upload</button>
          <button type="button" name="button" onclick="location.href = 'login.php'">Login</button>
          <label for="toggleMenu" id="navHamburger" &#9776</label>
          </nav>




<div class="login">
    <input type="text" placeholder="Username" id="username">
  <input type="password" placeholder="Password" id="password">
  <a href="#" class="forgot">forgot password?</a>
  <input type="submit" value="Sign In">
  <input type="submit2" value="Sign Up">
</div>
<div class="shadow"></div>




<footer>

</footer>
  </div>
</body>
</html>
