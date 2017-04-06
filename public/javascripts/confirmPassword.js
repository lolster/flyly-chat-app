function validate(){
	var ret_val = true;
	if(!validatePassword()) {
		showError('Passwords do not match');
		ret_val = false
		return ret_val
	}

	//validate all fields

	//send as xhr req to signup.php

	//in the readState handler, check for success
	//if not success, show the error message to the user

	return ret_val;
}

function validatePassword() {
	var pass = document.getElementById("password").value;
	var pass_confirm = document.getElementById("password-confirmation").value;
	return pass === pass_confirm;
}

function verifyPassword() {
	console.log('password');
	if($('#password-confirmation').val().length == 0) {
		// check for the case when confirm password has nothing and still shows error
		return;
	}
	if(!validatePassword()) {
		$('#password-confirmation').popover('show');
		// disable button on unmatched password
		$('#register-btn').attr('disabled', 'disabled');
	}
	else {
		$('#password-confirmation').popover('hide');
		// enable button back if passwords are matched
		$('#register-btn').attr('disabled', false);
	}
}

function validateUsername(){
	givenusername = document.getElementById("input-username").value;
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = validating;
	xhr.open("POST","../public/phpscripts/checkusername.php",true);
	xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xhr.send("username="+encodeURI(givenusername));
	console.log("coming here?")
}

function validating(){
	if(xhr.readyState == 4  && xhr.status == 200){
		console.log("coming inside chr readystate?");
		var thingy = xhr.responseText;
		console.log(thingy);
		if(thingy == 'false'){
			swal({
				title: "Error!",
				text: "user name not available",
				type: "error",
				confirmButtonText: "Cool"
			});
			document.getElementById("input-username").value = "";
		}
		console.log("hlloo")
	}
}

function showError(msg) {
	sweetAlert(msg);
}
