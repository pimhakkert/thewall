<?php
$fields = array('username', 'email', 'password', 'passwordconfirm');
$fieldnames = array('Username', 'E-mail', 'Password', 'Password confirmation');
$error = false;

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
    $error = true;
}

if(!$error) {

}
?>