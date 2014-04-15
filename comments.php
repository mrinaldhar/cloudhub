<?php
ob_start(); session_start();

require_once('connectvars.php'); 
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
 if (isset($_GET['q']) && $_GET['q']!='')
 {
 $photoid = mysqli_real_escape_string($dbc, strip_tags($_GET['q'])); 
 $myid=$_SESSION['userid'];
$query = "SELECT * FROM files WHERE shareid='$myid' AND id='$photoid'";
$data = mysqli_query($dbc, $query);
if (mysqli_num_rows($data)!=0)
{
		$query2 = "SELECT * FROM comments WHERE photoid='$photoid'";
		$data2=mysqli_query($dbc, $query2);
			if (mysqli_num_rows($data2)==0)
		{
			echo '<li>No comments for this picture.</li>';
		}
		else {
			while ($row2=mysqli_fetch_array($data2))
		{
			echo '<li><big>' . $row2['comment'] . '</big><br /><small>' . $row2['username'] . '</small></li>';
		}
	}
}
else {
	$query = "SELECT * FROM sharedfiles WHERE shareid='$myid' AND fileid='$photoid'";
$data = mysqli_query($dbc, $query);
if (mysqli_num_rows($data)!=0)
{
		$query2 = "SELECT * FROM comments WHERE photoid='$photoid'";
		$data2=mysqli_query($dbc, $query2);
			if (mysqli_num_rows($data2)==0)
		{
			echo '<li>No comments for this picture.</li>';
		}
		else {
			while ($row2=mysqli_fetch_array($data2))
		{
			echo '<li><big>' . $row2['comment'] . '</big><br /><small>' . $row2['username'] . '</small></li>';
		}
}
}
}
}
?>
