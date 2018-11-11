<?php
/**
 * Created by PhpStorm.
 * User: stanh
 * Date: 20-4-2018
 * Time: 11:55
 */
require ('../private/db.php');


$image_id = $_GET['image_id'];

$query = "DELETE FROM images WHERE image_id = '$image_id'";
$result = mysqli_query($mysqli,$query) or die ('Error deleting.');
header("Location: manage-image.php");