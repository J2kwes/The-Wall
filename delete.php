<?php
/**
 * Created by PhpStorm.
 * User: stanh
 * Date: 20-4-2018
 * Time: 09:32
 */
require ('../private/db.php');


$userid = $_GET['userid'];

$query = "DELETE FROM users WHERE userid = '$userid'";
$result = mysqli_query($mysqli,$query) or die ('Error deleting.');
header("Location: manage-users.php");