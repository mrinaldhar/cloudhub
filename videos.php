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
Cloudhub :: Videos
</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

<link rel="stylesheet" href="./css/bootstrap.css" />
<link rel="stylesheet" href="./css/basic.css" />
<link rel="stylesheet" href="./css/videos.css" />
</head>
<body>

	<h1>Videos</h1>
	<a href="home.php"><img src="./img/logo_main.png" id="logo_main" /></a><br />
<div id="content">
<div id="page1" class="page">
<ul id="files">
	<?php
	require_once('connectvars.php'); 
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 $myid=$_SESSION['userid']; 
$query = "SELECT * FROM files WHERE shareid = '$myid' AND filetype='video' ORDER BY filename DESC";
$data = mysqli_query($dbc, $query);
	while ($row=mysqli_fetch_array($data)) {
		echo '<li id="./server/php/files/' . $row['directory'] . '/' . $row['filename'] . '">' . $row['filename'] . '</li>';
	}
	$query = "SELECT * FROM sharedfiles WHERE shareid = '$myid' ORDER BY id DESC";
$data = mysqli_query($dbc, $query);
	while ($row=mysqli_fetch_array($data)) {
		$fileid=$row['fileid'];
		$query2 = "SELECT * FROM files WHERE id = '$fileid' AND filetype='video'";
$data2 = mysqli_query($dbc, $query2);
	while ($row2=mysqli_fetch_array($data2)) {
		echo '<li id="./server/php/files/' . $row2['directory'] . '/' . $row2['filename'] . '">' . $row2['filename'] . '</li>';
	
	}
}
	?>
	</ul>
</div>
<div id="page2" class="page">
	<div id="playerspan">
	<video id="player" controls>
		<source id="music" src="music2.mp3"></source>
	</video>
</div>
	</div>

<div id="menubar">
	<button id="shift" onclick="stopplay()">All your videos</button></a>
	</div>
</div>
<div id="preview">
	<video id="prevplayer">
		<source id="music" src="music2.mp3"></source>
	</video>
</div>
<script src="./js/jquery.js"></script>
<script src="./js/videos.js"></script>

</body>
</html>