$('#logo_main').css("width", screen.width/4);
// var offsets = $('#files').offset();
// var top = offsets.top;
// alert(top.value);

function move() {
	$('#page1').slideUp();
	$('#page2').slideDown();
	// $('#shift').text('Switch to My Files view');
}

var selected = {};
function changetrack()
{
move();
	var video = document.getElementById('player');
	video.src=selected.src;
	video.load();
	video.play();
}
$('li').click(function() {
$('li').removeClass();
	selected = {
		songname: this.innerHTML,
		src: this.id

	};
	this.className="active";
	// $(this).addClass('active');
	changetrack();

}); 

$('li').hover(function() {
	var video = document.getElementById('prevplayer');
	video.src=this.id;
	video.load();
	video.play();
	$('#preview').css("opacity", "1");
});
$('li').mousemove(function(event) {
	
	$('#preview').css("top", event.pageY+10);
	$('#preview').css("left", event.pageX);
});
$('li').mouseout(function() {
	var video = document.getElementById('prevplayer');
	video.pause();
	$('#preview').css("opacity", "0");
});
function stopplay() {
	var video = document.getElementById('player');
	video.pause();
	$('#page1').slideDown();
	$('#page2').slideUp();
}
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
var y = getOffset( document.getElementById('files') ).top;
var z = getOffset( document.getElementById('player') ).top;
var height=x-y;
var height2 = x-z;
// alert(height2);
$('#files').css("max-height", height-10);
$('video').css("max-height", height+50);
$(document).keyup(function(e) {
	if (e.which == 68) 
    	{
window.location="../home.php";	
	}
});