<?php
$imageID = $image_results['id'];
$userID = $image_results['user_id'];

//Get tag names
$sql2 = "SELECT tags.tag_name FROM tags  LEFT JOIN tags  ON tags.tag_name = image_tags.tag_id WHERE image_tags.image_id = ?";
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
?>
<div class="galleryItem">
    <img class="galleryItemImg modalButton" src="images/<?php echo $image_results['image_name']; ?>"alt="Picture: <?php echo $image_results['image_title']; ?>"/>
    <h3 class="galleryItemTitle"><?php echo $image_results['image_title'];?></h3>
    <div class="modalContent">
        <div class="modalItemTitle">
            <h1><?php echo $image_results['image_title'];?></h1>
        </div>
        <div class="modalItemRight">
            <div class="modalItemImg">
                <img src="images/<?php echo $image_results['image_name'];?>"alt="Picture: <?php echo $image_results['image_title'];?>">
            </div>
        </div>
        <div class="modalItemLeft">
            <p class="modalItemDesc"> <?php echo $image_results['image_description'];?></p>
            <h3 class="modalItemOwner">Uploaded by:<br><?php echo $username;?></h3>
            <h6 class="modalItemDate"><?php echo $image_results['image_date'];?></h6>
            <div class="modalItemTags"> <?php for($i=0;$i<sizeof($tagArray);$i++){ ?>
                    <a class="modalItemTags" href="index.php/search">
                        <?php echo $tagArray[$i];?>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>