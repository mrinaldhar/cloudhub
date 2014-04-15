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
Cloudhub :: ShareView
</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

<link rel="stylesheet" href="./css/bootstrap.css" />
<link rel="stylesheet" href="./css/basic.css" />
<style>
body {
	background-color: rgba(76, 40, 111, 1);
	overflow:hidden;
}
.page {

	text-align: center;
}
.active {
	border: 2px dashed;
	border-color: rgba(76,40,111,1);
	background-color: rgba(76,40,111,0.2);
}
#content {
	color:white;
	width:100%;
	padding:10px;
	display: block;
	margin-top: 100px;
	overflow:hidden;
}
#files {
	background-color: white;
	list-style-type: none;
	margin-right: 50px;
	margin-left: 50px;
	margin-top: 50px;
	color:black;
	text-align: left;
	padding:10px;
	border-radius: 10px;
	overflow-y:auto;
	overflow-x:hidden;
}
#files li {
	padding: 10px;
}
#files li:hover {
	border: 1px solid;
	border-color: rgba(76, 40, 111,1);
	background-color: rgba(76,40,111, 0.2);
	cursor: pointer;
}
video {
	width:100%;

}
#page1 {
	max-width:50%;
	width:50%;
	overflow: hidden;
	float:left;
}
#page2 {
	width:50%;
	float:right;
	display: inline-block;
	max-width:50%;
	overflow: hidden;
}
h1 {
	font-family: myFont;
	font-weight: lighter;
	position:relative;
	display: block;
	top:15px;
	left:50px;
	float:left;
	color:white;
	/*font-size: 0.5em;*/
}
#preview {
	width:30%;
	position:absolute;
	opacity: 0;
	box-shadow: 0px 0px 20px black;
}
</style>
</head>
<body>
<h1>ShareView</h1>
<?php
require_once('connectvars.php'); 
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 	$myid=$_SESSION['userid']; 
	if(isset($_GET['id']) && $_GET['id']!='')
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

	
$query = "SELECT * FROM files WHERE shareid='$theirid' AND userid='$myid'";
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
	
$query = "SELECT * FROM sharedfiles WHERE shareid = '$myid' AND userid = '$theirid'";
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
<div id="preview">
	<video id="prevplayer">
		<source id="music" src="music2.mp3"></source>
	</video>
</div>
<script src="./js/jquery.js"></script>

<script>
$('#logo_main').css("width", screen.width/4);
function getOffset( el ) {
    var _x = 0;
    var _y = 0;
    while( el && !isNaN( el.offsetLeft ) && !isNaN( el.offsetTop ) ) {
        _x += el.offsetLeft - el.scrollLeft;
        _y += el.offsetTop - el.scrollTop;
        el = el.offsetParent;
    }
    return { top: _y, left: _x };
}

			$('.video').hover(function() {
	// alert('hi');
	// alert(this.data)
	var video = document.getElementById('prevplayer');
	video.src=this.id;
	video.load();
	video.play();
	$('#preview').css("opacity", "1");
			$('.video').mousemove(function(event) {
	
	$('#preview').css("top", event.pageY+10);
	$('#preview').css("left", event.pageX);
});
$('.video').mouseout(function() {
	var video = document.getElementById('prevplayer');
	video.pause();
	$('#preview').css("opacity", "0");
});
});
        

      $('.audio').hover(function() {
	// alert('hi');
	// alert(this.data)
	var video = document.getElementById('prevplayer');
	video.src=this.id;
	video.load();
	video.play();

$('.audio').mouseout(function() {
	var video = document.getElementById('prevplayer');
	video.pause();
});
});


var y = getOffset( document.getElementById('files') ).top;
var x = getOffset( document.getElementById('menubar') ).top;

var height=x-y;
// alert(height2);
$('ul').css("max-height", height-10);
$('#files li').click(function() {
	var owner;
	owner=this.getAttribute('data-whose');
	var filesid;
	filesid=this.getAttribute('data-value');
	if (owner=='mine')
	{

		$.ajax({
        type:'post',
        data: {id: filesid},
        url:'sharedo.php',
		success:function(data){

			// document.getElementById('res').innerHTML=data;
		}
	});
		$(this).css("text-align", "right");
	}
});
</script>
</body>
</html>