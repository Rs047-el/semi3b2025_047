<?php
$log_uname = $_POST['uid'] ?? '';
$log_pw = $_POST['pass'] ?? '';

if($log_uname == $uname && $log_pw == $password){
    $_SESSION['uid'] = $log_uname;
    header('Location:?do=select_export');
    exit;
} else {
    header('Location:?do=login');
    exit;
}
?>