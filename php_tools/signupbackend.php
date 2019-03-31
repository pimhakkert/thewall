<?php
$fields = array('username', 'email', 'password', 'passwordconfirm');
$fieldnames = array('Username', 'E-mail', 'Password', 'Password confirmation');
$error1 = false;
$error2 = false;

$username = null;
$email = null;
$password = null;
$password_hash = null;

if('POST' === $_SERVER['REQUEST_METHOD']){
    for($i=0;$i<sizeof($fields);$i++) {
        $field = $fields[$i];
        $fieldname = $fieldnames[$i];
        if(!isset($_POST[$field]) || empty($_POST[$field])) {
            echo '<p id="error">'.$fieldname.' has not been filled in.</p>';
            $error = true;
        }
    }
}
else {
    $error1 = true;
}

if(!$error1) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_hash = null;
    $email = $_POST['email'];
    $password2 = $_POST['passwordconfirm'];

    $stmt = $database->prepare('SELECT user_name FROM users WHERE user_name=?');
    $stmt->bindParam(1, $username, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($row){
        echo '<p id="error">This username is already used!</p>';
        $error2 = true;
    }

    $stmt2 = $database->prepare('SELECT user_email FROM users WHERE user_email=?');
    $stmt2->bindParam(1, $email, PDO::PARAM_STR);
    $stmt2->execute();
    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
    if($row2){
        echo '<p id="error">This e-mail address is already used!</p>';
        $error2 = true;
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<p id="error">This e-mail address isn\'t real!</p>';
        $error2 = true;
    }

    if($password===$password2){
        if(strpos($password,'<')!== false || strpos($password,'>')!== false){
            echo '<p id="error">Passwords can\'t contain < and ></p>';
            $error2 = true;
        }
        else {
            $password_hash = password_hash($password, PASSWORD_BCRYPT);
        }
    }
    else {
        echo '<p id="error">The passwords don\'t match!</p>';
        $error2 = true;
    }

}

if(!$error2){
    $safe_email = filter_var($email,FILTER_SANITIZE_EMAIL);
    $safe_username = filter_var($username,FILTER_SANITIZE_STRING);
    $insertSql = "INSERT into users (user_name, user_email, user_password) VALUES (?,?,?)";
    $database->prepare($insertSql)->execute([$safe_username,$safe_email,$password_hash]);
}
?>