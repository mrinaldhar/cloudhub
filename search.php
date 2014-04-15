<?php
ob_start(); session_start();

require_once('connectvars.php'); 
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
 if (isset($_GET['q']) && $_GET['q']!='' && $_GET['q']!=' ')
 {
 $term = mysqli_real_escape_string($dbc, strip_tags($_GET['q'])); 


/* now the entire codes throughout will search for the files according to parameter provided and then will display it to th user */
/* it is also taken care that only the files that have shared with you are displayed and that no ither sharing that happened between different users is displayed */


//Search user table
$query = "SELECT * FROM users WHERE nickname LIKE '%$term%' OR email LIKE '%$term%' OR naam LIKE '%$term%'";
$data = mysqli_query($dbc, $query);
if (mysqli_num_rows($data)!=0)
{
while ($row=mysqli_fetch_array($data))
{
	echo '<a href="shareview.php?id='.$row['id'] . '"><span id="resultitem">(User) ' . $row['naam'] . '</span></a>';
}
}
$myid = $_SESSION['userid'];

//Search File table
$query = "SELECT * FROM files WHERE filename LIKE '%$term%' AND shareid = '$myid'";
$data = mysqli_query($dbc, $query);
if (mysqli_num_rows($data)!=0)
{
while ($row=mysqli_fetch_array($data))
{
	echo '<span ';
	if ($row['filetype']=='audio')
	{
		echo 'id="./server/php/files/' . $row['directory'] . '/' . $row['filename'] . '" class="audplay"';
	}
	else if ($row['filetype']=='video')
	{
		echo 'id="./server/php/files/' . $row['directory'] . '/' . $row['filename'] . '" class="vidplay"';

	}
	else if ($row['filetype']=='image')
	{
		echo 'id="resultitem"><img src="./server/php/files/' . $row['directory'] . '/thumbnail/' . $row['filename'] . '" height="50px" /';

	}
	else {
		echo 'id="resultitem"';
	}
	echo '>(' . $row['filetype'] . ') ' . $row['filename'] . '</a><a href="./server/php/files/' . $row['directory'] . '/' . $row['filename'] . '"><button class="dwn"></button></a></span>';

}
}

$query = "SELECT * FROM sharedfiles WHERE shareid = '$myid' ORDER BY id DESC";
$data = mysqli_query($dbc, $query);
	while ($row2=mysqli_fetch_array($data)) {
		$fileid=$row2['fileid'];
		$query2 = "SELECT * FROM files WHERE filename LIKE '%$term%' AND id = '$fileid'";
$data2 = mysqli_query($dbc, $query2);
	while ($row=mysqli_fetch_array($data2)) {
echo '<span ';
	if ($row['filetype']=='audio')
	{
		echo 'id="./server/php/files/' . $row['directory'] . '/' . $row['filename'] . '" class="audplay"';
	}
	else if ($row['filetype']=='video')
	{
		echo 'id="./server/php/files/' . $row['directory'] . '/' . $row['filename'] . '" class="vidplay"';

	}
	else if ($row['filetype']=='image')
	{
		echo 'id="resultitem"><img src="./server/php/files/' . $row['directory'] . '/thumbnail/' . $row['filename'] . '" height="50px" /';

	}
	else {
		echo 'id="resultitem"';
	}
	echo '>(' . $row['filetype'] . ') ' . $row['filename'] . '</a><a href="./server/php/files/' . $row['directory'] . '/' . $row['filename'] . '"><button class="dwn"></button></a></span>';

	}
}


/* search implementation using phototags */
//Search PhotoTags
$query = "SELECT * FROM tags WHERE tags LIKE '%$term%' AND userid='$myid'";
$data2 = mysqli_query($dbc, $query);
if (mysqli_num_rows($data2)!=0)
{
	while ($row2=mysqli_fetch_array($data2))
	{
		$photoid = $row2['photoid'];
		$q2 = "SELECT * FROM FILES WHERE id='$photoid' AND shareid='$myid'";
		$data = mysqli_query($dbc, $q2);
		while ($row=mysqli_fetch_array($data))
{
	echo '<span ';
	
		echo 'id="resultitem"><img src="./server/php/files/' . $row['directory'] . '/thumbnail/' . $row['filename'] . '" /';

	
	echo '>(' . $row['filetype'] . ') ' . $row['filename'] . '</a><a href="./server/php/files/' . $row['directory'] . '/' . $row['filename'] . '"><button class="dwn"></button></a></span>';

}
	}
}


}
?>
