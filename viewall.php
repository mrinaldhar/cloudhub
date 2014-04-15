<?php
ob_start(); session_start();
if (!isset($_SESSION['userid']) || !isset($_SESSION['usernaam'])) {
$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php?err=noaccess'; 
          header('Location: ' . $home_url); 
}

?>
<html>
<head>
<title>
Cloudhub :: All your files
</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

<link rel="stylesheet" href="./css/bootstrap.css" />
<link rel="stylesheet" href="./css/basic.css" />
<link rel="stylesheet" href="./css/viewall.css" />

</head>
<body>
	<h1>All Your Files</h1>
	
	<a href="./home.php"><img src="./img/logo_main.png" id="logo_main" /></a>
	<a href="./home.php"><button class="btn btn-success" id="backtodash">Back to Dashboard</button></a>
<div id="sresults">
<p class="s"><input type="search" id="search" name="search" onclick="this.value=''" value="Search" /></span>   <!-- this is for the search box -->
<div id="res"></div>
</div>

	<br />


<div id="content">
<div id="page1" class="page">
	<ul id="files">
<?php
	require_once('connectvars.php'); 

/* code to grab the files uploaded by the user */

 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 $myid=$_SESSION['userid']; 
$query = "SELECT * FROM files WHERE userid = '$myid' ORDER BY filename DESC";							// makes query to get all the files
$data = mysqli_query($dbc, $query);
	while ($row=mysqli_fetch_array($data)) {
			$sizethis=$row['filesize'];
		if ($sizethis>1)												// calculates file size and displays the file size in user friendly format
		{
			$sizethis=$sizethis/1024;
			if ($sizethis>1)
			{
			$sizethis=$sizethis/1024;
			$sizethis = round($sizethis, 2) . ' MB';
			}
			else {
			$sizethis = round($sizethis, 2) . " KB";
			}
		}
		else {
			$sizethis = round($sizethis, 2) . " bytes";
		}
		echo '<li id="./server/php/files/' . $_SESSION['userid'] . '/' . $row['filename'] . '"><a href="./server/php/files/' . $row['directory'] . '/' . $row['filename'] . '"><button class="dwn"></button></a><big>' . $row['filename'] . '</big> | ' . $sizethis . '</li>';
	}
	?>
</files>
</div>
<div id="page2" class="page">
	<ul id="files">
<?php
	require_once('connectvars.php'); 

/* code to grab the files shared with the user */

 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 $myid=$_SESSION['userid']; 
$query = "SELECT * FROM sharedfiles WHERE shareid = '$myid' ORDER BY id DESC";				// query to get all the files
$data = mysqli_query($dbc, $query);
	while ($row2=mysqli_fetch_array($data)) {
		$fileid = $row2['fileid'];
		$query2 = "SELECT * FROM files WHERE id = '$fileid'";							// makes query to get all the files
$data2 = mysqli_query($dbc, $query2);
	while ($row=mysqli_fetch_array($data2)) {
		$sizethis=$row['filesize'];
		if ($sizethis>1)												// calculates the file size and displays the file size in user friendly format
		{
			$sizethis=$sizethis/1024;
			if ($sizethis>1)
			{
			$sizethis=$sizethis/1024;
			$sizethis = round($sizethis, 2) . " MB";
			}
			else {
			$sizethis = round($sizethis, 2) . " KB";
			}
		}
		else {
			$sizethis = round($sizethis, 2) . " bytes";
		}
		echo '<li id="./server/php/files/' . $row['directory'] . '/' . $row['filename'] . '"><a href="./server/php/files/' . $row['directory'] . '/' . $row['filename'] . '"><button class="dwn"></button></a>' . $row['filename'] . ' | ' . $sizethis . '</li>';
	}
}
	if (mysqli_num_rows($data)==0)
	{
		echo '<li>You have no files shared with you.</li>';
	}
	?>
</ul>
</div>
<div id="menubar">
	<button onclick="move()" id="shift">Switch to Shared Files view</button>
	
</div>
</div>
<div id="vid"></div>

<!-- an instantaneous way to play files as soon as the user places the mouse over that particular file -->

<div id="preview">
	<video id="prevplayer">
		<source id="music" src="music2.mp3"></source>
	</video>
</div>
<script src="./js/jquery.js"></script>
<script src="./js/viewall.js"></script>
</body>
</html>
