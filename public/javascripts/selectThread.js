var highlightedId = null;
var lastTime = null;
var timer;

function twoDigits(d) {
    if(0 <= d && d < 10) return "0" + d.toString();
    if(-10 < d && d < 0) return "-0" + (-1*d).toString();
    return d.toString();
}

Date.prototype.toMysqlFormat = function() {
    return this.getUTCFullYear() + "-" + twoDigits(1 + this.getUTCMonth()) + "-" + twoDigits(this.getUTCDate()) + " " + twoDigits(this.getUTCHours()) + ":" + twoDigits(this.getUTCMinutes()) + ":" + twoDigits(this.getUTCSeconds());
};


function selectThread(event) {
	var n = 2;
	// predictive fetch

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

	closePane();

	$('#profile-name').text(name);

	beAtBottom();

	// change title that shows username
	document.title = 'chatting with ' + name;

	// on focus change background color
	// revert previously highlighted to normal
	$('#' + window.highlightedId).css('background-color', '#322e32');
	$('#' + window.highlightedId).css('box-shadow', 'none');
	// on click change highlight thread
	$('#' + idToHighlight).css('background-color', '#6a6b75');
	$('#' + idToHighlight).css('box-shadow', '0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22)');

	// use window.var to make local variable global
	window.highlightedId = idToHighlight;

	// friend's name is same as idToHighlight
	var userName = idToHighlight;
	// NOTE: hardcoded for demo
	// TODO: use IST
	var currTime = '2017-04-21 12:43:33';//(new Date()).toMysqlFormat();

	// initially load certain messages
	console.log('whyyyy');
	getMessages(userId, userName, currTime, false, 10);

	// predictive fetch part
	// NOTE: lots of bamboozle
	// check if tbere are messages (i.e. overflown)
	$('#conversation-area').bind('mousewheel', function(event) {
		// compare times to see if already at bottom
		if (event.originalEvent.wheelDelta >= 0) {
			// scrolling up
			if(timer) {
				window.clearTimeout(timer);
			}
			timer = window.setTimeout(function() {
				if ($('#conversation-area').scrollTop() == 0) {
					var ts = window.lastTime;
					// actual => n = n * 2;
					// for demo =>
					getMessages(userId, userName, ts, true, n);
					n = n + 2;
				}
			}, 150);
		} else {
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
		if(this.readyState == 4 && this.status == 200){
			$('#' + name + 'preview').html(this.responseText);
		}
	};

	xhr.open('POST', '../public/phpscripts/getMessage.php', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	var arr = 'uid=' + encodeURI(userId) + '&name=' + encodeURI(name);
	xhr.send(arr);
}

function getMessages(userId, otherUser, time, hack, n) {
	console.log('whyyyyyy');
	var xhr = new XMLHttpRequest();
	if(!hack) {
		xhr.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				responseObject = JSON.parse(this.responseText).msgs;
				for (var i = responseObject.length-1; i > -1; i--) {
					if (responseObject[i].i_sent) {
						appendMsg(responseObject[i].msg, 'right', 'append');
					} else {
						appendMsg(responseObject[i].msg, 'left', 'append');
					}
				};
				beAtBottom();
				console.log(responseObject);
				try {
					lastTime = responseObject[responseObject.length-1].time;
				} catch(e) {
					// no change in lastTime
				}
				window.lastTime = lastTime;
			}
		};
	}
	else {
		xhr.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				responseObject = JSON.parse(this.responseText).msgs;
				for (var i = 0; i < responseObject.length; ++i) {
					if (responseObject[i].i_sent) {
						appendMsg(responseObject[i].msg, 'right', 'prepend');
					} else {
						appendMsg(responseObject[i].msg, 'left', 'prepend');
					}
				};
				console.log(responseObject);
				try {
					lastTime = responseObject[responseObject.length-1].time;
				} catch(e) {
					// no change in lastTime
				}
				window.lastTime = lastTime;
			}
		};
	}
	xhr.open('POST', '../public/phpscripts/getAllMessages.php', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	var arr = 'uid=' + encodeURI(userId) + '&name=' + encodeURI(otherUser) + '&time=' + encodeURI(time) + '&n=' + encodeURI(n);
	xhr.send(arr)
}


// to throttle scroll even firing
function throttle(fn, wait) {
	var time = Date.now();
	return function() {
		if ((time + wait - Date.now()) < 0) {
			fn();
			time = Date.now();
		}
	}
}