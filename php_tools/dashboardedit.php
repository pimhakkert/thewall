<?php
foreach($results as $image_results){
    $sql2 = "SELECT id FROM images WHERE image_name = ?";
    $sth = $database->prepare($sql2);
    $sth->execute([$image_results['image_name']]);
    $imageID = $sth->fetchColumn();
    $_POST['imageId']=$imageID;
    $sql2 = "SELECT tags.tag_name FROM tags  LEFT JOIN image_tags  ON tags.tag_id = image_tags.tag_id WHERE image_tags.image_id = ?";
    $tagArray = array();
    $sth = $database->prepare($sql2);
    $sth->execute([$imageID]);
    $tagArray = $sth->fetchAll(PDO::FETCH_COLUMN);
    ?>
    <div class="dashboardItem"><h4 class="dashboardPostTitle"><?php echo $image_results['image_title'];?></h4><h4 class="dashboardPostUploadDate"><?php $imageDate = $image_results['image_date'];
            $goodDate = date("d-m-Y", strtotime($imageDate)); echo $goodDate;?></h4><button class="dashboardEditButton modalButton">Edit</button>
        <form class="modalContent" method="post">
            <div class="modalItemTitle">
                <label for="title">Title:</label>
                <input type="text" name="title" value="<?php echo $image_results['image_title'];?>">
            </div>
            <div class="modalItemRight">
                <div class="modalItemImg">
                    <img src="images/<?php echo $image_results['image_name'];?>"alt="Picture: <?php echo $image_results['image_title'];?>">
                </div>
            </div>
            <div class="modalItemLeft">
                <textarea name="description" class="modalItemDesc"><?php echo $image_results['image_description'];?></textarea>
                <h3 class="modalItemOwner">Uploaded by:<br><?php echo $username;?></h3>
                <h6 class="modalItemDate"><?php echo $image_results['image_date'];?></h6>
                <div class="modalItemTags"> <?php for($i=0;$i<sizeof($tagArray);$i++){ ?>
                        <a class="modalItemTags" href="index.php?tag=<?php echo $tagArray[$i]; ?>">
                            <?php echo $tagArray[$i]; ?>
                        </a>
                    <?php } ?>
                </div>
                <div style="grid-row: 12; grid-column: 2; display: flex;margin-top: 1em;">
                    <input type="submit" name="submit3" style="flex-grow: 1;">
                    <button class="dashboardEditButton" style="justify-self: flex-end">Delete</button>
                </div>
            </div>
        </form>
    </div>
<?php } ?>

<?php
if($_SERVER['REQUEST_METHOD']==='POST'&&isset($_POST['submit3'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $id = $_POST['imageId'];
    $sql = "UPDATE images SET image_title = ?, image_description = ? WHERE id = ?";
    $sth = $database->prepare($sql);
    $sth->execute([$title,$description,$id]);
    echo '<script>location.href="index.php";</script>';
}
?>
