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
		document.getElementById('thecomment').value='';
	}
	if (document.getElementById('tagsval').value!='')
	{
		addtags();
		document.getElementById('tagsval').value='';
	}
	}

});
