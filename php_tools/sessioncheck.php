<?php
session_start();
$return = $_POST['return'];
if('POST' === $_SERVER['REQUEST_METHOD']){
    if(!isset($_SESSION['username'])){
        echo "login";
    }
}
?>