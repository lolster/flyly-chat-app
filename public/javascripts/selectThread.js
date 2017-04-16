function selectThread(event) {
	//getPreview(userId, name);
	// MASSIVE TODO
	//getPreview(1, 'hunter');
	// TODO 
	$('#profile-name').text($(event.target).text());
	beAtBottom();
}

//function to get the last message sent between this user and person
function getPreview(userId , name) {
	//console.log('getPreview: userid: ' + userId + 'name: ' + name);
	if(!userId || !name) {
		// console.log('error! ' + 'getPreview: userid: ' + userId + ' name: ' + name);
		return;
	}
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function () {
		//console.log(this);
		if(this.readyState == 4 && this.status == 200){
			$('#' + name + 'preview').html(this.responseText);
			console.log('yolo' + this.responseText);
		}
	};
	xhr.open('POST', '../public/phpscripts/getMessage.php', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	var arr = 'uid=' + encodeURI(userId) + '&name=' + encodeURI(name);
	xhr.send(arr);
}