<?php
$sql = "SELECT * FROM images";
foreach ($database->query($sql) as $image_results) {
    $imageID = $image_results['id'];
    $userID = $image_results['user_id'];
    $username;
    $sql2 = "SELECT tag_id FROM image_tags WHERE image_id = $imageID";
    $tagArray = array();
    //Need to change this to prepared statements. Possible database linking???
    foreach($database->query($sql2) as $tagId_results) {
        $tagID = $tagId_results['tag_id'];
        $sql3 = "SELECT tag_name FROM tags WHERE tag_id = $tagID";
        foreach ($database->query($sql3) as $tagName_results) {
            $tagName = $tagName_results['tag_name'];
            array_push($tagArray,$tagName);
        }
    }
    //Comment End
    $sql4 = "SELECT user_name FROM users WHERE id = $userID";
    foreach ($database->query($sql4) as $username_results) {
        $username = $username_results['user_name'];
    }
    ?>
    <div class="galleryItem">
        <img class="galleryItemImg modalButton" src="images/<?php echo $image_results['image_name']; ?>"alt="Picture: <?php echo $image_results['image_title']; ?>"/>
        <h3 class="galleryItemTitle"><?php echo $image_results['image_title'];?></h3>
        <div class="modalContent">
            <h1 class="modalItemTitle"><?php echo $image_results['image_title'];?></h1>
            <img class="modalItemImg" src="images/<?php echo $image_results['image_name'];?>"alt="Picture: <?php echo $image_results['image_title'];?>">
            <p class="modalItemDesc"> <?php echo $image_results['image_description'];?></p>
            <h3 class="modalItemOwner"><?php echo $username;?></h3>
            <h6 class="modalItemDate"><?php echo $image_results['image_date'];?></h6>
            <!--               Need to finish search functionality for following for loop to be completed.-->
            <?php for($i=0;$i<sizeof($tagArray);$i++){ ?>
                <a class="modalItemTags" href="index.php/search">
                    <?php echo $tagArray[$i];?>
                </a>
            <?php } ?>
        </div>
    </div>
<?php } ?>