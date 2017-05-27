/* LOG IN VALIDATION BELOW */

/* Kod-referens: https://www.youtube.com/watch?v=0T-awOV78DE */

$(function(){

	$("#login_button").click(function(){

		$("#login_button").hide();

		var username = $("#username").val();
		var password = $("#password").val();

		$.post("db/log_in.php", { username: username, password: password})
		.done(function( data ) {

			if (data == "success") {
				window.location.assign("profile.php");
			} else {
				$("#login_message").text("Invalid username or password");
				$("#login_button").show();
			}
		});
	});

});

/* END LOG IN VALIDATION */

// KOD INSPIREREAD AV FÖLJANDE KÄLLA:
// https//:www.youtube.com/watch?v=CaRZEdYRfaU


$(function (){

	$("#error_username").hide();
	$("#error_password").hide();
	$("#error_confirm_password").hide();
	$("#error_email").hide();
	$("#error_submit").hide();

	var error_username = false;
	var error_password = false;
	var error_username_avalibility = false;
	var error_confirm_password = false;
	var error_email = false;
	var error_submit = false;

	$("#reg_username").focusout(function(){

		check_username();
		checkAvailability();
		
	});
	$("#reg_password").focusout(function(){

		check_password();
		
	});
	$("#reg_confirm_password").focusout(function(){

		check_confirm_password();
		
	});
	$("#reg_email").focusout(function(){

		check_email();
		
	});

	function check_username() {
		var length = $("#reg_username").val().length;
		if (length < 3 || length > 20) {
			$("#error_username").html("Must be between 3 - 20 characters");
			$("#error_username").show();
			error_username = true;
		}
		else{

//KOD-REFERENS
//http://phppot.com/jquery/live-username-availability-check-using-php-and-jquery-ajax/

		$("#error_username").hide();

		}

};

//SLUT PÅ KODREFERENS 

	function checkAvailability() {
		jQuery.ajax({
		url: "functions/get_username_status.php",
		data:'user='+$("#reg_username").val(),
		type: "POST",
		success:function(data){
			if (data == "<span class='status-not-available'> Username not available.</span>") {
				error_username_avalibility = true;
				alert('sssss');
			}
			
			$("#user-availability-status").html(data);
		},
		error:function (){
			alert('error');
		}
		});
	};

function check_password() {
	var length = $("#reg_password").val().length;
	if (length < 4) {
		$("#error_password").html("Must be 5 characters or more");
		$("#error_password").show();
		error_password = true;
	}
	else{

		$("#error_password").hide();
	}
};

function check_confirm_password() {

	var pass = $("#reg_password").val();
	var confirm_pass = $("#reg_confirm_password").val();

	if (pass != confirm_pass) {
		$("#error_confirm_password").html("Password doesn't match");
		$("#error_confirm_password").show();
		error_confirm_password = true;
	}
	else{

		$("#error_confirm_password").hide();
	}
};

function check_email() {
	
	if ($("#reg_email").val().length == 0) {
		$("#error_email").html("Enter your email");
		$("#error_email").show();
		error_email = true;
	}
	else{

		$("#error_email").hide();
	}
};

$("#reg_button").click(function(){

	error_username = false;
	error_password = false;
	error_confirm_password = false;
	error_email = false;
	error_username_avalibility = false;


	check_username();
	check_password();
	check_confirm_password();
	check_email();
	checkAvailability();

	if (error_username == false && error_username_avalibility == false && error_password == false && error_confirm_password == false && error_email ==false) {

		var clicked = "yes";
		var username = $("#reg_username").val();
		var password = $("#reg_password").val();
		var email = $("#reg_email").val();
		var firstname = $("#reg_firstname").val();
		var lastname = $("#reg_lastname").val();

		$.post("db/register.php", { username: username, password: password, email: email, firstname: firstname, lastname: lastname, clicked: clicked })
		.done(function( data ) {

			if (data == "success") {

				window.location.assign("profile.php");
			} else {
				error_submit = true;
				$("#error_submit").show();
				$("#error_submit").text("Registration failed. See error above.");
			}
		});
	} 

	else {

		$("#error_submit").text("All mandatory fields requred");
		$("#error_submit").show();

	}

});

});


$(function() {
	var path = window.location.pathname;
	path = path.replace(/\/$/, "");
	path = decodeURIComponent(path);

	
/*
	switch (path){

		case "/index.php":
		$("#thread_div").html("<a href='index.php'>Home</a>");
		break;
		case "/profile.php":
		$("#thread_div").html("<a href='index.php'>Home</a> >> <a href='#'>Profile</a>");
		break;
		case "/view_profile.php":
		$("#thread_div").html("<a href='index.php'>Home</a> >> <a href='#'>View profile</a>");
		break;
		case "/view_topic.php":
		$("#thread_div").html("<a href='index.php'>Home</a> >> <a href='#'>View topic</a>");
		break;
		case "/post_topic.php":
		$("#thread_div").html("<a href='index.php'>Home</a> >> <a href='#'>Create topic</a>");
		break;
		case "/view_search_result.php":
		$("#thread_div").html("<a href='index.php'>Home</a> >> <a href='#'>Search</a>");
		break;

		default:
		$("#thread_div").html("tja");
		break;
	} 
	*/

/* FOR LOCAL USE */

	switch (path){

		case "/forum2_OFFLINE/index.php":
		$("#thread_div").html("<a href='index.php'>Home</a>");
		break;
		case "/forum2_OFFLINE/profile.php":
		$("#thread_div").html("<a href='index.php'>Home</a> >> <a href='#'>Profile</a>");
		break;
		case "/forum2_OFFLINE/view_profile.php":
		$("#thread_div").html("<a href='index.php'>Home</a> >> <a href='#'>View profile</a>");
		break;
		case "/forum2_OFFLINE/view_topic.php":
		$("#thread_div").html("<a href='index.php'>Home</a> >> <a href='#'>View topic</a>");
		break;
		case "/forum2_OFFLINE/post_topic.php":
		$("#thread_div").html("<a href='index.php'>Home</a> >> <a href='#'>Create topic</a>");
		break;
		case "/forum2_OFFLINE/view_search_result.php":
		$("#thread_div").html("<a href='index.php'>Home</a> >> <a href='#'>Search</a>");
		break;
		case "/forum2_OFFLINE/admin_page.php":
		$("#thread_div").html("<a href='index.php'>Home</a> >> <a href='#'>CRUD-tools</a>");
		break;
		case "/forum2_OFFLINE/admin_users.php":
		$("#thread_div").html("<a href='index.php'>Home</a> >> <a href='#'>CRUD-tools</a> >> <a href='index.php'>Users</a>");
		break;

		default:
		$("#thread_div").html("");
		break;
	}
});

/* SMALL NAVIGATION MENU */

$(document).ready(function(){

	$("div.nav-links-small-row").toggle();
	$("div.nav-links-small-row_logged_in").toggle();

	$("#menu_button").click(function(){
		$("div.nav-links-small-row").toggle();
		$("div.nav-links-small-row_logged_in").toggle();
	});

	$("#menu_button_log_in").click(function(){
		window.location = "log_in.php";
	});
	$("#menu_button_register").click(function(){
		window.location = "register.php";
	});

});













