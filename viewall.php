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
<style>
body {
	background-color: rgba(85,60,183,1);
	/*overflow-x: hidden;*/
	text-align: center;
}
#content {
	color:white;
	width:100%;
	padding:10px;
	display: block;
	margin-top: 100px;
}
.page {
	display:block;

	text-align: center;
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
	overflow: hidden;
}
#menubar {
	position:fixed;
	bottom:0px;
	width:100%;
	left:0px;
	right:0px;
	padding-top:5px;
	max-height: 55px;
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
#files {
	background-color: white;
	list-style-type: none;
	width:100%;
	color:black;
	text-align: left;
	padding:10px;
	margin-top: 10px;
	left:0px;
	right:0px;
	overflow-y:scroll;
}
#files li {
	padding: 10px;
}
#files li:hover {
	border: 1px solid;
	border-color: rgba(85,60,183,1);
	background-color: rgba(85,60,183, 0.2);
	cursor: pointer;
}
#shift:hover {
	background-color: rgba(0,0,0,0.8);

}
#shift {
	background-color: transparent;
	padding: 10px;
	border:none;
	color:white;
}
.dwn {
	background: url('img/download.png') center no-repeat;
	width:30px;
	height:32px;
	max-width: 30px;
	max-height: 32px;
	border:0px;
	vertical-align: top;
	margin-left: 10px;
}
.dwn:hover {
	border: 1px black dashed;
	cursor: pointer;
}
#sresults {
	display: inline-block;
	width:30%;
	position: fixed;
	left:35%;
	top:10%;
}
#searchbox {
	width:100%;
	padding:5px;
	outline-width: 0px;
	border-radius: 50px;
	padding-left: 20px;
	/*background-color: white;*/
	border: 0px;
	background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#eaeef1), to(#c7cfd8));
	background: -moz-linear-gradient(top, #eaeef1, #c7cfd8);
	background: linear-gradient(top, #eaeef1, #c7cfd8);
	box-shadow: 0px 0px 5px black;
}
#res {
	width:100%;
	display: none;
	margin-top:5px;
}
#resultitem {
	width:100%;
	display: block;
	line-height: 30px;
	color:black;
	padding:7px;
	font-size: 1.2em;
	background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#eaeef1), to(#c7cfd8));
	background: -moz-linear-gradient(top, #eaeef1, #c7cfd8);
	background: linear-gradient(top, #eaeef1, #c7cfd8);
}
#resultitem:hover {
	/*background-color: rgba(255,255,255,0.5);*/
}
.vidplay {
	width:100%;
	display: block;
	line-height: 30px;
	color:black;
	padding:7px;
	font-size: 1.2em;
	cursor: pointer;
	background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#eaeef1), to(#c7cfd8));
	background: -moz-linear-gradient(top, #eaeef1, #c7cfd8);
	background: linear-gradient(top, #eaeef1, #c7cfd8);
}
.audplay {
	width:100%;
	display: block;
	line-height: 30px;
	color:black;
	padding:7px;
	font-size: 1.2em;
	cursor: pointer;
	background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#eaeef1), to(#c7cfd8));
	background: -moz-linear-gradient(top, #eaeef1, #c7cfd8);
	background: linear-gradient(top, #eaeef1, #c7cfd8);
}
.dwn {
	float:right;
}
#preview {
	width:30%;
	position:absolute;
	opacity: 0;
	box-shadow: 0px 0px 20px black;
}
#prevplayer {
	width:100%;
}
</style>
<script>

</script>
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
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 $myid=$_SESSION['userid']; 
$query = "SELECT * FROM files WHERE userid = '$myid' ORDER BY filename DESC";
$data = mysqli_query($dbc, $query);
	while ($row=mysqli_fetch_array($data)) {
			$sizethis=$row['filesize'];
		if ($sizethis>1)
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
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 $myid=$_SESSION['userid']; 
$query = "SELECT * FROM files WHERE shareid = '$myid' AND userid != '$myid' ORDER BY filename DESC";
$data = mysqli_query($dbc, $query);
	while ($row=mysqli_fetch_array($data)) {
		$sizethis=$row['filesize'];
		if ($sizethis>1)
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
// $('#logo_main').css("margin-top", "10px");
$('#logo_main').css("width", screen.width/4);
function searchfunc() {
	
}
$('#searchbox').keyup(function() {
$.ajax({
        type:'get',
        data: {q: $('#searchbox').val()},
        url:'search.php',
		success:function(data){
			document.getElementById('res').innerHTML=data;
			$('#res').slideDown();


			$('.vidplay').hover(function() {
	// alert('hi');
	// alert(this.data)
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
	// alert('hi');
	// alert(this.data)
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
// 	if (e.which == 68) 
//     	{
// window.location="./home.php";	
// 	}
});
</script>
</body>
</html>