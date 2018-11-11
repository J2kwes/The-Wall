<?php

require ('../private/db.php');

//HOORT DE BEZOEKER NIER UBERHHAUPT WE TE ZIJN?
if (!isset($_POST['submit_registration'])){
    header('Location: index.php');
}

//ZIJN ALLE VELDEN INGEVULD?
if (empty($_POST['username']) OR empty($_POST['email'])OR empty($_POST['password1'])OR empty($_POST['password2'])){
    echo 'You forgot something!.<br>';
    echo 'Click <a href="registreren.php">here</a> to go back to registration.';
    exit();
}


//ZIJN BEIDE WACHTWOORDEN GELIJK?
if ($_POST['password1'] != $_POST['password2']){
    echo 'Your passwords are not identical.<br>';
    echo 'Click <a href="registreren.php">here</a> to go back to registration.';
    exit();
}

//HEEFT DE GEBRUIKER WE EEN MA-ADRES?
$position = strpos($_POST['email'], '@ma-web.nl');

if (!$position){
    echo 'You have to be a student or teacher to register.' . '<br>';
    echo 'Click <a href="registreren.php">here</a> to go back to registration.';
    exit();
}


//BESTAAT DEZE USERNAME AL?
$query = "SELECT userid FROM users WHERE username = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('s',$username);
$username = $_POST['username'];
$result = $stmt->execute() or die ('Error querying username');
$row = $stmt->fetch();
if ($row){
    echo 'This username is already used.<br>';
    echo 'Click <a href="registreren.php">here</a> to go back to registration.';
    exit();
}

//BESTAAT DIT MAILADRES AL?
$query = "SELECT userid FROM users WHERE mailadres = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('s',$mailadres);
$mailadres = $_POST['email'];
$result = $stmt->execute() or die ('Error querying mailaders');
$row = $stmt->fetch();
if ($row){
    echo 'This Email is already used.<br>';
    echo 'Click <a href="registreren.php">here</a> to go back to registration.';
    exit();
}

//GEBRUIKER TOEVOEGEN AAN DE DATABASE

$query = "INSERT INTO users VALUES (0,?,?,?,?,0)";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("ssss", $username, $mailadres, $hash, $password);
$username = $_POST['username'];
$mailadres = $_POST['email'];
$random_number = rand(0,1000000);
$hash = hash('sha512',$random_number);
$password = hash('sha512', $_POST['password1']);
$result = $stmt->execute() or die ('Error inserting user');

//GEBRUIKER MAILEN
$to = $_POST['email'];
$subject = 'Verification for you account on The Wall';
$message = 'Click on the link to activate your account: ';
$message.= 'http://24505.hosts.ma-cloud.nl/The-Wall/verify.php?mailadres=' . $mailadres . '&hash=' . $hash;
$headers = 'From: stanhaakman@hotmail.com';
mail($to,$subject,$message,$headers) or die ('Error mailing');

echo 'An email as been send to your email to activate your acount.';


