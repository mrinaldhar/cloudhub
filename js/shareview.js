$('#logo_main').css("width", screen.width/4);
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

			$('.video').hover(function() {
	// alert('hi');
	// alert(this.data)
	var video = document.getElementById('prevplayer');
	video.src=this.id;
	video.load();
	video.play();
	$('#preview').css("opacity", "1");
			$('.video').mousemove(function(event) {
	
	$('#preview').css("top", event.pageY+10);
	$('#preview').css("left", event.pageX);
});
$('.video').mouseout(function() {
	var video = document.getElementById('prevplayer');
	video.pause();
	$('#preview').css("opacity", "0");
});
});
        

      $('.audio').hover(function() {
	// alert('hi');
	// alert(this.data)
	var video = document.getElementById('prevplayer');
	video.src=this.id;
	video.load();
	video.play();

$('.audio').mouseout(function() {
	var video = document.getElementById('prevplayer');
	video.pause();
});
});


var y = getOffset( document.getElementById('files') ).top;
var x = getOffset( document.getElementById('menubar') ).top;

var height=x-y;
// alert(height2);
$('ul').css("max-height", height-10);
$('#files li').click(function() {
	var owner;
	owner=this.getAttribute('data-whose');
	var filesid;
	filesid=this.getAttribute('data-value');
	if (owner=='mine')
	{

		$.ajax({
        type:'post',
        data: {id: filesid},
        url:'sharedo.php',
		success:function(data){

			// document.getElementById('res').innerHTML=data;
		}
	});
		$(this).css("text-align", "right");
	}
});