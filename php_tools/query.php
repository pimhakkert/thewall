<?php
if(isset($_GET['tag'])){
    $tagName = $_GET['tag'];
    $sql = "SELECT tag_id FROM tags WHERE tag_name = ?";
    $sth = $database->prepare($sql);
    $sth->execute([$tagName]);
    $result = $sth->fetchAll();
    foreach ($result as $tag_results) {
        $sqlsss = "SELECT * FROM images  LEFT JOIN image_tags  ON images.id = image_tags.image_id WHERE image_tags.tag_id = ?";
        $sth = $database->prepare($sqlsss);
        $sth->execute([$tag_results['tag_id']]);
        $resultss = $sth->fetchAll();
        foreach ($resultss as $image_results){
            include('display.php');
        }
    }
}
elseif(isset($_GET['user'])){
    $userName = $_GET['user'];
    $sql = "SELECT * FROM images LEFT JOIN users  ON images.user_id = users.id WHERE users.user_name = ?";
    $sth = $database->prepare($sql);
    $sth->execute([$userName]);
    $results = $sth->fetchAll();
    foreach ($results as $image_results){
        include('display.php');
    }
}
else {
    $sql = "SELECT * FROM images";
    $sth = $database->prepare($sql);
    $sth->execute();
    $result = $sth->fetchAll();
    foreach ($result as $image_results) {
        include('display.php');
    }
}