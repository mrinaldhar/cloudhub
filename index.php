<?php
ob_start();
session_start();
if (isset($_SESSION['userid']) && isset($_SESSION['usernaam'])) {
$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/home.php'; 
header('Location: ' . $home_url); 
}

?>
<html>
<head>
<title>CloudHub</title>
<link rel="stylesheet" href="./css/bootstrap.css" />
<style>
@font-face {
	src: url('./font/myriadpro.otf');
	font-family:myFont;
}
#logo_main {
	position:relative;
	padding-top:100px;
	max-width: 50%;
	padding-bottom:20px;
}

body {
	text-align: center;
	background-color: rgb(0,0,0);
	font-family: myFont;
	background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#eaeef1), to(#c7cfd8));
	background: -moz-linear-gradient(top, #eaeef1, #c7cfd8);
	background: linear-gradient(top, #eaeef1, #c7cfd8);
}
#diss_1 {
	width:80%;
	height:30%;
}
#theform {
position:relative;
margin: auto;
width:50%;
display:none;
}
.form-control {
 font-size: 16px;
  height: auto;
  padding: 10px;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
}
#uname {
	border-bottom-left-radius: 0px;
	border-bottom-right-radius: 0px;
}
#pwd {
	border-top-left-radius: 0px;
	border-top-right-radius: 0px;
	margin-bottom:20px;
}
h3 {
	font-family: myFont;
	color:black;
	padding-bottom: 60px;
}
#submit {
	margin-bottom: 60px;
}
body {
	background-color: white;
}


#reg_form {
position:relative;
margin: auto;
width:50%;
display:none;
}
.form-control {
 font-size: 16px;
  height: auto;
  padding: 10px;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
}
#uname {
	border-bottom-left-radius: 0px;
	border-bottom-right-radius: 0px;
}

#pwd {
	border-top-left-radius: 0px;
	border-top-right-radius: 0px;
	margin-bottom:20px;
}
#subs {
	font-family: myFont;
	color:black;
	padding-bottom: 60px;
}
#submit {
	margin-bottom: 60px;
}
.error {
	color:red;
	float:right;
}
#reg_form h3 {
	margin-bottom: -30px;
}
button {
	outline-color: red;
}
</style>


 <meta name="viewport" content="width=device-width">
</head>
<body>
<div id="diss_1"></div>
<img src="./img/logo_black.png" id="logo_main" />
<div id="theform">

<h3>Your space on the cloud!</h3>
<?php 
if (isset($_GET['err']) && $_GET['err']!='')
{
	echo '<p>';
	if ($_GET['err']=='logout')
	{
		echo 'You have been logged out of your account.';
	}
	else if ($_GET['err']=='noaccess')
	{
		echo 'You cannot access backend files this way.';
	}
	else if ($_GET['err']=='notfound')
	{
		echo 'Invalid email address or password.';
	}
	echo '</p>';
    }
?>
<form action="login.php" method="POST">
<input type="text" name="uname" id="uname" class="form-control" placeholder="CloudNick or Email address" />
<input type="password" name="pwd" id="pwd" class="form-control" placeholder="Password" />
<input type="submit" name="submit" id="submit" class="btn btn-lg btn-primary btn-block" value="Login" />
</form>

<button id="register" onclick ="regt()" class="btn btn-lg btn-block btn-warning">No CloudHub account yet?</button>
<h3><small><b>Helping 
<?php
require_once('connectvars.php'); 
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
$query = "SELECT * FROM users";
$data=mysqli_query($dbc, $query);
echo mysqli_num_rows($data);
echo ' users share ';
$query = "SELECT * FROM files";
$data=mysqli_query($dbc, $query);
echo mysqli_num_rows($data);
echo ' files right now';
?></b>
</small></h3>
</div>



<div id="reg_form">
<h3>Create an account now!</h3><p>Its free, and only takes a minute.</p>
<form name="regs" method="post" onsubmit="return validate()" action="register.php"> 
   <input type="text" id="regname" name="regname" class="form-control" placeholder="Your name">
   <span id="namerr" class="error"></span>
   <br>
   <input type="text" id="regnick" name="regnick" class="form-control" placeholder="Choose a CloudNick">
   <span id="nickerr" class="error"></span>
   <br>
   <input type="text" id="regemail" name="regemail" class="form-control" placeholder="Email Address">
   <span id="mailerr" class="error"></span>
   <br>
   <input type="password" id="regpasswd" name="regpassword" class="form-control" placeholder="Choose a secure password">
   <span id="pwderr" class="error"></span>
   <br>
   <input type="password" id="confpasswd" class="form-control" placeholder="Confirm Password">
   <br>
   <input type="submit" name="regsubmit" id="submit" onclick="validate()" class="btn btn-lg btn-success btn-block" value="Register" />

</form>
</div>
<script src="./js/jquery.js"></script>
<script>
function loader() {
	$('#diss_1').slideUp();
	$('#theform').slideDown();
}
function set() {
window.setTimeout(loader, 1500);	
}
$(document).ready(function() { 
	set();
});


function regt(){

	$('#theform').slideUp();
	$('#reg_form').slideDown();
}

/////////////////////////////////////////////////////
function validate(){

	document.getElementById('namerr').innerHTML=""
	document.getElementById('nickerr').innerHTML=""
	document.getElementById('pwderr').innerHTML=""
	var uname=document.getElementById('regname').value;
	var flag = true;
	if (uname =="")
	{
	//	alert(uname);
		document.getElementById('namerr').innerHTML="Please enter your name"
		flag = false;
	}
	
	var nick=document.getElementById('regnick').value;
	if (nick == "")
	{
		//alert(uname);
		document.getElementById('nickerr').innerHTML="Cloudnick cannot be empty"
		flag = false;
	}

	var email=document.getElementById('regemail').value;
	var atpos = email.indexOf("@");
	var dotpos = email.lastIndexOf(".");
	if (email == "" || atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= email.length)
	{
		//alert(uname);
		document.getElementById('mailerr').innerHTML="Invalid Email address!";
		flag = false;
	}

	var passwd=document.getElementById('regpasswd').value;
	var conf=document.getElementById('confpasswd').value;
	if(passwd.length < 6)
	{
		document.getElementById('pwderr').innerHTML="Password must be greator than 6 characters in length";
		flag = false;
	}
	else if (passwd != conf)
	{
		document.getElementById('pwderr').innerHTML="Password Mismatch!";	
		flag = false;
	}

	return flag;
}
////////////////////////////////////////////////////



</script>

</body>
</html>