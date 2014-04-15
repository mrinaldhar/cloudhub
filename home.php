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
	CloudHub :: Home
</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="./css/bootstrap.css" />
<link rel="stylesheet" href="./css/home.css" />
<script src="./js/jquery.js"></script>

</head>
<body>
<div id="diss_1"></div>
<img src="./img/logo_black.png" id="logo_main" />

<a href="logout.php"><button class="btn btn-danger" id="logout">Logout</button></a>
<div id="dashboard">
	<div id="sresults">
<span id="bar"><input type="text" id="searchbox" name="searchbox" onclick="this.value=''" value="Search" /></span>
<div id="res"></div>
</div>
<h3><?php 
$firstname = explode(' ', $_SESSION['usernaam'], 2);

echo $firstname[0]; ?>'s Dashboard</h3>
<div id="uploadfiles" class="dashitem">Upload</div>
<div id="viewall" class="dashitem">My Files</div>
<div id="music" class="dashitem">Music</div>
<div id="photos" class="dashitem">Photos</div>
<div id="videos" class="dashitem">Videos</div>
<br /><br /><br />
<br /><br /><br />
<br /><br /><br />
<br /><br /><br />
</div>
<div id="action">

	</div>
<div id="vid"></div>
<div id="preview">
	<video id="prevplayer">
		<source id="music" src="music2.mp3"></source>
	</video>
</div>
	<script src="./js/home.js"></script>
</div>
</body>
</html>