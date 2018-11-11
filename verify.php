<?php

require ('../private/db.php');

//CHECKEN OF DE MAIL KLOPT MET DE HASH
$query = "SELECT userid FROM users WHERE mailadres = ? AND hash = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('ss',$mailadres,$hash);

$mailadres = $_GET['mailadres'];
$hash = $_GET['hash'];
$stmt->execute();
$stmt->bind_result($userid);
$row =  $stmt->fetch();
if (!$row){
    echo 'Sorry this combination of mailadres and hash is not valid.';
    exit();
}
$stmt->close();

//ACCOUNT ACTIVEREN
$query = "UPDATE users SET active = 1 WHERE userid = ?";
$stmt = $mysqli->prepare($query) or die ('Error preparing for UPDATE.');
$stmt->bind_param('i',$userid);
$stmt->execute() or die ('Error updating.');
echo 'Your account has been activated!!' . '<br>';
echo 'Click <a href="index.php">here</a> to go back to the mail screen.';

