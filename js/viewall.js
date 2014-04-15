var i=0;
function move() {
	if (i%2==0)
	{
	$('#page1').slideUp();
	$('#page2').slideDown();
	$('#shift').text('Switch to My Files view');
}
else {
	$('#page1').slideDown();
	$('#page2').slideUp();
	$('#shift').text('Switch to Shared Files view');

}
i=i+1;
}
$('#logo_main').css("width", screen.width/4);




/* the search function which searches for your files if you wish to seacrh for one */
function searchfunc() {
	
}
$('#search').keyup(function() {
$.ajax({													// gives an ajax call
        type:'get',
        data: {q: $('#search').val()},									// sends the parameter to search with
        url:'search.php',
		success:function(data){
			document.getElementById('res').innerHTML=data;
			$('#res').slideDown();


			$('.vidplay').hover(function() {							// instantaneosly loads the video and plays it as soon as the user places the mouse over it
	
	
	var video = document.getElementById('prevplayer');
	video.src=this.id;
	video.load();
	video.play();
	$('#preview').css("opacity", "1");
});	
			$('.vidplay').mousemove(function(event) {
	
	$('#preview').css("top", event.pageY+10);
	$('#preview').css("left", event.pageX);
});
$('.vidplay').mouseout(function() {									
	var video = document.getElementById('prevplayer');
	video.pause();
	$('#preview').css("opacity", "0");
});
        

      $('.audplay').hover(function() {
	var video = document.getElementById('prevplayer');
	video.src=this.id;
	video.load();
	video.play();
});	
$('.audplay').mouseout(function() {
	var video = document.getElementById('prevplayer');
	video.pause();
});

        }
    });
});
var keydetect = 0;
$(document).keyup(function(e) {
    if (e.which == 83) 
    	{
		$('#searchbox').focus();
		}
});

$('#search').blur(function() {
	$('#res').slideUp();
});