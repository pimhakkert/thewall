<html lang="en">
<?php include 'php_tools/settings.php';?>
<head>
    <title>Admin Login</title>
    <meta charset="utf-8">
    <meta name="author" content="Pim Hakkert, Rai Griffioen, Casper Matauschek">
    <link rel="stylesheet" href="css/bootstrap-grid.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.css">
    <script src="js/bootstrp.js"></script>
    <script src="js/jquery-3.3.1.min.js"></script>
</head>
<body>
<form method="post" action="adminpage.php">
    <label for="password">Admin Password: </label>
    <input name="password" type="password">
    <input type="submit" name="submit">
</form>
</body>
</html>