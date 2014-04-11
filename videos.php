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
<style>
body {
	background-color: rgba(76, 40, 111, 1);
	overflow-y:hidden;
	overflow-x:hidden;
}
.page {
	display:block;

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
	overflow-y:scroll;
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
	max-width:100%;
	width:100%;
	overflow: hidden;
}
#page2 {
	width:100%;
	max-width:100%;
	display:none;
	box-shadow: 0px 0px 100px black;
}
#menubar {
	position:fixed;
	bottom:0px;
	width:100%;
	left:0px;
	right:0px;
	padding-top:5px;
	padding-bottom: 5px;
	background-color: rgba(0,0,0,0.4);
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
#shift:hover {
	background-color: rgba(0,0,0,0.8);
	cursor: pointer;
}
#shift {
	background-color: transparent;
	padding: 5px;
	border:none;
	color:white;
}
#preview {
	width:30%;
	position:absolute;
	opacity: 0;
	box-shadow: 0px 0px 20px black;
}
</style>
<script>

</script>
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

<script>
$('#logo_main').css("width", screen.width/4);
// var offsets = $('#files').offset();
// var top = offsets.top;
// alert(top.value);

function move() {
	$('#page1').slideUp();
	$('#page2').slideDown();
	// $('#shift').text('Switch to My Files view');
}

var selected = {};
function changetrack()
{
move();
	var video = document.getElementById('player');
	video.src=selected.src;
	video.load();
	video.play();
}
$('li').click(function() {
$('li').removeClass();
	selected = {
		songname: this.innerHTML,
		src: this.id

	};
	this.className="active";
	// $(this).addClass('active');
	changetrack();

}); 

$('li').hover(function() {
	var video = document.getElementById('prevplayer');
	video.src=this.id;
	video.load();
	video.play();
	$('#preview').css("opacity", "1");
});
$('li').mousemove(function(event) {
	
	$('#preview').css("top", event.pageY+10);
	$('#preview').css("left", event.pageX);
});
$('li').mouseout(function() {
	var video = document.getElementById('prevplayer');
	video.pause();
	$('#preview').css("opacity", "0");
});
function stopplay() {
	var video = document.getElementById('player');
	video.pause();
	$('#page1').slideDown();
	$('#page2').slideUp();
}
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
var x = getOffset( document.getElementById('menubar') ).top; 
var y = getOffset( document.getElementById('files') ).top;
var z = getOffset( document.getElementById('player') ).top;
var height=x-y;
var height2 = x-z;
// alert(height2);
$('#files').css("max-height", height-10);
$('video').css("max-height", height+50);
$(document).keyup(function(e) {
	if (e.which == 68) 
    	{
window.location="./home.php";	
	}
});
</script>
</body>
</html>