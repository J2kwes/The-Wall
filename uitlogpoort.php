<?php
/**
 * Created by PhpStorm.
 * User: stanh
 * Date: 13-4-2018
 * Time: 09:14
 */

session_start();

if (isset($_COOKIE[session_name()])){
    setcookie(session_name(), '', time() - 3600);
}

$_SESSION = array();
session_destroy();

if (isset($_COOKIE['userid'])){
    setcookie('userid', '', time() - 3600);
    setcookie('hash', '', time() - 3600);
}

header('Location: index.php');