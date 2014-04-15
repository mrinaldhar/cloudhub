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
	
	<a href="home.php"><img src="./img/logo_main.png" id="logo_main" /></a>
<div id="sresults">
<span id="bar"><input type="text" id="searchbox" name="searchbox" onclick="this.value=''" value="Search" /></span>
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
$query = "SELECT * FROM files WHERE shareid = '$myid' AND userid != '$myid' ORDER BY filename DESC";				// query to get all the files
$data = mysqli_query($dbc, $query);
	while ($row=mysqli_fetch_array($data)) {
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
<script>
var i=0;
function move() {
	if (i%2==0)
	{
	$('#page1').slideUp();
	$('#page2').slideDown();
	$('#shift').text('Switch to My Files view');
}
else {
	$('#page1').slideDown();
	$('#page2').slideUp();
	$('#shift').text('Switch to Shared Files view');

}
i=i+1;
}
$('#logo_main').css("width", screen.width/4);




/* the search function which searches for your files if you wish to seacrh for one */
function searchfunc() {
	
}
$('#searchbox').keyup(function() {
$.ajax({													// gives an ajax call
        type:'get',
        data: {q: $('#searchbox').val()},									// sends the parameter to search with
        url:'search.php',
		success:function(data){
			document.getElementById('res').innerHTML=data;
			$('#res').slideDown();


			$('.vidplay').hover(function() {							// instantaneosly loads the video and plays it as soon as the user places the mouse over it
	
	
	var video = document.getElementById('prevplayer');
	video.src=this.id;
	video.load();
	video.play();
	$('#preview').css("opacity", "1");
});	
			$('.vidplay').mousemove(function(event) {
	
	$('#preview').css("top", event.pageY+10);
	$('#preview').css("left", event.pageX);
});
$('.vidplay').mouseout(function() {									
	var video = document.getElementById('prevplayer');
	video.pause();
	$('#preview').css("opacity", "0");
});
        

      $('.audplay').hover(function() {
	var video = document.getElementById('prevplayer');
	video.src=this.id;
	video.load();
	video.play();
});	
$('.audplay').mouseout(function() {
	var video = document.getElementById('prevplayer');
	video.pause();
});

        }
    });
});
var keydetect = 0;
$(document).keyup(function(e) {
    if (e.which == 83) 
    	{
		$('#searchbox').focus();
		}
});
</script>
</body>
</html>
