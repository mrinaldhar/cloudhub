
function loader() {
	$('#diss_1').slideUp();
	$('#theform').slideDown();
}
function set() {
window.setTimeout(loader, 1500);	
}
$(document).ready(function() { 
	set();
});


function regt(){

	$('#theform').slideUp();
	$('#reg_form').slideDown();
}

/* --------------------------------- */


/* a function which validates the user registration form */
function validate(){

	document.getElementById('namerr').innerHTML=""
	document.getElementById('nickerr').innerHTML=""
	document.getElementById('pwderr').innerHTML=""
	var uname=document.getElementById('regname').value;
	var flag = true;
	if (uname =="")
	{
		document.getElementById('namerr').innerHTML="Please enter your name"
		flag = false;
	}
	
	var nick=document.getElementById('regnick').value;
	if (nick == "")
	{
		document.getElementById('nickerr').innerHTML="Cloudnick cannot be empty"
		flag = false;
	}

	var email=document.getElementById('regemail').value;
	var atpos = email.indexOf("@");
	var dotpos = email.lastIndexOf(".");
	if (email == "" || atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= email.length)
	{
		document.getElementById('mailerr').innerHTML="Invalid Email address!";
		flag = false;
	}

	var passwd=document.getElementById('regpasswd').value;
	var conf=document.getElementById('confpasswd').value;
	if(passwd.length < 6)
	{
		document.getElementById('pwderr').innerHTML="Password must be greator than 6 characters in length";
		flag = false;
	}
	else if (passwd != conf)
	{
		document.getElementById('pwderr').innerHTML="Password Mismatch!";	
		flag = false;
	}

	return flag;
}

/* ---------------------------------- */
