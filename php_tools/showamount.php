<?php
if(isset($_GET['title'])){
    $title = '%'.$_GET['title'].'%';
    $sql = "SELECT COUNT(*) FROM images WHERE UPPER(image_title) LIKE UPPER(?)";
    $result = $database->prepare($sql);
    $result->execute([$title]);
}
elseif(isset($_GET['user'])){
    $userName = '%'.$_GET['user'].'%';
    $sql = "SELECT COUNT(*) FROM images LEFT JOIN users  ON images.user_id = users.id WHERE UPPER(users.user_name) LIKE UPPER(?)";
    $result = $database->prepare($sql);
    $result->execute([$userName]);
}
elseif(isset($_GET['tag'])){
    $tagName = '%'.$_GET['tag'].'%';
    $sql = "SELECT COUNT(tag_id) FROM tags WHERE UPPER(tag_name) = UPPER(?)";
    $result = $database->prepare($sql);
    $result->execute([$tagName]);
}
else{
    $sql = "SELECT COUNT(*) FROM images";
    $result = $database->prepare($sql);
    $result->execute();
}
    $numrows = $result->fetchColumn();
// number of rows to show per page
$rowsperpage = 8;
// find out total pages
$totalpages = ceil($numrows / $rowsperpage);

// get the current page or set a default
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    // cast var as int
    $currentpage = (int) $_GET['page'];
} else {
    // default page num
    $currentpage = 1;
} // end if

// if current page is greater than total pages...
if ($currentpage > $totalpages) {
    // set current page to last page
    $currentpage = $totalpages;
} // end if
// if current page is less than first page...
if ($currentpage < 1) {
    // set current page to first page
    $currentpage = 1;
} // end if

// the offset of the list, based on current page
$offset = ($currentpage - 1) * $rowsperpage;
?>