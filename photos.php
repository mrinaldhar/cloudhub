<?php
ob_start(); 
session_start();

/* checks if the user is logged in or not */

if (!isset($_SESSION['userid']) || !isset($_SESSION['usernaam'])) {
$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php?err=noaccess'; 
          header('Location: ' . $home_url); 
}

?>
<html>
<head>
<title>
Cloudhub :: Photos
</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!-- links all the files which are required to be linked -->
<link rel="stylesheet" href="./css/bootstrap.css" />
<link rel="stylesheet" href="./css/basic.css" />
<link rel="stylesheet" href="./css/photos.css" />

</head>
<body>
	<h1>Photos</h1>
	<a href="./home.php"><img src="./img/logo_main.png" id="logo_main" /></a><br />
	<a href="./home.php"><button class="btn btn-success" id="backtodash">Back to Dashboard</button></a>
<div id="content">
<div id="page1" class="page">
	<?php
        /* code that will grab all the image files that are to be displayed */
	require_once('connectvars.php'); 
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 $myid=$_SESSION['userid']; 
$query = "SELECT * FROM files WHERE shareid = '$myid' AND filetype='image' ORDER BY filename DESC";
$data = mysqli_query($dbc, $query);
	while ($row=mysqli_fetch_array($data)) {
		echo '<img id="' . $row['id'] . '" src="./server/php/files/' . $row['directory'] . '/thumbnail/' . $row['filename'] . '" class="./server/php/files/' . $row['directory'] . '/' . $row['filename'] . '" />';
	}

	$query = "SELECT * FROM sharedfiles WHERE shareid = '$myid' ORDER BY id DESC";
$data = mysqli_query($dbc, $query);
	while ($row=mysqli_fetch_array($data)) {
		$fileid=$row['fileid'];
		$query2 = "SELECT * FROM files WHERE id = '$fileid' AND filetype='image'";
$data2 = mysqli_query($dbc, $query2);
	while ($row2=mysqli_fetch_array($data2)) {
		echo '<img id="' . $row2['id'] . '" src="./server/php/files/' . $row2['directory'] . '/thumbnail/' . $row2['filename'] . '" class="./server/php/files/' . $row2['directory'] . '/' . $row2['filename'] . '" />';
	}
}
	?>
	</div>
<div id="page2" class="page">
<img id="displaying" src="pic1.jpg">
</div>

<!-- menu bar is displyed when the user clicks on the photo -->
<div id="menubar">
	<button onclick="tags()" id="tagsbtn">PhotoTags</button>
	<button onclick="move()" id="shift">All your photos</button>
	<button onclick="loadcomments()" id="commentsbtn">Comments</button>
	</div>
</div>
<script src="./js/jquery.js"></script>

<script src="./js/photos.js"></script>


<!-- method through which photos can be commented -->
<div id="commentsdiv">
<ul id="comments">
<li>Loading comments...</li>
</ul> 
<div id="commenttext">
<input type="text" id="thecomment" name="thecomment" placeholder="Enter comment..." />
</div>
</div>

<!-- method through which the a photo can be searched that is through tags -->

<div id="tagsdiv">
PhotoTags help you quickly search for a particular photo
<input type="text" id="tagsval" name="tagsval" placeholder="Add tags" />
</div>

</body>
</html>
