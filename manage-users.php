<?php
/**
 * Created by PhpStorm.
 * User: stanh
 * Date: 20-4-2018
 * Time: 09:03
 */
session_start();
require ('../private/db.php');

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

$query = "SELECT active FROM users WHERE userid = '" . $_COOKIE['userid'] . "'";
$result = mysqli_fetch_array(mysqli_query($mysqli, $query));
$admin = $result['active'];

if ($admin != 5) {
    header('Location: welkom.php');
}
mysqli_close($mysqli);
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Manage users</title>
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
    <a href="image_upload.php"><i class="fa fa-upload"></i></a>
    <a href="manage-image.php"><i class="fa fa-photo"></i></a>
    <a href="#"><i class="fa fa-group"></i></a>
</div>

<form>
    <?php
    require ('../private/db.php');

    $query = "SELECT userid, username, mailadres FROM users";
    $result = mysqli_query($mysqli,$query) or die ('Error querying');

    echo '<table>';

    //3. Loopje waarin alle mailadressen in beeld worden gebracht
    while($row = mysqli_fetch_array($result)){

        $userid = $row['userid'];
        $username = $row['username'];
        $mailadres = $row['mailadres'];

        echo '<tr>';
        echo "<td>$userid</td><td>$username</td><td>$mailadres</td>";
        echo '<td>';
        echo '<a href="delete.php?userid=' . $userid . '">DELETE</a>';
        echo '</td>';
        echo '</tr>';
    }
    echo '</table>';


    ?>

</form>

</body>

