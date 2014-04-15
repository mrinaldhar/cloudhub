<?php
ob_start();
session_start();
if (isset($_SESSION['userid']) && isset($_SESSION['usernaam'])) {                                                            // chekcs if the user is already logged in 
$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/home.php';                                 // the user is redirected to the home page if logged in
header('Location: ' . $home_url); 
}

?>
<html>
<head>
<title>CloudHub</title>

<!-- list of links -->
<link rel="stylesheet" href="./css/bootstrap.css" />
<link rel="stylesheet" href="./css/index.css" />
 <meta name="viewport" content="width=device-width">
</head>
<body>
<div id="diss_1"></div>
<img src="./img/logo_black.png" id="logo_main" />								            <!-- dislpays the main logo of cloudhub -->
<div id="theform">					

<h3>Your space on the cloud!</h3>
<?php                                                                                                                      // when the user is logged out this php code gets initited to display the message that the user has logged out
                                                                                                                           // this function is also initaited the user name or password entered is invalid
if (isset($_GET['err']) && $_GET['err']!='')										   // this function is initiated if the user has logged out	
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
<form action="login.php" method="POST">											<!-- the form begins here -->
<input type="text" name="uname" id="uname" class="form-control" placeholder="CloudNick or Email address" />	
<input type="password" name="pwd" id="pwd" class="form-control" placeholder="Password" />
<input type="submit" name="submit" id="submit" class="btn btn-lg btn-primary btn-block" value="Login" />
</form>

<button id="register" onclick ="regt()" class="btn btn-lg btn-block btn-warning">No CloudHub account yet?</button>     <!-- button to allow first time registration -->
<h3><small><b>Helping                                                                                                  
<?php
/* this piece of code is used to get to know that how many users are actually registered and the number of files that they have shared
   
   this information is then displayed to the person either logging in or registering the first time */

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



<div id="reg_form">													<!-- the registration form begins here -->
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
   <input type="password" id="regpasswd" name="regpassword" class="form-control" placeholder="Choose a secure password - 6 characters minimum">
   <span id="pwderr" class="error"></span>
   <br>
   <input type="password" id="confpasswd" class="form-control" placeholder="Confirm Password">
   <br>
   <input type="submit" name="regsubmit" id="submit" onclick="validate()" class="btn btn-lg btn-success btn-block" value="Register" />

</form>
</div>
<script src="./js/jquery.js"></script>
<script src="./js/index.js"></script>
</body>
</html>
