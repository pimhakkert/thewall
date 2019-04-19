<?php
if(isset($_GET['order'])&&$_GET['order']=='DESC'){
    $order = 'DESC';
}
else if(isset($_GET['order'])&&$_GET['order']=='ASC'){
    $order = 'ASC';
}
else if(isset($_GET['order'])&&$_GET['order']=='SLH'){
    $order = 'SLH';
}
else if(isset($_GET['order'])&&$_GET['order']=='SHL'){
    $order = 'SHL';
}
else{
    $order = 'random';
}

$execute = false;

if($order == 'ASC'){
    $execute = true;
    $sql1 = "SELECT * FROM images LEFT JOIN image_tags  ON images.id = image_tags.image_id WHERE UPPER(image_tags.tag_id) = UPPER(?) ORDER BY image_date ASC LIMIT ?,?";
    $sql2 = "SELECT * FROM images LEFT JOIN users  ON images.user_id = users.id WHERE UPPER(users.user_name) LIKE UPPER(?) ORDER BY image_date ASC LIMIT ?,?";
    $sql3 = "SELECT * FROM images WHERE UPPER(image_title) LIKE UPPER(?) ORDER BY image_date ASC LIMIT ?,?";
    $sql4 = "SELECT * FROM images ORDER BY image_date ASC LIMIT ?,?";
}
elseif($order== 'DESC') {
    $execute = true;
    $sql1 = "SELECT * FROM images LEFT JOIN image_tags  ON images.id = image_tags.image_id WHERE UPPER(image_tags.tag_id) = UPPER(?) ORDER BY image_date DESC LIMIT ?,?";
    $sql2 = "SELECT * FROM images LEFT JOIN users  ON images.user_id = users.id WHERE UPPER(users.user_name) LIKE UPPER(?) ORDER BY image_date DESC LIMIT ?,?";
    $sql3 = "SELECT * FROM images WHERE UPPER(image_title) LIKE UPPER(?) ORDER BY image_date DESC LIMIT ?,?";
    $sql4 = "SELECT * FROM images ORDER BY image_date DESC LIMIT ?,?";
}
elseif($order=='SLH'){
    $execute = true;
    $sql1 = "SELECT * FROM images LEFT JOIN image_tags  ON images.id = image_tags.image_id WHERE UPPER(image_tags.tag_id) = UPPER(?) ORDER BY score ASC LIMIT ?,?";
    $sql2 = "SELECT * FROM images LEFT JOIN users  ON images.user_id = users.id WHERE UPPER(users.user_name) LIKE UPPER(?) ORDER BY score ASC LIMIT ?,?";
    $sql3 = "SELECT * FROM images WHERE UPPER(image_title) LIKE UPPER(?) ORDER BY score ASC LIMIT ?,?";
    $sql4 = "SELECT * FROM images ORDER BY score ASC LIMIT ?,?";
}
elseif($order=='SHL'){
    $execute = true;
    $sql1 = "SELECT * FROM images LEFT JOIN image_tags  ON images.id = image_tags.image_id WHERE UPPER(image_tags.tag_id) = UPPER(?) ORDER BY score DESC LIMIT ?,?";
    $sql2 = "SELECT * FROM images LEFT JOIN users  ON images.user_id = users.id WHERE UPPER(users.user_name) LIKE UPPER(?) ORDER BY score DESC LIMIT ?,?";
    $sql3 = "SELECT * FROM images WHERE UPPER(image_title) LIKE UPPER(?) ORDER BY score DESC LIMIT ?,?";
    $sql4 = "SELECT * FROM images ORDER BY score DESC LIMIT ?,?";
}
elseif($order=='random'){
    $execute = false;
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
                $sql = "SELECT * FROM images LEFT JOIN image_tags  ON images.id = image_tags.image_id WHERE UPPER(image_tags.tag_id) = UPPER(?) LIMIT ?,?";
                $sth = $database->prepare($sql);
                $sth->bindValue(1,$tag_results['tag_id'], PDO::PARAM_STR);
                $sth->bindValue(2,$offset, PDO::PARAM_INT);
                $sth->bindValue(3,$rowsperpage, PDO::PARAM_INT);
                $sth->execute();
                $results = $sth->fetchAll();
                shuffle($results);
                foreach ($results as $i=>$image_results){
                    include('display.php');
                }
            }
        }
    }
    elseif(isset($_GET['user'])){
        $userName = '%'.$_GET['user'].'%';
        $sql = "SELECT * FROM images LEFT JOIN users  ON images.user_id = users.id WHERE UPPER(users.user_name) LIKE UPPER(?) LIMIT ?,?";
        $sth = $database->prepare($sql);
        $sth->bindValue(1,$userName, PDO::PARAM_STR);
        $sth->bindValue(2,$offset, PDO::PARAM_INT);
        $sth->bindValue(3,$rowsperpage, PDO::PARAM_INT);
        $sth->execute();
        $results = $sth->fetchAll();
        shuffle($results);
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
        $sql = "SELECT * FROM images WHERE UPPER(image_title) LIKE UPPER(?) LIMIT ?,?";
        $sth = $database->prepare($sql);
        $sth->bindValue(1,$title, PDO::PARAM_STR);
        $sth->bindValue(2,$offset, PDO::PARAM_INT);
        $sth->bindValue(3,$rowsperpage, PDO::PARAM_INT);
        $sth->execute();
        $results = $sth->fetchAll();
        shuffle($results);
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
        $sql = "SELECT * FROM images LIMIT ?,?";
        $sth = $database->prepare($sql);
        $sth->bindValue(1,$offset, PDO::PARAM_INT);
        $sth->bindValue(2,$rowsperpage, PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->fetchAll();
        shuffle($result);
        foreach ($result as $i=>$image_results) {
            include('display.php');
        }
    }
}

if($execute){
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
                $sth = $database->prepare($sql1);
                $sth->bindValue(1,$tag_results['tag_id'], PDO::PARAM_STR);
                $sth->bindValue(2,$offset, PDO::PARAM_INT);
                $sth->bindValue(3,$rowsperpage, PDO::PARAM_INT);
                $sth->execute();
                $resultss = $sth->fetchAll();

                if(!$resultss){
                    echo("<script>location.href ='index.php?msg=error';</script>");
                }
                else{
                    $_POST['count'] = count($resultss);
                    foreach ($resultss as $i=>$image_results){
                        include('display.php');
                    }
                }
            }
        }
    }
    elseif(isset($_GET['user'])){
        $userName = '%'.$_GET['user'].'%';
        $sth = $database->prepare($sql2);
        $sth->bindValue(1,$userName, PDO::PARAM_STR);
        $sth->bindValue(2,$offset, PDO::PARAM_INT);
        $sth->bindValue(3,$rowsperpage, PDO::PARAM_INT);
        $sth->execute();
        $results = $sth->fetchAll();
        if(!$results){
            echo("<script>location.href ='index.php?msg=error';</script>");
        }
        else {
            $_POST['count'] = count($results);
            foreach ($results as $i=>$image_results){
                include('display.php');
            }
        }
    }
    elseif(isset($_GET['title'])){
        $title = '%'.$_GET['title'].'%';
        $sth = $database->prepare($sql3);
        $sth->bindValue(1,$title, PDO::PARAM_STR);
        $sth->bindValue(2,$offset, PDO::PARAM_INT);
        $sth->bindValue(3,$rowsperpage, PDO::PARAM_INT);
        $sth->execute();
        $results = $sth->fetchAll();
        if(!$results){
            echo("<script>location.href ='index.php?msg=error';</script>");
        }
        else {
            $_POST['count'] = count($results);
            foreach ($results as $i=>$image_results){
                include('display.php');
            }
        }
    }
    else {
        $sth = $database->prepare($sql4);
        $sth->bindValue(1,$offset, PDO::PARAM_INT);
        $sth->bindValue(2,$rowsperpage, PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->fetchAll();
        $_POST['count'] = count($result);
        foreach ($result as $i=>$image_results) {
            include('display.php');
        }
    }
}
?>