<?php
ob_start(); 
session_start();
require_once('connectvars.php'); 
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 


      // Grab the user-entered log-in data 
      $user_username = mysqli_real_escape_string($dbc, strip_tags($_POST['regname'])); 
      $user_usernick = mysqli_real_escape_string($dbc, strip_tags($_POST['regnick']));
      $user_email = mysqli_real_escape_string($dbc, strip_tags($_POST['regemail'])); 
      $user_password = mysqli_real_escape_string($dbc, strip_tags($_POST['regpassword'])); 
      $randommath = rand(100000, 999999);
       $query = "SELECT * FROM users WHERE email = '$user_email' OR nickname = '$user_usernick' LIMIT 1";
       $data = mysqli_query($dbc, $query);
       if (mysqli_num_rows($data)==1) {
       	echo 'Error: An account with this email address or nickname already exists. <a href="index.php">Please try again.</a>';
       }
       else {
$query = "INSERT INTO toconfirm VALUES ('', '$user_username','$user_email',SHA1(MD5('$user_password')),  '$user_usernick', MD5('$randommath'))";
$message = 'Dear ' . $user_username . ', Welcome to CloudHub!

Click this link to confirm your CloudHub account now: http://inconnect.cu.cc/mrinaldhar/cloudhub/confirm.php?hash=' . MD5($randommath) . '



Your confirmation code is ' . $randommath . '. You can also enter this code manually at http://inconnect.cu.cc/mrinaldhar/cloudhub/confirm.php


If the above link does not work upon clicking, copy and paste the url directly into the address bar of your browser.

We are really happy you are with us, and we hope to make sure you enjoy using CloudHub as much as we did creating it.

--Team CloudHub
';
mail($user_email, 'Confirm your new CloudHub account', $message, 'From: CloudHub Account confirmation/n');
mysqli_query($dbc,$query);
$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/confirm.php'; 
header('Location: ' . $home_url); 
}
mysqli_close($dbc);
?>
