<?php

$fields = array('modalUploadTitle', 'modalUploadDescription', 'modalUploadTags');
$fieldnames = array('Title', 'Description', 'Tags');
$errorArray = array();
$error1 = false;
$error2 = false;

$title = null;
$desc = null;
$tags = null;

if('POST' === $_SERVER['REQUEST_METHOD']){
    for($i=0;$i<sizeof($fields);$i++) {
        $field = $fields[$i];
        $fieldname = $fieldnames[$i];
        if(!isset($_POST[$field]) || empty($_POST[$field])) {

            array_push($errorArray,$fieldname.' has not been filled in.');
            $error1 = true;
        }
    }
    $title = $_POST['modalUploadTitle'];
    $desc = $_POST['modalUploadDescription'];
    $tags = $_POST['modalUploadTags'];
}
else {
    $error1 = true;
}

if(!$error1) {
        $target_dir = "images/";
        $target_file_pre = basename($_FILES["fileToUpload"]["name"]);
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $dbname = basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                array_push($errorArray,"File is not an image.");
                $error2 = true;
                $uploadOk = 0;
            }
        }
        if (file_exists($target_file)) {
            $extension = pathinfo($target_file,PATHINFO_EXTENSION);
            $timestamp = time().".";
            $dbname = $timestamp . $extension;
            $target_file = $target_dir . $timestamp . $extension;
        }

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            array_push($errorArray,"Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
            $error2 = true;
            $uploadOk = 0;
        }
        if ($_FILES["fileToUpload"]["size"] > 7500000) {
            array_push($errorArray,"Sorry, images (including GIF's) can't be bigger than 7.5 MB.");
            $error2 = true;
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            array_push($errorArray,"Sorry, your file was not uploaded.");
            $error2 = true;
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                if ($_FILES["fileToUpload"]["size"] > 500000&&$imageFileType!="gif") {
                    $newFile = "images/".$target_file_pre;
                    $d = compress($target_file, $newFile, 70);
                    $target_file = $newFile;
                }
            } else {
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
            $safe_fileName = $dbname;
            $imageRawSize = filesize($target_file);
            $imageSize = $imageRawSize / 1000000 . " MB";
            $imageDate = date("Y/m/d H:i:s");
            $insertSql = "INSERT into images (image_name, image_size, image_date, user_id, image_title, image_description) VALUES (?,?,?,?,?,?)";
            $database->prepare($insertSql)->execute([$safe_fileName, $imageSize,$imageDate,$userID,$safe_title,$safe_desc]);
            $imageID = $database->lastInsertId();
            $tagArray = explode(',', $tags);
            $tagSQL = "INSERT into tags (tag_name) VALUES (?)";
            $tagIdSQL = "INSERT into image_tags (image_id, tag_id) VALUES (?,?)";

            foreach($tagArray as $tag) {
                $database->prepare($tagSQL)->execute([$tag]);
                $tagID = $database->lastInsertId();
                $database->prepare($tagIdSQL)->execute([$imageID,$tagID]);
            }
        }

}

function compress($source, $destination, $quality) {

    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg')
        $image = imagecreatefromjpeg($source);
    elseif ($info['mime'] == 'image/png')
        $image = imagecreatefrompng($source);
    imagejpeg($image, $destination, $quality);
    return $destination;
}

?>