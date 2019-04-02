<?php

$fields = array('modalUploadTitle', 'modalUploadDescription', 'modalUploadTags');
$fieldnames = array('Title', 'Description', 'Tags');
$error1 = false;
$error2 = false;

$title = null;
$desc = null;
$tags = null;

if('POST' === $_SERVER['REQUEST_METHOD'] && isset($_SESSION['username'])){
    for($i=0;$i<sizeof($fields);$i++) {
        $field = $fields[$i];
        $fieldname = $fieldnames[$i];
        if(!isset($_POST[$field]) || empty($_POST[$field])) {
            echo '<p id="error">'.$fieldname.' has not been filled in.</p>';
            $error1 = true;
        }
    }
    $title = $_POST['modalUploadTitle'];
    $desc = $_POST['modalUploadDescription'];
}
else {
    $error1 = true;
    header("Location: ../index.php");
}

if(!$error1) {
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $error2 = true;
            $uploadOk = 0;
        }
    }

    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $error2 = true;
        $uploadOk = 0;
    }

    if ($_FILES["fileToUpload"]["size"] > 10000000) {
        echo "Sorry, your file is too large.";
        $error2 = true;
        $uploadOk = 0;
    }

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $error2 = true;
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        $error2 = true;
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        } else {
            echo "Sorry, there was an error uploading your file.";
            $error2 = true;
        }
    }

    if(!$error2){
        $username = $_SESSION['username'];
        $sql = "SELECT id FROM users WHERE user_name = ?";
        $sth = $database->prepare($sql);
        $sth->execute([$username]);
        $userID = $sth->fetchColumn();

        $safe_title = filter_var($title, FILTER_SANITIZE_STRING);
        $safe_desc = filter_var($desc, FILTER_SANITIZE_STRING);
        $safe_tags = filter_var($tags, FILTER_SANITIZE_STRING);
        $safe_fileName = basename( $_FILES['fileToUpload']['name']);
        echo $safe_fileName;
        $imageRawSize = filesize($target_file);
        $imageSize = $imageRawSize / 1000000 . " MB";
        $imageDate = date("d/m/Y");
        $insertSql = "INSERT into images (image_name, image_size, image_date, user_id, image_title, image_description) VALUES (?,?,?,?,?,?)";
        $database->prepare($insertSql)->execute([$safe_fileName, $imageSize,$imageDate,$userID,$safe_title,$safe_desc]);
    }
}
?>