<?php
/**
 * Created by PhpStorm.
 * User: stanh
* Date: 19-4-2018
* Time: 09:09
*/
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

$query = "SELECT active FROM users WHERE userid = '" . $_COOKIE['userid'] . "'";
$result = mysqli_fetch_array(mysqli_query($mysqli, $query));
$admin = $result['active'];

if ($admin != 5) {
    header('Location: welkom.php');
}


$query = "SELECT location, title, description FROM images ORDER BY image_id DESC";
$stmt = $mysqli->prepare($query) or die ('Error preparing.');
$stmt->bind_result($location, $title, $description) or die ('Error binding result');
$stmt->execute() or die ('Error executing');

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>The Wall</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="Style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<header>
    <a href="index.php"><h1>The Wall</h1></a>
</header>

<div class="navbar">
    <a href="#"><i class="fa fa-home" aria-hidden="true"></i></a>
    <a href="uitlogpoort.php"><i class="fa fa-user-times"></i></a>
    <a href="image_upload.php"><i class="fa fa-upload"></i></a>
    <a href="manage-image.php"><i class="fa fa-photo"></i></a>
    <a href="manage-users.php"><i class="fa fa-group"></i></a>

    <?php
    require ('private/db.php');
    $query = "SELECT username, userid FROM users";
    $result = mysqli_query($mysqli, $query);
    while ($row = mysqli_fetch_array($result)) {
        $username =  mysqli_real_escape_string($mysqli,trim($row['username']));
        $id = mysqli_real_escape_string($mysqli,trim($row['userid']));
        $cookie = $_COOKIE['userid'];

        if ($id == $cookie) {
            echo '<p>Welcome ' . $username . '</p>';
        }
    }
    mysqli_close($mysqli);
    ?>
</div>

<div id="wrapper">

    <div class="masonry">

        <?php
        require ('private/db.php');
        while($succes = $stmt->fetch()){
            echo '<div class="item"><img class="images" src="' . $location . '" alt="' . $title . '<br>' . $description . '"/></div>';

        }
        ?>


    </div>

</div>

<!-- The Modal -->
<div id="myModal" class="modal">

    <!-- The Close Button -->
    <span class="close">&times;</span>

    <!-- Modal Content (The Image) -->
    <img class="modal-content" id="img">

    <!-- Modal Caption (Image Text) -->
    <div id="caption"></div>
</div>

<script src="script.js" charset="utf-8"></script>



</body>

</html>
