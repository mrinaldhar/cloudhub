<?php
ob_start();
session_start();
require_once('connectvars.php'); 
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$myid=$_SESSION['userid']; 
$fileid=$_POST['id'];
$buddyid=$_SESSION['buddyid'];
$query = "SELECT * FROM sharedfiles WHERE fileid='$fileid' AND userid='$myid' AND shareid='$buddyid'";
$data = mysqli_query($dbc, $query);

if (mysqli_num_rows($data)==0)
{
$query = "SELECT * FROM files WHERE id='$fileid' LIMIT 1";
$data = mysqli_query($dbc, $query);

if(mysqli_num_rows($data)!=0)
{
	while ($row=mysqli_fetch_array($data))
	{
		if ($row['userid']==$_SESSION['userid'])
		{
		$fileid = $row['id'];
		$filetype = $row['filetype'];
		$filesize = $row['filesize'];
		$directory = $row['directory'];
		$query2 = "INSERT INTO sharedfiles VALUES ('0', '$fileid','$myid', '$buddyid')";
		$data2 = mysqli_query($dbc, $query2);
	}
	}
}
}


?>
