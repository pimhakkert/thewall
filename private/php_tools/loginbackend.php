<?php
$fields = array('username', 'password');
$fieldnames = array('Username', 'Password');
$error1 = false;
$error2 = false;
$errorDisplay = false;

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
            $error1 = true;
        }
    }
}
else {
    $error1 = true;
}

if(!$error1){
    $usernameInput = $_POST['username'];
    $passwordInput = $_POST['password'];
    $stmt = $database->prepare('SELECT * FROM users WHERE UPPER(user_name)=UPPER(?)');
    $stmt->bindParam(1, $usernameInput, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $passwordDatabase = null;
    $error2 = false;

    if(!$row){
        $errorDisplay = true;
    }
    else {
        $passwordDatabase = $row['user_password'];
    }

    if(!$error2 && password_verify($passwordInput,$passwordDatabase)){
        $_SESSION['username'] = $row['user_name'];
        session_write_close();
        header("Location: index.php");
    }
    else {
        $errorDisplay = true;
    }
}

if($errorDisplay){
    echo '<p id="error">This username or password is incorrect!</p>';
}
?>