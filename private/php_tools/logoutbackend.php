<?php
session_start();
if(isset($_SESSION['username'])){
    session_unset();
    session_destroy();
    echo "<meta http-equiv='refresh' content='0;url=../../public_html/thewall/index.php'>";
    exit();
}
else {
    echo "<meta http-equiv='refresh' content='0;url=../../thewall/public_html/index.php'>";
    exit();
}
?>