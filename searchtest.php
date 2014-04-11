<html>
<head>
<title>Search</title>
<script src="js/jquery.js"></script>
<style>
li {

}
ul {
	list-style-type: none;
}

</style>

</head>
<body>
<input type="text" id="searchbox" name="searchbox" />

<ul id="sresults">
</ul><button id="btn" name="btn">Button</button>


<script>
$('#searchbox').keypress(function() {
 $.ajax({
        type:'get',
        data: {q: $('#searchbox').val()},
        url:'search.php',
		success:function(data){
			document.getElementById('sresults').innerHTML = data;
        }
    });
});

</script>
</body>

</html>