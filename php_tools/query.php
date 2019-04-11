<?php
if(isset($_GET['order'])&&$_GET['order']=='DESC'){
    $order = 'DESC';
}
else if(isset($_GET['order'])&&$_GET['order']=='ASC'){
    $order = 'ASC';
}
else {
    $order = 'DESC';
}

if($order == 'ASC'){
    if(isset($_GET['tag'])){
        $tagName = $_GET['tag'];
        $sql = "SELECT tag_id FROM tags WHERE UPPER(tag_name) = UPPER(?)";
        $sth = $database->prepare($sql);
        $sth->execute([$tagName]);
        $result = $sth->fetchAll();
        foreach ($result as $tag_results) {
            $sqlsss = "SELECT * FROM images  LEFT JOIN image_tags  ON images.id = image_tags.image_id WHERE UPPER(image_tags.tag_id) = UPPER(?) ORDER BY image_date ASC";
            $sth = $database->prepare($sqlsss);
            $sth->execute([$tag_results['tag_id']]);
            $resultss = $sth->fetchAll();
            foreach ($resultss as $image_results){
                include('display.php');
            }
        }
    }
    elseif(isset($_GET['user'])){
        $userName = '%'.$_GET['user'].'%';
        $sql = "SELECT * FROM images LEFT JOIN users  ON images.user_id = users.id WHERE UPPER(users.user_name) LIKE UPPER(?) ORDER BY image_date ASC";
        $sth = $database->prepare($sql);
        $sth->execute([$userName]);
        $results = $sth->fetchAll();
        foreach ($results as $image_results){
            include('display.php');
        }
    }
    elseif(isset($_GET['title'])){
        $title = '%'.$_GET['title'].'%';
        $sql = "SELECT * FROM images WHERE UPPER(image_title) LIKE UPPER('%'?'%') ORDER BY image_date ASC";
        $sth = $database->prepare($sql);
        $sth->execute([$title]);
        $results = $sth->fetchAll();
        foreach ($results as $image_results){
            include('display.php');
        }
    }
    else {
        $sql = "SELECT * FROM images ORDER BY image_date ASC";
        $sth = $database->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll();
        foreach ($result as $image_results) {
            include('display.php');
        }
    }
}
else {
    if(isset($_GET['tag'])){
        $tagName = $_GET['tag'];
        $sql = "SELECT tag_id FROM tags WHERE UPPER(tag_name) = UPPER(?)";
        $sth = $database->prepare($sql);
        $sth->execute([$tagName]);
        $result = $sth->fetchAll();
        foreach ($result as $tag_results) {
            $sqlsss = "SELECT * FROM images  LEFT JOIN image_tags  ON images.id = image_tags.image_id WHERE UPPER(image_tags.tag_id) = UPPER(?) ORDER BY image_date DESC";
            $sth = $database->prepare($sqlsss);
            $sth->execute([$tag_results['tag_id']]);
            $resultss = $sth->fetchAll();
            foreach ($resultss as $image_results){
                include('display.php');
            }
        }
    }
    elseif(isset($_GET['user'])){
        $userName = '%'.$_GET['user'].'%';
        $sql = "SELECT * FROM images LEFT JOIN users  ON images.user_id = users.id WHERE UPPER(users.user_name) LIKE UPPER(?) ORDER BY image_date DESC";
        $sth = $database->prepare($sql);
        $sth->execute([$userName]);
        $results = $sth->fetchAll();
        foreach ($results as $image_results){
            include('display.php');
        }
    }
    elseif(isset($_GET['title'])){
        $title = '%'.$_GET['title'].'%';
        $sql = "SELECT * FROM images WHERE UPPER(image_title) LIKE UPPER(?) ORDER BY image_date DESC";
        $sth = $database->prepare($sql);
        $sth->execute([$title]);
        $results = $sth->fetchAll();
        foreach ($results as $image_results){
            include('display.php');
        }
    }
    else {
        $sql = "SELECT * FROM images ORDER BY image_date DESC";
        $sth = $database->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll();
        foreach ($result as $image_results) {
            include('display.php');
        }
    }
}
