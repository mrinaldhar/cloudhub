<?php
ob_start(); 
session_start();

/* checks if the user is ogged in or not */

if (!isset($_SESSION['userid']) || !isset($_SESSION['usernaam'])) {
$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php?err=noaccess'; 
          header('Location: ' . $home_url); 
}

?>
<html>
<head>
<title>
Cloudhub :: ShareView
</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!-- links to the required style files are made here -->
<link rel="stylesheet" href="./css/bootstrap.css" />
<link rel="stylesheet" href="./css/basic.css" />
<link rel="stylesheet" href="./css/shareview.css" />
</head>
<body>
	<a href="home.php"><button class="btn btn-success" id="backtodash">Back to Dashboard</button></a>
<h1>ShareView</h1>
<?php
require_once('connectvars.php'); 
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 	$myid=$_SESSION['userid']; 
	if(isset($_GET['id']) && $_GET['id']!='')													// grabs the user id
	{
	$theirid = $_GET['id'];
}
else {
	$theirid=$myid;
}
$query = "SELECT * FROM users WHERE id='$theirid' LIMIT 1";				
$data = mysqli_query($dbc, $query);
if (mysqli_num_rows($data)!=0) 
{
	while ($row=mysqli_fetch_array($data))
	{
	$sharebuddy = $row['naam'];
	$sharenick = $row['nickname'];

}
}
else {
	$theirid=$myid;
	$sharebuddy = $_SESSION['usernaam'];
	$sharenick = $_SESSION['usernick'];
}
$_SESSION['buddyid']=$theirid;
?>
	<a href="home.php"><img src="./img/logo_main.png" id="logo_main" /></a><br />

<div id="content">
<h4><?php echo '<big>'.$_SESSION['usernaam'] . ' and ' . $sharebuddy.'</big><br /><small>'.$_SESSION['usernick'] . ' and '.$sharenick.'</small>'; ?></h4><br />
<div id="page1" class="page">
	All your files
<ul id="files">
	<?php


/* code to display the files that you have shared */
	
$query = "SELECT * FROM files WHERE shareid='$theirid' AND userid='$myid'";									// query to grab the differebt files
$data = mysqli_query($dbc, $query);
	if (mysqli_num_rows($data)==0)
	{
		// echo '<li>No files shared</li>';
	}
	while ($row=mysqli_fetch_array($data)) {
		echo '<li data-share="yes" data-value="' . $row['id'] . '" id="./server/php/files/' . $row['directory'] . '/' . $row['filename'] . '" class="'.$row['filetype'].'">' . $row['filename'] . '</li>';
	}
$printed = mysqli_num_rows($data);
	$query = "SELECT * FROM files WHERE userid='$myid' AND shareid != '$theirid'";
$data = mysqli_query($dbc, $query);
	if (($printed+mysqli_num_rows($data))==0)
	{
		echo '<li>No files available</li>';
	}
	while ($row=mysqli_fetch_array($data)) {
		echo '<li data-share="no" data-whose="mine" data-value="' . $row['id'] . '" id="./server/php/files/' . $row['directory'] . '/' . $row['filename'] . '" class="'.$row['filetype'].'">' . $row['filename'] . '</li>';
	}
	?>
	</ul>
</div>
<div id="page2" class="page">
	Files that <?php echo $sharebuddy; ?> shares with you
<ul id="files">
	<?php

/* code to display the files that your frind has shared with you */
	
$query = "SELECT * FROM sharedfiles WHERE shareid = '$myid' AND userid = '$theirid'";								// query to grab the different files that your friend shared with you
$data = mysqli_query($dbc, $query);
if (mysqli_num_rows($data)==0)
	{
		echo '<li>No files shared</li>';
	}
	while ($row2=mysqli_fetch_array($data)) {
		$fileid=$row2['fileid'];
		$query2 = "SELECT * FROM files WHERE id='$fileid'";
$data2 = mysqli_query($dbc, $query2);
while ($row=mysqli_fetch_array($data2)) {
		echo '<li data-whose="their" id="./server/php/files/' . $row['directory'] . '/' . $row['filename'] . '" class="' . $row['filetype'] . '">' . $row['filename'] . '</li>';
	}
	}
	?>
	</ul>
</div>
<div id="menubar">
	</div>
</div>

<!-- method for instaneous video and audio play when the user places the mouse pointer over the file -->

<div id="preview">
	<video id="prevplayer">
		<source id="music" src="music2.mp3"></source>
	</video>
</div>
<script src="./js/jquery.js"></script>

<script src="./js/shareview.js"></script>

</body>
</html>
