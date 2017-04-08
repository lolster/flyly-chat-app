function validate() {
	var retVal = true;
	if(!validatePassword()) {
		//showError('Passwords do not match');
		console.log('Passwords do not match')
		retVal = false
		return retVal
	}

	//validate all fields

	//send as xhr req to signup.php

	//in the readState handler, check for success
	//if not success, show the error message to the user

	return retVal;
}

function validatePassword() {
	var pass = document.getElementById('password').value;
	var passConfirm = document.getElementById('password-confirmation').value;
	return pass === passConfirm;
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

function validateUsername() {
	givenusername = document.getElementById('input-username').value;
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = validating;
	xhr.open('POST', '../public/phpscripts/checkusername.php', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhr.send('username=' + encodeURI(givenusername));
}

function validating() {
	if(xhr.readyState == 4  && xhr.status == 200){
		var response = xhr.responseText;
		console.log(response);
		if(response == 'false'){
			/* sweet alert
			swal({
				title: "Error!",
				text: "user name not available",
				type: "error",
				confirmButtonText: "Cool"
			}); */
			document.getElementById('input-username').value = '';
		}
	}
}