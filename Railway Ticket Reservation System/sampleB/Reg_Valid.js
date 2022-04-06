$(function() {
	$("#lastname_error_msg").hide();
	$("#firstname_error_msg").hide();
	$("#username_error_msg").hide();
	$("#passworrd_error_msg").hide();
	$("#passworrd2_error_msg").hide();

	var error_lastname = false;
	var error_firstname = false;
	var error_username = false;
	var error_password = false;
	var error_password = false;

	$("#form_lastname").focusout(function(){
		check_lastname();
	});

	$("#form_firstname").focusout(function(){
		check_firstname();
	});

	$("#form_username").focusout(function(){
		check_username();
	});

	$("#form_password").focusout(function(){
		check_password();
	});

	$("#form_password2").focusout(function(){
		check_password2();
	});

	function check_lastname(){

		var empty_lastname = $("#form_lastname").val().length;
		if(empty_lastname < 5){
			$("#lastname_error_msg").html("atleast 5 characters");
			$("#lastname_error_msg").show();
			error_lastname = true;
		}
		else{
			$("#lastname_error_msg").hide();
		}
	}

});