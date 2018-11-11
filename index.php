<?php
require ('../private/db.php');
session_start();

if (isset($_COOKIE['userid']) OR isset($_SESSION['userid'])){
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
  <link rel="stylesheet" type="text/css" href="Style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>The Wall</title>
</head>

<body>

  <header>
    <h1>The Wall</h1>
  </header>

  <div class="navbar">
    <a href="inlog.php"><i class="fa fa-user" id="userIcon"></i></a>
    <a href="registreren.php"><i class="fa fa-user-plus"></i></a>
  </div>

  <div id="wrapper">

    <div class="masonry">

          <?php
          while($succes = $stmt->fetch()){
              echo '<div class="item"><img class="images" src="' . $location . '" alt="' . $title . '<br>'  . $description . '"/></div>';

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
