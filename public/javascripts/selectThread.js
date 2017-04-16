var highlightedId = null;

function selectThread(event) { 
	var name = $(event.target).attr('id');
	var idToHighlight = name;
	
	// hacky stuff
	if(name.substr('preview'.length * -1) == 'preview') {
		idToHighlight = name.substr(0, name.length - 'preview'.length);
		name = name.substr(0, name.length - 'preview'.length) + 'name';
	}
	if(name.substr('name'.length * -1) != 'name') {
		name += 'name';
	}
	if(name.substr('name'.length * -1) == 'name') {
		idToHighlight = name.substr(0, name.length - 'name'.length);
	}
	name = $('#' + name).text();

	$('#profile-name').text(name);

	beAtBottom();

	// change title that shows username
	document.title = 'chatting with ' + name;

	// on focus change background color
	// revert previously highlighted to normal
	$('#' + window.highlightedId).css('background-color', '#322e32');
	// on click change highlight thread
	$('#' + idToHighlight).css('background-color', '#6a6b75');
	// use window.var to make local variable global
	window.highlightedId = idToHighlight;

	// get Messages
	getMessages();
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


function getMessages(otherUser, time) {
	// TODO
}