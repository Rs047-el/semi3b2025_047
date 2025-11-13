<?php
declare(strict_types=1);
session_start();
$log_uname = $_POST['uid'] ?? '';
$log_pw = $_POST['pass'] ?? '';
require_once 'data.php';

if($log_uname == $uname && $log_pw == $password){
    $_SESSION['tname'] = $log_uname;
    header('Location:select_export.php');
    exit;
} else {
    header('Location:login.php');
    exit;
}
?>