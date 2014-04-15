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
<link rel="stylesheet" href="./css/music.css" />

<script src="jquery.ui.min.js"></script>

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
	<a href="./home.php"><img src="./img/logo_main.png" id="logo_main" /></a><br />
<div id="content">
<div id="page1" class="page">

<ul id="files">
	<?php                                                                                                                                                   /* function which grabs all the audio files */
	require_once('connectvars.php'); 
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 $myid=$_SESSION['userid']; 

$query = "SELECT * FROM files WHERE shareid = '$myid' AND filetype='audio' ORDER BY filename DESC";
$data = mysqli_query($dbc, $query);
	while ($row=mysqli_fetch_array($data)) {
		echo '<div class="ui360 ui360-vis"><a href="./server/php/files/' . $row['directory'] . '/' . $row['filename'] . '">' . $row['filename'] . '</a></div>';
	}
	$query = "SELECT * FROM sharedfiles WHERE shareid = '$myid' ORDER BY id DESC";
$data = mysqli_query($dbc, $query);
	while ($row=mysqli_fetch_array($data)) {
		$fileid=$row['fileid'];
		$query2 = "SELECT * FROM files WHERE id = '$fileid' AND filetype='audio'";
$data2 = mysqli_query($dbc, $query2);
	while ($row2=mysqli_fetch_array($data2)) {

		echo '<div class="ui360 ui360-vis"><a href="./server/php/files/' . $row2['directory'] . '/' . $row2['filename'] . '">' . $row2['filename'] . '</a></div>';
	}
}
	?>
	</div>
</div>
<div id="menubar">
	</div>
</div>
<script src="./js/jquery.js"></script>
<script type="text/javascript" src="./js/music.js"></script>
<!-- <script src="./js/player.js"></script> -->
</body>
</html>
