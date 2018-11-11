<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>registreren</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="StyleInlog.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

  <header>
    <a href="index.php"><h1>The Wall</h1></a>
  </header>

  <div class="navbar">
    <a href="inlog.php"><i class="fa fa-user" id="userIcon"></i></a>
    <a href="#"><i class="fa fa-user-plus"></i></a>
  </div>

  <form action="process_registration.php" method="post">
    <div class="container">
      <label>
        <h2>Sign up</h2>
      </label>
      <label>Full name</label>
      <br>
      <input type="text" placeholder="Enter full name" name="username" autofocus required>
      <br>
      <label>Email</label>
      <br>
      <input type="text" placeholder="Enter Email" name="email" required>
      <br>
      <label>Password</label>
      <br>
      <input type="password" placeholder="Enter password" name="password1" required>
        <br>
        <label>Repeat password</label>
      <br>
      <input type="password" placeholder="Enter password" name="password2" required>
      <br>

        <button type="submit" name="submit_registration" id="ib">Sign up</button>

    </div>

    <div class="container" style="background-color:#f1f1f1">
      <a href="index.php"><button type="button" class="cancelbtn">Cancel</button></a>
      <span class="psw">Already got an account? <a href="inlog.php">Sign in here</a></span>
    </div>
    
  </form>

</body>

