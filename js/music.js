$('#logo_main').css("width", screen.width/4);
// var offsets = $('#files').offset();
// var top = offsets.top;
// alert(top.value);

// function changetrack()
// {
// 	// alert(selected.src);
// 	var audio = document.getElementById('playergear');
// 	audio.src=selected.src;
// 	var songname=document.getElementById('songname');
// 	songname.innerHTML=selected.songname;
// 	audio.load();
// 	audio.play();
// }
// var selected = {};
// $('li').click(function() {
// 	$('li').removeClass();
// 	selected = {
// 		songname: this.innerHTML,
// 		src: this.id

// 	};
// 	this.className="active";
// 	// $(this).addClass('active');
// 	changetrack();
// });
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
var y = getOffset( document.getElementById('files') ).top
var height=x-y;
$('#files').css("max-height", height-10);
$(document).keyup(function(e) {
	if (e.which == 68) 
    	{
window.location="../home.php";	
	}
});