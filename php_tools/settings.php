<?php
$dsn = 'mysql:dbname=u39498p34938_thewall;host=127.0.0.1';
$user = 'root';
$password = '';

try {
    $database = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
