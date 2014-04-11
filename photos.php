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
Cloudhub :: Photos
</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

<link rel="stylesheet" href="./css/bootstrap.css" />
<link rel="stylesheet" href="./css/basic.css" />
<style>
body {
	background-color: rgba(116, 27, 44,1);
	overflow-y:hidden;
}
.page {
	display:block;
	text-align: center;
}
#content {
	color:white;
	width:100%;
	padding:10px;
	display: block;
	margin-top: 100px;
	text-align: center;
	max-height: screen.height;
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

#page1 {
	max-width:90%;
	width:90%;
	background-color: rgba(0,0,0,0.4);
	/*border-radius: 10px;*/
	padding-top:20px;
	margin:auto;
	padding-bottom: 20px;
	overflow: scroll;
	overflow-x:hidden;
	max-height: 500px;
	   -webkit-transition: opacity 0.5s ease-in;
            -moz-transition: opacity 0.5s ease-in;
            -o-transition: opacity 0.5s ease-in;
}
#page2 {
	width:100%;
	max-width:100%;
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
button:hover {
	background-color: rgba(0,0,0,0.8);
	cursor: pointer;
}
button {
	background-color: transparent;
	padding: 5px;
	border:none;
	color:white;
}
#page1 img {
	display:inline-block;
	height:100px;
	margin:7px;
}
#page1 img:hover {
	cursor: pointer;
}
#page2 img:hover {
	cursor: pointer;
}
#page2 img{
	max-height:100%;
	max-width: 100%;
}
#page2
{
            -webkit-transition: opacity 0.5s ease-in;
            -moz-transition: opacity 0.5s ease-in;
            -o-transition: opacity 0.5s ease-in;
     }
        #page2.fade-out
        {
            opacity:0;
        }
        #page2.fade-in
        {
            opacity:1;
        }
         #page1.fade-out
        {
            opacity:0;
        }
        #page1.fade-in
        {
            opacity:1;
        }

}
h1 {
	font-size: 1em;
}
#commentsdiv {
position: absolute;
right:0px;
bottom:50px;
display: none;
width:50%;
max-height:50%;
height:50%;
/*overflow: scroll;*/
background-color: rgba(0,0,0,0.4);
color:white;
padding:20px;
}
#tagsdiv {
position: absolute;
left:0px;
bottom:50px;
display: none;
width:45%;
max-height:20%;
height:20%;
/*overflow: scroll;*/
background-color: rgba(0,0,0,0.4);
color:white;
padding:20px;
}
#tagsbtn {
	opacity:0;
}
#commentsbtn {
	opacity: 0;
}
#tagsdiv input {
	position:absolute;
	bottom:0px;
	border-radius: 10px;

	padding: 5px;
	outline-width: 0;
	background-color: rgba(0,0,0,1);
	color:white;
	left:0;
	right:0;
	width: 100%;
}
#comments {
	list-style-type: none;
	/*overflow-y:scroll;*/
}
#comments li {
padding-top:20px;
padding-bottom: 20px;
background-color: rgba(0,0,0,0.4);
margin-bottom: 5px;
}
#thecomment {
	position:absolute;
	bottom:0px;
	border-radius: 10px;

	padding: 5px;
	outline-width: 0;
	background-color: rgba(0,0,0,1);
	color:white;
	left:0;
	right:0;
	width: 100%;
}
button {
	outline-width: 0px;
}
</style>
<script>

</script>
</head>
<body>
	<h1>Photos</h1>
	<a href="home.php"><img src="./img/logo_main.png" id="logo_main" /></a><br />
<div id="content">
<div id="page1" class="page">
	<?php
	require_once('connectvars.php'); 
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 $myid=$_SESSION['userid']; 
$query = "SELECT * FROM files WHERE shareid = '$myid' AND filetype='image' ORDER BY filename DESC";
$data = mysqli_query($dbc, $query);
	while ($row=mysqli_fetch_array($data)) {
		echo '<img id="' . $row['id'] . '" src="./server/php/files/' . $row['directory'] . '/thumbnail/' . $row['filename'] . '" class="./server/php/files/' . $row['directory'] . '/' . $row['filename'] . '" />';
	}
	?>
	</div>
<div id="page2" class="page">
<img id="displaying" src="pic1.jpg">
</div>
<div id="menubar">
	<button onclick="tags()" id="tagsbtn">PhotoTags</button>
	<button onclick="move()" id="shift">All your photos</button>
	<button onclick="loadcomments()" id="commentsbtn">Comments</button>
	</div>
</div>
<script src="./js/jquery.js"></script>

<script>
$('#logo_main').css("width", screen.width/4);

var i=0;
function move() {
	if (i%2==0)
	{
	$('#page1').slideUp();
	$('#page2').slideDown();
	document.getElementById("page1").className = "fade-out";
	document.getElementById("page2").className = "fade-in";
	$('#shift').text('Switch to Gallery');
	$('#tagsbtn').css("opacity", "1");
	$('#commentsbtn').css("opacity", "1");
}
else {

	$('#page1').slideDown();
	$('#page2').slideUp();
	document.getElementById("page2").className = "fade-out";
	document.getElementById("page1").className = "fade-in";
	$('#page1').css("overflow-y", "scroll");
	$('#shift').text('Switch to Photo');
	$('#commentsdiv').slideUp();
	$('#tagsdiv').slideUp();
	$('#tagsbtn').css("opacity", "0");
	$('#commentsbtn').css("opacity", "0");


}
i=i+1;
}
var selected = {};
$('img').click(function() {
	selected = {
		src: this.className,
		id: this.id
	};

	document.getElementById('displaying').src=selected.src;
	// var currentid=this.id;
	// alert(currentid);
    move();
});
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
var y = getOffset( document.getElementById('page1') ).top; 
var yy = $('#menubar').height(); 
var height=x-y;
var height2=height+yy;
$('#page1').css("max-height", height-10);
$('#page2').css("max-height", height2+10);
$('#page2').css("max-width", "100%");
$('#commentsdiv').css("max-width", screen.width/4);
$('#commentsdiv').css("width", screen.width/4);


// $('#commentsdiv').css("margin-bottom", "100");
$(document).keydown(function(e) {
    switch(e.which) {
        case 37: // left
		getleft();
	    break;

        case 39: // right
        getright();
        break;


        default: return; // exit this handler for other keys
    }
    e.preventDefault(); // prevent the default action (scroll / move caret)
});
function showpic() {
document.getElementById('displaying').src=selected.src;
}
function getleft()
{
	var now=document.getElementById(selected.id).previousSibling;
	if(now.src!=undefined)
	{
	selected = {
		src: now.src,
		id: now.id
	};
	showpic();
}
}
function getright()
{
	var now=document.getElementById(selected.id).nextSibling;
	if(now.src!=undefined)
	{
	selected = {
		src: now.src,
		id: now.id
	};
	showpic();
}
}
function loadcomments () {

	$('#commentsdiv').slideToggle();
	$('#thecomment').focus();
	var idtosend = selected.id;
	$.ajax({
        type:'get',
        data: {q: idtosend},
        url:'comments.php',
		success:function(data){
			document.getElementById('comments').innerHTML=data;
		}
	});
}
function tags() {
	$('#tagsdiv').slideToggle();
	$('#tagsval').focus();
}
function postcomment() {
	var commentval = document.getElementById('thecomment').value;
	if (commentval!='')
	{
	$.ajax({
        type:'post',
        data: {comment: commentval, photoid: selected.id},
        url:'postcomment.php',
		success:function(data){
			document.getElementById('comments').innerHTML+=data;
		}
	});
}
}

function addtags() {
	var tagval = document.getElementById('tagsval').value;
	if (tagval!='')
	{
	$.ajax({
        type:'post',
        data: {tags: tagval, photoid: selected.id},
        url:'addtags.php',
		success:function(data){
			document.getElementById('tagsdiv').innerHTML+=data;
		}
	});
}
}
$(document).keyup(function(e) {
    if (e.which == 13) 
    	{
    		if (document.getElementById('thecomment').value!='')
    		{
		postcomment();
	}
	if (document.getElementById('tagsval').value!='')
	{
		addtags();
	}
	}

});
</script>


<div id="commentsdiv">
<ul id="comments">
<li>Loading comments...</li>
</ul> 
<div id="commenttext">
<input type="text" id="thecomment" name="thecomment" placeholder="Enter comment..." />
</div>
</div>

<div id="tagsdiv">
PhotoTags help you quickly search for a particular photo
<input type="text" id="tagsval" name="tagsval" placeholder="Add tags" />
</div>

</body>
</html>