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
Cloudhub :: Music
</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

<link rel="stylesheet" href="./css/bootstrap.css" />
<link rel="stylesheet" href="./css/basic.css" />
<link rel="stylesheet" href="./css/testmusic.css" />
<script src="jquery.ui.min.js"></script>
<style>
body {
	background-color: rgba(0,95,0, 1);
	overflow-y:hidden;
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
#page1 {
	overflow: hidden;
}
#files li:hover {
	border: 1px solid;
	border-color: rgba(0,95,0,1);
	background-color: rgba(0,95, 0, 0.2);
	cursor: pointer;
}
#menubar {
	position:fixed;
	bottom:0px;
	width:100%;
	left:0px;
	right:0px;
	background-color: rgba(0,0,0,0.4);
	color:white;
}
.player {
	width:100%;
	/*background-color: rgba(0,0,0,0.4);*/
		background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#eaeef1), to(#c7cfd8));
	background: -moz-linear-gradient(top, #eaeef1, #c7cfd8);
	background: linear-gradient(top, #eaeef1, #c7cfd8);
	color:black;
	height:80px;
	max-height:80px;
	border-top-right-radius:20px; 
	border-top-left-radius:20px;
}

.active {
	border: 2px dashed;
	border-color: rgba(0,95,0,1);
	background-color: rgba(0,95,0,0.2);
}
</style>
<!-- soundManager.useFlashBlock: related CSS -->
<link rel="stylesheet" type="text/css" href="../flashblock/flashblock.css" />

<!-- required -->
<link rel="stylesheet" type="text/css" href="./css/360player.css" />
<link rel="stylesheet" type="text/css" href="./css/360player-visualization.css" />

<!-- special IE-only canvas fix -->
<!--[if IE]><script type="text/javascript" src="script/excanvas.js"></script><![endif]-->

<!-- Apache-licensed animation library -->
<script type="text/javascript" src="./js/berniecode-animator.js"></script>

<!-- the core stuff -->
<script type="text/javascript" src="./js/soundmanager2.js"></script>
<script type="text/javascript" src="./js/360player.js"></script>

<script type="text/javascript">

soundManager.setup({
  // path to directory containing SM2 SWF
  url: './swf/'
});

threeSixtyPlayer.config.scaleFont = (navigator.userAgent.match(/msie/i)?false:true);
threeSixtyPlayer.config.showHMSTime = true;

// enable some spectrum stuffs

threeSixtyPlayer.config.useWaveformData = true;
threeSixtyPlayer.config.useEQData = true;

// enable this in SM2 as well, as needed

if (threeSixtyPlayer.config.useWaveformData) {
  soundManager.flash9Options.useWaveformData = true;
}
if (threeSixtyPlayer.config.useEQData) {
  soundManager.flash9Options.useEQData = true;
}
if (threeSixtyPlayer.config.usePeakData) {
  soundManager.flash9Options.usePeakData = true;
}

if (threeSixtyPlayer.config.useWaveformData || threeSixtyPlayer.flash9Options.useEQData || threeSixtyPlayer.flash9Options.usePeakData) {
  // even if HTML5 supports MP3, prefer flash so the visualization features can be used.
  soundManager.preferFlash = true;
}

// favicon is expensive CPU-wise, but can be used.
if (window.location.href.match(/hifi/i)) {
  threeSixtyPlayer.config.useFavIcon = true;
}

if (window.location.href.match(/html5/i)) {
  // for testing IE 9, etc.
  soundManager.useHTML5Audio = true;
}

</script>
</head>
<body>

	<h1 id="h1">Music</h1>
	<a href="home.php"><img src="./img/logo_main.png" id="logo_main" /></a><br />
<div id="content">
<div id="page1" class="page">

<ul id="files">
	<?php
	require_once('connectvars.php'); 
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 $myid=$_SESSION['userid']; 
$query = "SELECT * FROM files WHERE shareid = '$myid' AND filetype='audio' ORDER BY filename DESC";
$data = mysqli_query($dbc, $query);
	while ($row=mysqli_fetch_array($data)) {
		echo '<div class="ui360 ui360-vis"><a href="./server/php/files/' . $row['directory'] . '/' . $row['filename'] . '">' . $row['filename'] . '</a></div>';
	}
	?>
	</div>
</div>
<div id="menubar">
	</div>
</div>
<script src="./js/jquery.js"></script>

<!-- <script src="./js/player.js"></script> -->
<script>
$('#logo_main').css("width", screen.width/4);
// var offsets = $('#files').offset();
// var top = offsets.top;
// alert(top.value);

// function changetrack()
// {
// 	// alert(selected.src);
// 	var audio = document.getElementById('playergear');
// 	audio.src=selected.src;
// 	var songname=document.getElementById('songname');
// 	songname.innerHTML=selected.songname;
// 	audio.load();
// 	audio.play();
// }
// var selected = {};
// $('li').click(function() {
// 	$('li').removeClass();
// 	selected = {
// 		songname: this.innerHTML,
// 		src: this.id

// 	};
// 	this.className="active";
// 	// $(this).addClass('active');
// 	changetrack();
// });
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
var y = getOffset( document.getElementById('files') ).top
var height=x-y;
$('#files').css("max-height", height-10);
$(document).keyup(function(e) {
	if (e.which == 68) 
    	{
window.location="./home.php";	
	}
});
</script>
</body>
</html>