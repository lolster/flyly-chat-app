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
    if(!validatePassword()) {
        //show error here
    }
    else {
        //remove error here
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
