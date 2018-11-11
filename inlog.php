<?php

session_start();

if (isset($_COOKIE['userid']) OR isset($_SESSION['userid'])){
    header('Location: welkom.php');
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
    <a href="#"><i class="fa fa-user" id="userIcon"></i></a>
    <a href="registreren.php"><i class="fa fa-user-plus"></i></a>
  </div>

  <form action="inlogpoort.php" method="post">
    <div class="container">
      <label>
        <h2>Sign in</h2>
      </label>
      <label>Email</label>
      <br>
      <input type="email" placeholder="Enter Email" name="email" autofocus required>
      <br>
      <label>Password</label>
      <br>
      <input type="password" placeholder="Enter Password" name="password" required>

      <button type="submit" id="ib">Login</button>
      <label>
          <input type="checkbox" checked="checked" name="remember"> Remember me
        </label>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <a href="index.php"><button type="button" class="cancelbtn">Cancel</button></a>

<!--      <span class="psw">Forgot <a href="#">password?</a></span>-->
    </div>
  </form>

</body>

</html>
