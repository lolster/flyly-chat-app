var highlightedId = null;

function selectThread(event) {
	// clear conversation-area
	$('#conversation-area').empty();

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

	// friend's name is same as idToHighlight
	var userName = idToHighlight;
	var currTime = Math.round(Date.now()/1000);

	// get 10 Messages
	//var noOfMsgs = 10
	//getMessages(userId, userName, currTime, noOfMsgs);
	getMessages(userId, userName, currTime);

	var timer;
	// check if tbere are messages (i.e. overflown)
	$('#conversation-area').bind('mousewheel', function(event) {
		// PROBLEM: fires scroll event too many times
		// no idea how to fix this TODO
		// USE jquery .prepend()
		if (event.originalEvent.wheelDelta >= 0) {
			// scrolling up
			if(timer) {
				window.clearTimeout(timer);
			}
			timer = window.setTimeout(function() {
				if ($('#conversation-area').scrollTop() == 0) {
					// convert time from mysql to seconds
					var ts = new Date(window.lastTime.replace(' ', 'T')).getTime() / 1000;
					//console.log(ts);
					
					getMessages(userId, userName, ts);
				}
			}, 300);
		}
		else {
			// scrolling down
			// do nothing
		}
	});
}


//function to get the last message sent between this user and person
function getPreview(userId , name) {
	if(!userId || !name) {
		return;
	}

	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function () {
		//console.log(this);
		if(this.readyState == 4 && this.status == 200){
			$('#' + name + 'preview').html(this.responseText);
		}
	};

	xhr.open('POST', '../public/phpscripts/getMessage.php', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	var arr = 'uid=' + encodeURI(userId) + '&name=' + encodeURI(name);
	xhr.send(arr);
}

function getMessages(userId, otherUser, time) {
	// self-userID
	// friend's username

	// time now or timestamp received
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			responseObject = JSON.parse(this.responseText).msgs;
			for (var i = responseObject.length-1; i > -1; i--) {
				if (responseObject[i].i_sent) {
					appendMsg(responseObject[i].msg, 'right');
				} else {
					appendMsg(responseObject[i].msg, 'left');
				}
			}
			beAtBottom();
			var lastTime = responseObject[responseObject.length-1].time;
			window.lastTime = lastTime;
			//console.log('last time: ' + lastTime);
		}
	}
	xhr.open('POST', '../public/phpscripts/getAllMessages.php', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	var arr = 'uid=' + encodeURI(userId) + '&name=' + encodeURI(otherUser) + '&time=' + encodeURI(time);
	xhr.send(arr)
}

// to throttle scroll even firing
function throttle(fn, wait) {
	var time = Date.now();
	return function() {
		if ((time + wait - Date.now()) < 0) {
			console.log('kkk')
			fn();
			time = Date.now();
		}
	}
}