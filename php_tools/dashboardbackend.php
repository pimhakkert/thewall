<?php
$edit = true;
$error = false;
$errorsArray = array();

$username = $_SESSION['username'];
$sql = "SELECT * FROM images INNER JOIN users ON images.user_id = users.id WHERE user_name = ?";
$sth = $database->prepare($sql);
$sth->execute([$username]);
$results = $sth->fetchAll(PDO::FETCH_ASSOC);


if('POST' === $_SERVER['REQUEST_METHOD']){

    if(isset($_POST['submit1'])) {
        $target_dir = "profilepictures/";
        $target_file_pre = basename($_FILES["fileToUpload"]["name"]);
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $dbname = $_SESSION['username'].".".$imageFileType;
        $target_file = $target_dir.$dbname;


        if(isset($_POST["submit1"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $error = true;
                $uploadOk = 0;
            }
        }

        if ($_FILES["fileToUpload"]["size"] > 10000000) {
            echo "Sorry, your file is too large.";
            $error = true;
            $uploadOk = 0;
        }

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo "Sorry, only JPG, JPEG & PNG files are allowed.";
            $error = true;
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            $error = true;
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            } else {
                echo "Sorry, there was an error uploading your file.";
                $error = true;
            }
        }

        if(!$error){
            $insertSql = "UPDATE users SET profilepicture = ? WHERE user_name = ?";
            $database->prepare($insertSql)->execute([$dbname,$_SESSION['username']]);
        }
    }

    elseif (isset($_POST['submit2'])) {
        $error2 = false;
        $newUser = $_POST['newUsername'];
        $newEmail = $_POST['newEmail'];
        $newUser = filter_var($newUser,FILTER_SANITIZE_STRING);
        $newEmail = filter_var($newEmail,FILTER_SANITIZE_STRING);

        $stmt0 = $database->prepare('SELECT * FROM users WHERE user_name=?');
        $stmt0->execute([$_SESSION['username']]);
        $userStuff = $stmt0->fetch(PDO::FETCH_ASSOC);

        $stmt = $database->prepare('SELECT user_name FROM users WHERE user_name=?');
        $stmt->execute([$newUser]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt2 = $database->prepare('SELECT user_email FROM users WHERE user_email=?');
        $stmt2->execute([$newEmail]);
        $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
        if($row&&strtoupper($userStuff['user_name'])!=strtoupper($_SESSION['username'])){
            array_push($errorsArray,'<p id="error">This username is already used!</p>');
            $error2 = true;
        }
        if($row2&&strtoupper($userStuff['user_email'])!=strtoupper($newEmail)){
            array_push($errorsArray,'<p id="dashboardError">This e-mail address is already used!</p>');
            $error2 = true;
        }
        if(!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
            array_push($errorsArray,'<p id="error">This e-mail address isn\'t real!</p>');
            $error2 = true;
        }

        if($error2){
            echo 'Error';
        }
        else {
            $insertSql = "UPDATE users SET user_name = ?, user_email = ?  WHERE user_name = ?";
            $database->prepare($insertSql)->execute([$newUser,$newEmail,$_SESSION['username']]);
            header('Location: php_tools/logoutbackend.php');
        }
    }
}
?>