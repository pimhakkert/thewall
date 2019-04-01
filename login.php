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
  <link rel="stylesheet" href="css/master.scss">
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
          <img class="navbarLogo" src="images/TheWallLogo.png"  onclick="location.href = 'index.php'" alt="">
          <button class="modalButton upload" id="uploadButton" type="button" name="button" style="margin-left: auto">Upload</button>
          <button type="button" name="button" onclick="location.href = 'login.php'">Login</button>
          <label for="toggleMenu" id="navHamburger">&#9776;</label>
          </nav>

          <form class="login" method="post" action="">
            <input type="text" placeholder="Username" id="username" name="username">
            <input type="password" placeholder="Password" id="password" name="password">
            <a href="#" class="forgot">forgot password?</a>
            <input type="submit" value="Sign In" id="submit">
            <input type="button" value="Sign Up" onclick="location.href = 'registratie.php'" id="submit2">
          </form>
      <?php
      $fields = array('username', 'password');
      $fieldnames = array('Username', 'Password');
      $error1 = false;
      $error2 = false;

      $username = null;
      $email = null;
      $password = null;
      $password_hash = null;

      if('POST' === $_SERVER['REQUEST_METHOD']){
          for($i=0;$i<sizeof($fields);$i++) {
              $field = $fields[$i];
              $fieldname = $fieldnames[$i];
              if(!isset($_POST[$field]) || empty($_POST[$field])) {
                  echo '<p id="error">'.$fieldname.' has not been filled in.</p>';
                  $error1 = true;
              }
          }
      }
      else {
          $error1 = true;
      }

      if(!$error1){
          $usernameInput = $_POST['username'];
          $passwordInput = $_POST['password'];
          $stmt = $database->prepare('SELECT * FROM users WHERE user_name=?');
          $stmt->bindParam(1, $usernameInput, PDO::PARAM_STR);
          $stmt->execute();
          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          if(!$row){
              echo '<p id="error">This account does not exist!</p>';
          }
          if($username){

          }
          else {

          }

//          $password = password_verify($passwordInput);
//          if()
      }

      if($error2){
          header("Location: index.php");
      }


      ?>
          <div class="shadow"></div>

<footer>

</footer>
  </div>
</body>
</html>
