<?php
ob_start();
session_start();
?><link rel="stylesheet" href="./css/bootstrap.css" />
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
	background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#eaeef1), to(#c7cfd8));
	background: -moz-linear-gradient(top, #eaeef1, #c7cfd8);
	background: linear-gradient(top, #eaeef1, #c7cfd8);
	font-family: myFont;
}
#logout {
	position: absolute;
	top:30px;
	right:50px;
	opacity: 0;
}
h3 {
font-family: myFont;
	
}
#diss_1 {
	width:80%;
	height:30%;
}
#dashboard {
	display:none;
}
</style>
<script src="./js/jquery.js"></script>
<script>
function loader() {
	$('#diss_1').slideUp();
	$('#dashboard').slideDown();
}
function start() {
	window.setTimeout(loader, 1000);
}
$('document').ready(function() {
	start();

});
</script>
</head>
<body>
<div id="diss_1"></div>
<img src="./img/logo_black.png" id="logo_main" />

<div id="dashboard">
<?php
require_once('connectvars.php'); 
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
 
if (isset($_GET['hash']) && $_GET['hash']!='') {
	$hash=$_GET['hash'];
$query = "SELECT * FROM toconfirm WHERE hash = '$hash' LIMIT 1";
$data = mysqli_query($dbc, $query);
if (mysqli_num_rows($data)==1)
{
	while ($row=mysqli_fetch_array($data)) {
		$naam = $row['naam'];
		$email = $row['email'];
		$password = $row['password'];
		$nickname = $row['nickname'];
		$query = "INSERT INTO users VALUES ('', '$naam','$email','$password', '$nickname')";
		mysqli_query($dbc,$query);
		$_SESSION['userid']=$row['id'];
	$_SESSION['usernick']=$row['nickname'];
	$_SESSION['useremail']=$row['email'];
	$_SESSION['usernaam']=$row['naam'];
	$_SESSION['directory']=MD5($_SESSION['userid'].$_SESSION['useremail'].$_SESSION['userid']);
		echo '
	<h3>Congratulations!</h3>
	<p>Your account has been verified and can now be used. Welcome aboard! <br /><br /><a href="./home.php"><button class="btn btn-primary">Go to Dashboard</button></a>
	';
	}
		$query = "DELETE FROM toconfirm WHERE hash = '$hash' LIMIT 1";
		mysqli_query($dbc,$query);
}
else {
	echo '
	<h3>Something is wrong!</h3>
	<p>Sorry, the confirmation hash provided by you is invalid. Please check your email for a valid confirmation code.</p>';
}
}
else {
	echo '
	<h3>Your account has been successfully created!</h3>
	<p>Before you can use your CloudHub account, you must confirm the email address that you provided during registration.<br /><br />
	We just sent an email to that address, please check your spam/junk folders if you cant find it in your inbox.<br /><br />
	';
}

?>

</div>
</body>
</html>