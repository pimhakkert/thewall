<?php
$imageID = $image_results['id'];
$userID = $image_results['user_id'];
$imageDate = $image_results['image_date'];
$goodDate = date("d-m-Y", strtotime($imageDate));

//Get tag names
$sql2 = "SELECT tags.tag_name FROM tags  LEFT JOIN image_tags  ON tags.tag_id = image_tags.tag_id WHERE image_tags.image_id = ?";
$tagArray = array();
$sth = $database->prepare($sql2);
$sth->execute([$imageID]);
$tagArray = $sth->fetchAll(PDO::FETCH_COLUMN);

//Get owner name
$sql3 = "SELECT user_name FROM users WHERE id = ?";
$sth2 = $database->prepare($sql3);
$sth2->execute([$userID]);
$username = null;
$username = $sth2->fetchColumn();

$sql4 = "SELECT vote FROM image_votes WHERE image_id = ?";
$sth3 = $database->prepare($sql4);
$sth3->execute([$imageID]);
$vote = $sth3->fetchColumn();
$upvoteResult = null;
$downvoteResult = null;
//if upvote, change upvote, if downvote, change downvote. Else, just do clear
switch($vote){
    case 1:
        $upvoteResult = 'galleryItemUpvoted';
        $downvoteResult = 'galleryItemDownvoteClear';
        break;
    case -1:
        $downvoteResult = 'galleryItemDownvoted';
        $upvoteResult = 'galleryItemUpvoteClear';
        break;
    case 0:
        $downvoteResult = 'galleryItemDownvoteClear';
        $upvoteResult = 'galleryItemUpvoteClear';
        break;
}

$user = '';
if(isset($_SESSION['username'])){
    $user = $_SESSION['username'];
}

?>
<div class="galleryItem">
    <img class="galleryItemImg" src="images/<?php echo $image_results['image_name']; ?>" alt="Picture: <?php echo $image_results['image_title']; ?>"/>
    <h3 class="galleryItemTitle"><?php echo $image_results['image_title']; ?></h3>
    <div class="galleryItemScore modalButton">
        <div class="galleryItemUpvoteClear" <?php echo "id='upvote".$imageID."'"; ?> onclick="scoreImage(<?php echo $imageID.","."'".$user."'"; ?>,'up')"></div>
        <p class="galleryItemScoreText" <?php echo "id='scoreText".$imageID."'"; ?>> <?php echo $image_results['score']; ?></p>
        <div class=<?php echo "'".$downvoteResult."'"; ?><?php echo "id='downvote".$imageID."'"; ?> onclick="scoreImage(<?php echo $imageID.","."'".$user."'"; ?>,'down')"></div>
    </div>
    <div class="modalContent">
        <div class="modalItemTitle">
            <h1><?php echo $image_results['image_title'];?></h1>
        </div>
        <div class="modalItemRight">
            <div class="modalItemImg">
                <img src="images/<?php echo $image_results['image_name']; ?>" alt="Picture: <?php echo $image_results['image_title']; ?>">
            </div>
        </div>
        <div class="modalItemLeft">
            <p class="modalItemDesc"> <?php echo $image_results['image_description']; ?></p>
            <h3 class="modalItemOwner">Uploaded by:<br><?php echo $username; ?></h3>
            <h6 class="modalItemDate"><?php echo $goodDate;?></h6>
            <div class="modalItemTags"> <?php for($i=0;$i<sizeof($tagArray);$i++){ ?>
                    <a class="modalItemTags" href="index.php?tag=<?php echo $tagArray[$i]; ?>">
                        <?php echo $tagArray[$i]; ?>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
