<?php
include "settings.php";
if('POST' === $_SERVER['REQUEST_METHOD']){
    //declare variables
    $imageID = $_POST['imageId'];
    $user = $_POST['user'];
    $scoreIncrease = $_POST['scoreIncrease'];
    $start = null;

    $sql = "INSERT INTO image_votes VALUES (?, ?, ?)";

    //check if user upvotes or downvotes through ajax
    if($scoreIncrease == 'true'){
        $scoreIncrease = true;
    }
    else {
        $scoreIncrease = false;
    }


    //get user ID
    $userSql = "SELECT id FROM users where user_name = ?";
    $userstm = $database->prepare($userSql);
    $userstm->execute([$user]);
    $userID = $userstm->fetchColumn();

    //get image_votes data
    $userCheckSql = "SELECT * from image_votes WHERE user_id = ?";
    $userCheck = $database->prepare($userCheckSql);
    $userCheck->execute([$userID]);
    $isUser = $userCheck->fetch();

    //get score from image id
    $scoreSql = "SELECT score FROM images where id = ?";
    $scorestm = $database->prepare($scoreSql);
    $scorestm->execute([$imageID]);
    $result = $scorestm->fetchColumn();

    $scoreNumber = null;
    if($scoreIncrease){
        $scoreNumber = $result+1;
    }
    elseif (!$scoreIncrease){
        $scoreNumber = $result-1;
    }

    //if there's already an upvote from this user on this image, deny access. The same happens for downvotes.
    if($isUser){
        if ($scoreIncrease){
            if($isUser['vote']==1){
                echo 'upvote';
            }
            elseif($isUser['vote']==0){
                //set vote to 1
                $sql = "UPDATE image_votes SET vote = true";
                $scoreNumber = $result+2;
                $start = true;
            }
        }
        elseif (!$scoreIncrease){
            if($isUser['vote']==1){
                //set vote to 0
                $sql = "UPDATE image_votes SET vote = false";
                $scoreNumber = $result-2;
                $start = true;
            }
            elseif($isUser['vote']==0){
                echo 'downvote';
            }
        }
    }
    else {
        $start = true;
    }

    //If everything is okay, run statement to add or subtract score and edit image_votes

    if($start){
        $sth = $database->prepare($sql);
        $sth->execute([$imageID,$userID,$scoreIncrease]);

        $imageSql = "UPDATE images SET score = ? WHERE id = ?";
        $imagesth = $database->prepare($imageSql);
        $imagesth->execute([$scoreNumber,$imageID]);
    }
}
?>