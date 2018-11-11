<?php
/**
 * Created by PhpStorm.
 * User: stanh
 * Date: 18-4-2018
 * Time: 11:30
 */
require ('../private/db.php');

//echo 'Tijdelijke opslaglocatie: ' . $_FILES['uploaded_image']['tmp_name'] . '<br>';

//IMAGE OP DE JUISTE PLAATS ZETTEN IN DE MAP
$temp_location = $_FILES['uploaded_image']['tmp_name'];
$target_location = 'images/' . time() . $_FILES['uploaded_image']['name'];

move_uploaded_file($temp_location, $target_location);

//DATABASEN VAN DE IMAGE
$title = $_POST['title'];
$description = $_POST['description'];

$query = "INSERT INTO images VALUES (0,?,?,?)";
$stmt = $mysqli->prepare($query) or die ('Error preparing.');
$stmt->bind_param('sss',$target_location, $title, $description) or die ('Error binding params');
$stmt->execute() or die ('Error inserting image in database');
$stmt->close();

//echo 'Hoera, je image staat in de database;';
header('Location: welkom.php');
