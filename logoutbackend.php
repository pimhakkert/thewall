<?php
session_start();
if(isset($_SESSION['username'])){
    session_unset();
    session_destroy();
    echo "<meta http-equiv='refresh' content='0;url=index.php'>";
    exit();
}
else {
    echo "<meta http-equiv='refresh' content='0;url=index.php'>";
    exit();
}
?>