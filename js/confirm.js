function loader() {
	$('#diss_1').slideUp();
	$('#dashboard').slideDown();
}
function start() {
	window.setTimeout(loader, 1000);
}
$('document').ready(function() {
	start();

});