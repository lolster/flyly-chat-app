$(document).ready(() => {
	$('#send-btn').on('click', sendMsg);
});

function sendMsg() {
	sentMsg = $('#msg-box').val();
	console.log('sentMsg: ' + sentMsg);
	appendMsg(sentMsg, 'right');
}

function appendMsg(message, leftOrRight) {
	// leftOrRight => left or right side of the conversation
	if (message) {
		// use regex to search for code
		if (hasCode(message)) {
			newMsg = $('<div/>', {'class':'code-' + leftOrRight});
			console.log(message);
			result = message.match(/```(.*)(\r\n|\r|\n)/);
			console.log(result);
			language = result[1];
			console.log('language: ' + language);
			
			message = getCode(message);

			pre = $('<pre/>', {'class':'code-toolbars line-numbers'});
			code = $('<code/>', {'class':'language-' + language});

			code.text(message);
			pre.append(code);

			newMsg.append(pre);
			$('#conversation-area').append(newMsg);
			$('#conversation-area').append($('<script/>', { 'src':'../public/javascripts/prism.js' }));
		} else {
			newMsg = $('<div/>', {'class':'conv-' + leftOrRight});
			newMsg.html(message);
			$('#conversation-area').append(newMsg);
		}
		
		beAtBottom();
		document.getElementById('msg-box').value = '';
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