<?php
$dsn = 'mysql:dbname=thewall;host=127.0.0.1';
$user = 'user';
$password = 'root';

try {
    $database = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
