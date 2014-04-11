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
<style>
body {
	background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#eaeef1), to(#c7cfd8));
	background: -moz-linear-gradient(top, #eaeef1, #c7cfd8);
	background: linear-gradient(top, #eaeef1, #c7cfd8);
}
#logout {
	position: absolute;
	top:30px;
	right:50px;
	opacity: 0;
}
h3 {
	margin-bottom: 20px;
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
	opacity: 0.7;
	display:inline;
	outline-width: 0px;
}
.dwn:hover {
	opacity:1;
	cursor: pointer;
}
#resultitem a {
	text-decoration: none;
	color:darkblue;
}
#sresults {
	display: inline-block;
	width:30%;
	position: fixed;
	left:35%;
	top:5%;
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
 #res a {
 	text-decoration: none;
 }
#resultitem:hover {
	/*background-color: rgba(255,255,255,0.5);*/
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
.dwn {
	float:right;
}
</style>
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
	<script>
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
			$('.vidplay').mousemove(function(event) {
	
	$('#preview').css("top", event.pageY+10);
	$('#preview').css("left", event.pageX);
});
$('.vidplay').mouseout(function() {
	var video = document.getElementById('prevplayer');
	video.pause();
	$('#preview').css("opacity", "0");
});
});
        

      $('.audplay').hover(function() {
	// alert('hi');
	// alert(this.data)
	var video = document.getElementById('prevplayer');
	video.src=this.id;
	video.load();
	video.play();

$('.audplay').mouseout(function() {
	var video = document.getElementById('prevplayer');
	video.pause();
});
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
// 	if (e.which == 85) 
//     	{
// window.location="./uploadfiles.php";		}
// 	if (e.which == 86) 
//     	{
// window.location="./videos.php";		}
// 	if (e.which == 77) 
//     	{
// window.location="./music.php";		}
// 	if (e.which == 80) 
//     	{
// window.location="./photos.php";		}
// 	if (e.which == 65) 
//     	{
//     		window.location="./viewall.php";
// 		}
});



</script>
</div>
</body>
</html>