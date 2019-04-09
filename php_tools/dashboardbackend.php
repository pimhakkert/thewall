<?php
$edit = false;
$error = false;
$errorsArray = array();
if('POST' === $_SERVER['REQUEST_METHOD']){

    if((isset($_POST['newUsername'])&&!empty($_POST['newUsername']))&&(isset($_POST['newEmail'])&&!empty($_POST['newEmail']))){
        $edit = true;
    }
    else{
        array_push($errorsArray,'<p id="dashboardError">Error: New username or email not filled in!</p>');
    }

    if(isset($_FILES["fileToUpload"]["name"])) {
        $target_dir = "profilepictures/";
        $target_file_pre = basename($_FILES["fileToUpload"]["name"]);
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $dbname = $_SESSION['username'].".".$imageFileType;
        $target_file = $target_dir.$dbname;


        if(isset($_POST["submit"])) {
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
            $insertSql = "UPDATE users SET profilepicture = LOWER(?) WHERE user_name = LOWER(?)";
            $database->prepare($insertSql)->execute([$dbname,$_SESSION['username']]);
        }
    }

    elseif ($edit) {
        $newUser = $_POST['newUsername'];
        $newEmail = $_POST['newEmail'];
        $newUser = filter_var($newUser,FILTER_SANITIZE_STRING);
        $newEmail = filter_var($newEmail,FILTER_SANITIZE_STRING);
        $sql = "SELECT id FROM users WHERE user_name = ?";
        $sth = $database->prepare($sql);
        $sth->execute([$username]);
        $userID = $sth->fetchColumn();

        if(/*username taken*/){

        }
        else {
            $insertSql = "UPDATE users SET user_name = ?, user_email = ?  WHERE user_name = ?";
            $database->prepare($insertSql)->execute([$newUser,$newEmail,$_SESSION['username']]);
            header('Location: php_tools/logoutbackend.php');
        }
    }
}
?>