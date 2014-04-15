<?php
ob_start();
session_start();
require_once('connectvars.php'); 
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
 if (isset($_POST['tags']) && $_POST['tags']!='' && isset($_SESSION['userid']) && isset($_POST['photoid']))
 {
 $photoid = mysqli_real_escape_string($dbc, strip_tags($_POST['photoid'])); 
 $tags = mysqli_real_escape_string($dbc, strip_tags($_POST['tags'])); 
 $myid=$_SESSION['userid'];
$query = "SELECT * FROM files WHERE shareid='$myid'";
$data = mysqli_query($dbc, $query);
$myname = $_SESSION['usernaam'];
if (mysqli_num_rows($data)!=0)
{
	while ($row=mysqli_fetch_array($data))
{
	if ($row['id']=$photoid)
	{
		$q2 = "INSERT INTO tags VALUES (0, '$myid', '$photoid', '$tags')";
		mysqli_query($dbc, $q2);
		echo '<br /><big>'.$tags.'</big><br /><small>Tags Added</small>';
		break;
	}
}
}
else {
$query = "SELECT * FROM sharedfiles WHERE shareid='$myid'";
$data = mysqli_query($dbc, $query);
$myname = $_SESSION['usernaam'];
if (mysqli_num_rows($data)!=0)
{
	while ($row=mysqli_fetch_array($data))
{
	if ($row['fileid']=$photoid)
	{
		$q2 = "INSERT INTO tags VALUES (0, '$myid', '$photoid', '$tags')";
		mysqli_query($dbc, $q2);
		echo '<br /><big>'.$tags.'</big><br /><small>Tags Added</small>';
		break;
	}
}

}
}
?>