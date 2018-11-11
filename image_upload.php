<?php
session_start();
require ('private/db.php');

//CHECKEN OF DE GEBRUIKER VERDWAALD IS

if (!isset($_SESSION['userid'])) {
    if (!isset($_COOKIE['userid'])) {
        header('Location: uitlogpoort.php');
    } else {
        require ('cookiecheck.php');
        $_SESSION['userid'] = $_COOKIE['userid'];
        $_SESSION['hash'] = $_COOKIE['hash'];
    }
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>inloggen</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="StyleInlog.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

<header>
    <a href="index.php"><h1>The Wall</h1></a>
</header>

<div class="navbar">
    <a href="admin.php"><i class="fa fa-home" aria-hidden="true"></i></a>
    <a href="uitlogpoort.php"><i class="fa fa-user-times"></i></a>

</div>

<form action="process_upload.php" method="post" enctype="multipart/form-data">
    <div class="container">
        <label>
            <div class="fileContainer">
            <input id="file" type="file" name="uploaded_image">
            </div>
        </label>
        <label><br>Title: <br>
            <input type="text" name="title">
        </label>
        <label><br>Description:
            <br><textarea name="description" cols="30" rows="10"></textarea>
        </label>
            <br>
            <button type="submit" name="submit_image" id="ib">Upload</button>
    </div>

</form>

</body>

</html>
