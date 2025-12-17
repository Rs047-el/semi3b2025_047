<?php
declare(strict_types=1);
session_start();
require 'vendor/autoload.php';
require_once 'data/data.php';

$do = $_GET['do'] ?? 'login';

if (!isset($_SESSION['uid'])) {
    if ($do === 'login_check') {
        include 'src/login_check.php';
    } else {
        include 'src/login.php';
    }
} else {
    include "src/{$do}.php";
}
?>