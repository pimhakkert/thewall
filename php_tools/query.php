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
        if(!$result){
            echo("<script>location.href ='index.php?msg=error';</script>");
        }
        else {
            foreach ($result as $tag_results) {
                $sql = "SELECT * FROM images LEFT JOIN image_tags  ON images.id = image_tags.image_id WHERE UPPER(image_tags.tag_id) = UPPER(?) ORDER BY image_date ASC LIMIT ?,?";
                $sth = $database->prepare($sql);
                $sth->bindValue(1,$tag_results['tag_id'], PDO::PARAM_STR);
                $sth->bindValue(2,$offset, PDO::PARAM_INT);
                $sth->bindValue(3,$rowsperpage, PDO::PARAM_INT);
                $sth->execute();
                $resultss = $sth->fetchAll();
                foreach ($resultss as $i=>$image_results){
                    include('display.php');
                }
            }
        }
    }
    elseif(isset($_GET['user'])){
        $userName = '%'.$_GET['user'].'%';
        $sql = "SELECT * FROM images LEFT JOIN users  ON images.user_id = users.id WHERE UPPER(users.user_name) LIKE UPPER(?) ORDER BY image_date ASC LIMIT ?,?";
        $sth = $database->prepare($sql);
        $sth->bindValue(1,$userName, PDO::PARAM_STR);
        $sth->bindValue(2,$offset, PDO::PARAM_INT);
        $sth->bindValue(3,$rowsperpage, PDO::PARAM_INT);
        $sth->execute();
        $results = $sth->fetchAll();
        if(!$results){
            echo("<script>location.href ='index.php?msg=error';</script>");
        }
        else {
            foreach ($results as $i=>$image_results){
                include('display.php');
            }
        }
    }
    elseif(isset($_GET['title'])){
        $title = '%'.$_GET['title'].'%';
        $sql = "SELECT * FROM images WHERE UPPER(image_title) LIKE UPPER(?) ORDER BY image_date ASC LIMIT ?,?";
        $sth = $database->prepare($sql);
        $sth->bindValue(1,$title, PDO::PARAM_STR);
        $sth->bindValue(2,$offset, PDO::PARAM_INT);
        $sth->bindValue(3,$rowsperpage, PDO::PARAM_INT);
        $sth->execute();
        $results = $sth->fetchAll();
        if(!$results){
            echo("<script>location.href ='index.php?msg=error';</script>");
        }
        else {
            foreach ($results as $i=>$image_results){
                include('display.php');
            }
        }
    }
    else {
        $sql = "SELECT * FROM images ORDER BY image_date ASC LIMIT ?,?";
        $sth = $database->prepare($sql);
        $sth->bindValue(1,$offset, PDO::PARAM_INT);
        $sth->bindValue(2,$rowsperpage, PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->fetchAll();
        foreach ($result as $i=>$image_results) {
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
        if(!$result){
            echo("<script>location.href ='index.php?msg=error';</script>");
        }
        else{
            foreach ($result as $tag_results) {
                $sql = "SELECT * FROM images LEFT JOIN image_tags  ON images.id = image_tags.image_id WHERE UPPER(image_tags.tag_id) = UPPER(?) ORDER BY image_date DESC LIMIT ?,?";
                $sth = $database->prepare($sql);
                $sth->bindValue(1,$tag_results['tag_id'], PDO::PARAM_STR);
                $sth->bindValue(2,$offset, PDO::PARAM_INT);
                $sth->bindValue(3,$rowsperpage, PDO::PARAM_INT);
                $sth->execute();
                $resultss = $sth->fetchAll();
                foreach ($resultss as $i=>$image_results){
                    include('display.php');
                }
            }
        }
    }
    elseif(isset($_GET['user'])){
        $userName = '%'.$_GET['user'].'%';
        $sql = "SELECT * FROM images LEFT JOIN users  ON images.user_id = users.id WHERE UPPER(users.user_name) LIKE UPPER(?) ORDER BY image_date DESC LIMIT ?,?";
        $sth = $database->prepare($sql);
        $sth->bindValue(1,$userName, PDO::PARAM_STR);
        $sth->bindValue(2,$offset, PDO::PARAM_INT);
        $sth->bindValue(3,$rowsperpage, PDO::PARAM_INT);
        $sth = $database->prepare($sql);
        $sth->execute();
        $results = $sth->fetchAll();
        if(!$results){
            echo("<script>location.href ='index.php?msg=error';</script>");
        }
        else {
            foreach ($results as $i=>$image_results){
                include('display.php');
            }
        }
    }
    elseif(isset($_GET['title'])){
        $title = '%'.$_GET['title'].'%';
        $sql = "SELECT * FROM images WHERE UPPER(image_title) LIKE UPPER(?) ORDER BY image_date DESC LIMIT ?,?";
        $sth = $database->prepare($sql);
        $sth->bindValue(1,$title, PDO::PARAM_STR);
        $sth->bindValue(2,$offset, PDO::PARAM_INT);
        $sth->bindValue(3,$rowsperpage, PDO::PARAM_INT);
        $sth->execute();
        $results = $sth->fetchAll();
        if(!$results){
            echo("<script>location.href ='index.php?msg=error';</script>");
        }
        else {
            foreach ($results as $i=>$image_results){
                include('display.php');
            }
        }
    }
    else {
        $sql = "SELECT * FROM images ORDER BY image_date DESC LIMIT ?,?";
        $sth = $database->prepare($sql);
        $sth->bindValue(1,$offset, PDO::PARAM_INT);
        $sth->bindValue(2,$rowsperpage, PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->fetchAll();
        foreach ($result as $i=>$image_results) {
            include('display.php');
        }
    }
}
?>