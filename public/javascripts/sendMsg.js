$(document).ready(() => {
	$('#send-btn').on('click', sendMsg);
	$('#msg-box').on('keyup', (event) => {
		console.log('yello');
		console.log(event.keyCode);
		if(event.keyCode == 27) {
			$('#msg-box').val('');
			contractChatArea();
		}
	})
});

var socket = null;
var hostname = '192.168.43.238';
// change ip address here
socket = io('http://' + hostname + ':3000');
var currRoom = username;

socket.emit('change room', {room:currRoom});

socket.on('chat message', (data) => {
	//console.log(data);
	//$('#messages').append($('<li>').text(data.sender + ': ' + data.msg));
	if(highlightedId == data.sender) {
		appendMsg(data.msg, 'left', 'append');
		beAtBottom();
	}
	else {
		//show pop up

	}
	// TODO:
	// 	Push the message to localstorage
	// 	Bring the left side panel box of the thread to the 
	// 	top of the left side pane
	// 	FOL
});

// send message on button click
function sendMsg() {
	sentMsg = $('#msg-box').val();
	var data = {
		msg:sentMsg,
		sender: username,
		receiver: highlightedId
	};
	//console.log('sending:');
	//console.log('data');
	socket.emit('chat message', data);
	//console.log('sentMsg: ' + sentMsg);
	appendMsg(sentMsg, 'right', 'append');
	$('#msg-box').val('');
	beAtBottom();
}

function appendMsg(message, leftOrRight, appendOrPrepend) {
	// leftOrRight => left or right side of the conversation
	if (message) {
		// use regex to search for code
		if (hasCode(message)) {
			newMsg = $('<div/>', {'class':'code-' + leftOrRight});
			result = message.match(/```(.*)(\r\n|\r|\n)/);
			language = result[1];
			
			message = getCode(message);

			pre = $('<pre/>', {'class':'code-toolbars line-numbers'});
			code = $('<code/>', {'class':'language-' + language});

			code.text(message);
			pre.append(code);

			newMsg.append(pre);
			if (appendOrPrepend == 'append') {
				$('#conversation-area').append(newMsg);
				$('#conversation-area').append($('<script/>', { 'src':'../public/javascripts/prism.js' }));
			} else {
				$('#conversation-area').prepend(newMsg);
				$('#conversation-area').prepend($('<script/>', { 'src':'../public/javascripts/prism.js' }));
			}
		} else {
			newMsg = $('<div/>', {'class':'conv-' + leftOrRight});
			newMsg.html(message);
			if (appendOrPrepend == 'append') {
				$('#conversation-area').append(newMsg);
			} else {
				$('#conversation-area').prepend(newMsg);
			}
		}
	}
}

function hasCode(message) {
	n = message.search('```');
	if (n == -1) {
		return false;
	}
	return true;
}

function getCode(message) {
	return(message.substring(message.indexOf('\n') + 1, message.lastIndexOf('\n')));
}