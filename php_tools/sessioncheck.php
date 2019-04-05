<?php
session_start();
$timeout = 1199;
if('POST' === $_SERVER['REQUEST_METHOD']){
    if(isset($_SESSION['timeout'])){
        $duration = time() - (int)$_SESSION['timeout'];
        if($duration > $timeout){
            session_unset();
            session_destroy();
            session_start();
            echo "login";
        }
    }
    $_SESSION['timeout'] = time();
}
?>