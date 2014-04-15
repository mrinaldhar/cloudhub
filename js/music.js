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
