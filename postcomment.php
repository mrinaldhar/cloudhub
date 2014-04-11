<?php
ob_start();
session_start();
require_once('connectvars.php'); 
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
 if (isset($_POST['comment']) && $_POST['comment']!='' && isset($_SESSION['userid']) && isset($_POST['photoid']))
 {
 $photoid = mysqli_real_escape_string($dbc, strip_tags($_POST['photoid'])); 
 $comment = mysqli_real_escape_string($dbc, strip_tags($_POST['comment'])); 
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
		$q2 = "INSERT INTO comments VALUES (0, '$photoid', '$myid', '$comment', '$myname')";
		mysqli_query($dbc, $q2);
		echo '<li><big>'.$comment.'</big><br /><small>'.$myname.'</small></li>';
		break;
	}
}
}
else {
	echo 'Error: Stop it. This wont work.';
}
}
?>