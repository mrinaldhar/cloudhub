
function loader() {
	$('#diss_1').slideUp();
	$('#dashboard').slideDown();
}
function dopiano() {
	$('#logout').animate({
			opacity: 1
		}, 150);
	$('#uploadfiles').animate({
			opacity: 0.5,
			width:screen.width/7,
			height:screen.width/7,
			borderRadius: screen.width/14
		}, 150, function() {
			$('#uploadfiles').animate({
			opacity: 1

		}, 150);
			$('#viewall').animate({
			opacity: 0.5,
			width:screen.width/7,
			height:screen.width/7,
			borderRadius: screen.width/14
		}, 150, function() {
			$('#viewall').animate({
			opacity: 1
		}, 150);
			$('#music').animate({
			opacity: 0.5,
			width:screen.width/7,
			height:screen.width/7,
			borderRadius: screen.width/14
		}, 150, function() {
			$('#music').animate({
			opacity: 1
		}, 150);
			$('#photos').animate({
			opacity: 0.5,
			width:screen.width/7,
			height:screen.width/7,
			borderRadius: screen.width/14
		}, 150, function() {
			$('#photos').animate({
			opacity: 1
		}, 150);
			$('#videos').animate({
			opacity: 0.5,
			width:screen.width/7,
			height:screen.width/7,
			borderRadius: screen.width/14
		}, 150, function() {
			$('#videos').animate({
			opacity: 1
		}, 150);

			
		});
		});
		});
		});
		});
		
	
	
	
	
	
	
	
	
}
function start() {
	window.setTimeout(loader, 1000);
	window.setTimeout(dopiano, 1200);

}
$('document').ready(function() {
	start();
});

	var stop=0;
	function blink() {
		$(this).animate({
			opacity: 0.5
		}, 100);
		$(this).animate({
			opacity: 1
		}, 100);
			}
	
	$('.dashitem').mouseover(blink);
	$('#uploadfiles').click(function() {
		$(this).animate({
			height: "100%",
			width: "120%",
			borderRadius: 0
		}, 400, function()
		{
			window.location = 'uploadfiles.php';
		});
$('#logo_main').slideUp();
		$('#dashboard').css("margin-top", "0");
				$('#dashboard').css("width", "200%");
				$(this).css("margin-right", "0");
		$('h3').hide();
		$('#videos').hide();
		$('#photos').hide();
		$('#music').hide();
		$('#viewall').hide();
		$(this).mouseout();
		this.innerHTML = "";
		
	});

	$('#viewall').click(function() {
		$(this).animate({
			height: "100%",
			width: "120%",
			borderRadius: 0
		}, 400, function()
		{
			window.location = 'viewall.php';
		});
$('#logo_main').slideUp();
		$('#dashboard').css("margin-top", "0");
				$('#dashboard').css("width", "200%");
				$(this).css("margin-right", "0");
		$('h3').hide();
		$('#videos').hide();
		$('#photos').hide();
		$('#music').hide();
		$('#uploadfiles').hide();
		$(this).mouseout();
		this.innerHTML = "";
		
	});

	$('#music').click(function() {
		$(this).animate({
			height: "100%",
			width: "120%",
			borderRadius: 0
		}, 400, function()
		{
			window.location = 'music.php';
		});
$('#logo_main').slideUp();
		$('#dashboard').css("margin-top", "0");
				$('#dashboard').css("width", "200%");
				$(this).css("margin-right", "0");
		$('h3').hide();
		$('#videos').hide();
		$('#photos').hide();
		$('#uploadfiles').hide();
		$('#viewall').hide();
		$(this).mouseout();
		this.innerHTML = "";
		
	});

	$('#photos').click(function() {
		$(this).animate({
			height: "100%",
			width: "120%",
			borderRadius: 0
		}, 400, function()
		{
			window.location = 'photos.php';
		});
$('#logo_main').slideUp();
		$('#dashboard').css("margin-top", "0");
				$('#dashboard').css("width", "200%");
				$(this).css("margin-right", "0");
		$('h3').hide();
		$('#videos').hide();
		$('#uploadfiles').hide();
		$('#music').hide();
		$('#viewall').hide();
		$(this).mouseout();
		this.innerHTML = "";
		
	});

	$('#videos').click(function() {
		$(this).animate({
			height: "100%",
			width: "120%",
			borderRadius: 0
		}, 400, function()
		{
			window.location = 'videos.php';
		});
$('#logo_main').slideUp();
		$('#dashboard').css("margin-top", "0");
				$('#dashboard').css("width", "200%");
				$(this).css("margin-right", "0");
		$('h3').hide();
		$('#uploadfiles').hide();
		$('#photos').hide();
		$('#music').hide();
		$('#viewall').hide();
		$(this).mouseout();
		this.innerHTML = "";
		
	});
$('#searchbox').keyup(function() {
$.ajax({
        type:'get',
        data: {q: $('#searchbox').val()},
        url:'search.php',
		success:function(data){
			document.getElementById('res').innerHTML=data;
			$('#res').slideDown();


			$('.vidplay').hover(function() {
	// alert('hi');
	// alert(this.data)
	var video = document.getElementById('prevplayer');
	video.src=this.id;
	video.load();
	video.play();
	$('#preview').css("opacity", "1");
			$('.vidplay').mousemove(function(event) {
	
	$('#preview').css("top", event.pageY+10);
	$('#preview').css("left", event.pageX);
});
$('.vidplay').mouseout(function() {
	var video = document.getElementById('prevplayer');
	video.pause();
	$('#preview').css("opacity", "0");
});
});
        

      $('.audplay').hover(function() {
	// alert('hi');
	// alert(this.data)
	var video = document.getElementById('prevplayer');
	video.src=this.id;
	video.load();
	video.play();

$('.audplay').mouseout(function() {
	var video = document.getElementById('prevplayer');
	video.pause();
});
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
// 	if (e.which == 85) 
//     	{
// window.location="./uploadfiles.php";		}
// 	if (e.which == 86) 
//     	{
// window.location="./videos.php";		}
// 	if (e.which == 77) 
//     	{
// window.location="./music.php";		}
// 	if (e.which == 80) 
//     	{
// window.location="./photos.php";		}
// 	if (e.which == 65) 
//     	{
//     		window.location="./viewall.php";
// 		}
});