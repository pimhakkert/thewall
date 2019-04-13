<?php
include "settings.php";
if('POST' === $_SERVER['REQUEST_METHOD']){
    //declare variables
    $imageID = $_POST['imageId'];
    $user = $_POST['user'];
    $scoreIncrease = $_POST['scoreIncrease'];
    $proceed = false;
    $finalSql = null;

    //get user ID
    $userSql = "SELECT id FROM users where user_name = ?";
    $userstm = $database->prepare($userSql);
    $userstm->execute([$user]);
    $userID = $userstm->fetchColumn();

    //get image_votes data
    $userCheckSql = "SELECT * from image_votes WHERE image_id = ? AND user_id = ?";
    $userCheck = $database->prepare($userCheckSql);
    $userCheck->execute([$imageID,$userID]);
    $isUser = $userCheck->fetch();

    //get score from image id
    $scoreSql = "SELECT score FROM images where id = ?";
    $scorestm = $database->prepare($scoreSql);
    $scorestm->execute([$imageID]);
    $result = $scorestm->fetchColumn();

    if(!$isUser){
       $voteSql = "INSERT INTO image_votes VALUES (?,?,?)";
       $votestm = $database->prepare($voteSql);
       $votestm->execute([$imageID,$userID,0]);
    }

    if($scoreIncrease == 'true'){
        Upvote();
    }
    elseif($scoreIncrease == 'false'){
        Downvote();
    }
    else {
        echo "error";
    }
}

function Upvote(){
    global $result,$finalSql,$imageID,$database;
    if($result==-1){
        $insert = $result+2;
        echo 'upvoteDouble';

        $voteSql = "UPDATE image_votes SET vote = ? WHERE image_id = ?";
        $stm = $database->prepare($voteSql);
        $stm->execute([1,$imageID]);

        $finalSql = "UPDATE images SET score = ? WHERE id = ?";
        $stm = $database->prepare($finalSql);
        $stm->execute([$insert,$imageID]);
    }
    elseif($result==0){
        $insert = $result+1;
        echo 'upvote';

        $voteSql = "UPDATE image_votes SET vote = ? WHERE image_id = ?";
        $stm = $database->prepare($voteSql);
        $stm->execute([1,$imageID]);

        $finalSql = "UPDATE images SET score = ? WHERE id = ?";
        $stm = $database->prepare($finalSql);
        $stm->execute([$insert,$imageID]);
    }
    elseif($result==1){
        $insert = $result-1;
        echo 'upvoteBack';

        $voteSql = "UPDATE image_votes SET vote = ? WHERE image_id = ?";
        $stm = $database->prepare($voteSql);
        $stm->execute([0,$imageID]);

        $finalSql = "UPDATE images SET score = ? WHERE id = ?";
        $stm = $database->prepare($finalSql);
        $stm->execute([$insert,$imageID]);
    }
}

function Downvote(){
    global $result,$finalSql,$imageID,$database;
    if($result==1){
        $insert = $result-2;
        echo 'downvoteDouble';
        $voteSql = "UPDATE image_votes SET vote = ? WHERE image_id = ?";
        $stm = $database->prepare($voteSql);
        $stm->execute([-1,$imageID]);

        $finalSql = "UPDATE images SET score = ? WHERE id = ?";
        $stm = $database->prepare($finalSql);
        $stm->execute([$insert,$imageID]);
    }
    elseif($result==0){
        $insert = $result-1;
        echo 'downvote';
        $voteSql = "UPDATE image_votes SET vote = ? WHERE image_id = ?";
        $stm = $database->prepare($voteSql);
        $stm->execute([-1,$imageID]);

        $finalSql = "UPDATE images SET score = ? WHERE id = ?";
        $stm = $database->prepare($finalSql);
        $stm->execute([$insert,$imageID]);
    }
    elseif($result==-1){
        $insert = $result+1;
        echo 'downvoteBack';

        $voteSql = "UPDATE image_votes SET vote = ? WHERE image_id = ?";
        $stm = $database->prepare($voteSql);
        $stm->execute([0,$imageID]);

        $finalSql = "UPDATE images SET score = ? WHERE id = ?";
        $stm = $database->prepare($finalSql);
        $stm->execute([$insert,$imageID]);
    }
}

?>