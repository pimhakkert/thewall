<?php
session_start();
if(session_status()== PHP_SESSION_ACTIVE){
    session_destroy();
    echo "<meta http-equiv='refresh' content='0;url=../index.php'>";
    exit();
}
else {
    echo "<meta http-equiv='refresh' content='0;url=../index.php'>";
    exit();
}
?>