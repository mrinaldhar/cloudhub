<?php
ob_start();    						
session_start();

/* Checks if the user is logged in or not */
/* If user is not logged in then is redirected to the index page( login page )*/


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

<!-- list of all the files to be linked with so as to display things properly -->

  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="./css/bootstrap.css" />
<link rel="stylesheet" href="./css/home.css" />
<script src="./js/jquery.js"></script>

</head>

<body>

<div id="diss_1"></div>

<img src="./img/logo_black.png" id="logo_main" />                                                                    <!-- displays the main image on the home page of the user -->

<a href="logout.php"><button class="btn btn-danger" id="logout">Logout</button></a>                                  <!-- shows the logout button on the to-right corner of the page -->
<div id="dashboard">
	<div id="sresults">
<span id="bar"><input type="text" id="searchbox" name="searchbox" onclick="this.value=''" value="Search" /></span>   <!-- this is for the search box -->
<div id="res"></div>
</div>
<h3><?php 
$firstname = explode(' ', $_SESSION['usernaam'], 2);							             // extracts the username and then displays it on the home page
                                                    
echo $firstname[0]; ?>'s Dashboard   										   
</h3>

<!-- Displays all the buttons in order to surf through all the pages -->
										     
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

<!-- Whenver user searches for a file using the search bar the user gets a list of all the files -->
<!-- To instantly view the files the user can just place the mouse pointer over it and instantly listen to the music files or watch video files -->
<!-- for e.g. if the  mouse pointer is over a video file then that video will be played right in side of that file -->

<div id="action">

	</div>

<!-- this is the player which plays the videos and the music files instantly -->
<!-- the source of the files is passed through a javascript function defined in the javascript file ./js/home.js -->

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
