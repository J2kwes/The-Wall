<?php
/**
 * Created by PhpStorm.
 * User: stanh
 * Date: 13-4-2018
 * Time: 08:27
 */

session_start();

//CHECKEN OF DE GEBRUIKER VERDWAALD IS
if (!isset($_POST['submit_login'])){
    header("Location: inlog.php");
}

//CHECKEN OF DE GEBRUIKER ALLES HEEFT INGEVULD
if (empty($_POST['email']) OR empty($_POST['password'])){
    echo 'You forgot something!';
    echo 'Click <a href="inlog.php">here</a> to go back to sign in.\>';
    exit();
}

//CHECKEN OF DE GEBRUIKER BESTAAT (EN OF GE COMBINATIE BESTAAT)
require ('../private/db.php');

$query = "SELECT userid, hash, active FROM users WHERE mailadres = ? AND password = ?";
$stmt = $mysqli->prepare($query) or die ('Error preparing.');
$stmt->bind_param('ss', $mailadres,$password) or die ('Error binding params');
$stmt->bind_result($userid, $hash, $active) or die ('Error binding results.');
$mailadres = $_POST['email'];
$password = $_POST['password'];
$password = hash('sha512', $password) or die ('Error hashing');
$stmt->execute() or die ('Error executing');
$fetch_succes = $stmt->fetch();

if (!$fetch_succes){
    echo 'You forgot something!';
    echo 'Click <a href="inlog.php">here</a> to go back to sign in.';
    exit();
}else if ($active == 0){
    echo 'Your account has not been activated. Check your mailbox';
    echo 'Click <a href="inlog.php">here</a> to go back to sign in.';
    exit();
}

//ALLES IN ORDE DAN COOKIES
setcookie('userid',$userid, time() + 3600 * 24 * 7);
$_SESSION['userid'] = $userid;
setcookie('hash',$hash, time() + 3600 * 24 * 7);
$_SESSION['hash'] = $hash;

header('Location: welkom.php');

