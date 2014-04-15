<?php
ob_start(); session_start();
require_once('connectvars.php'); 
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
 
      // Grab the user-entered log-in data 
 $user_username = mysqli_real_escape_string($dbc, strip_tags($_POST['uname'])); 
 $user_password = mysqli_real_escape_string($dbc, strip_tags($_POST['pwd'])); 
$query = "SELECT * FROM users WHERE nickname = '$user_username' AND password = SHA1(MD5('$user_password')) OR email = '$user_username' AND password = SHA1(MD5('$user_password')) LIMIT 1";
$data = mysqli_query($dbc, $query);
if (mysqli_num_rows($data)!=0)
{
while ($row=mysqli_fetch_array($data))
{
	$_SESSION['userid']=$row['id'];
	$_SESSION['usernick']=$row['nickname'];
	$_SESSION['useremail']=$row['email'];
	$_SESSION['usernaam']=$row['naam'];
	$_SESSION['directory']=MD5($_SESSION['userid'].$_SESSION['useremail'].$_SESSION['userid']);
	$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/home.php'; 
          header('Location: ' . $home_url); 
}
}
else {
	$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php?err=notfound'; 
          header('Location: ' . $home_url); 
	
}
mysqli_close($dbc);
?>
