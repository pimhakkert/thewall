<?php
$dsn = 'mysql:dbname=pimhase401_thewall;host=127.0.0.1';
$user = 'pimhase401_root';
$password = '12345';

try {
    $database = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
