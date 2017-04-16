function selectThread(event) { 
	var name = $(event.target).attr('id');
	
	if(name.substr('preview'.length * -1) == 'preview') {
		name = name.substr(0, name.length - 'preview'.length) + 'name';
	}

	if(name.substr('name'.length * -1) != 'name') {
		name += 'name';
	}

	name = $('#'+name).text();
	
	console.log(name);
	$('#profile-name').text(name);

	document.title = 'chatting with ' + name;


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
			console.log('#' + name + 'preview');
			$('#' + name + 'preview').html(this.responseText);
			console.log('=> ' + this.responseText);
		}
	};

	xhr.open('POST', '../public/phpscripts/getMessage.php', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	var arr = 'uid=' + encodeURI(userId) + '&name=' + encodeURI(name);
	xhr.send(arr);
}