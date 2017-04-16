$(document).ready(() => {
	$('#send-btn').on('click', sendMsg);
});

function sendMsg() {
	sentMsg = $('#msg-box').val();
	if (sentMsg) {
		// use regex to search for code
		if (hasCode(sentMsg)) {
			newMsg = $('<div/>', {'class':'code-right'});
			result = sentMsg.match(/```(.*)\n/);
			language = result[1];
			console.log('language: ' + language);
			
			sentMsg = getCode(sentMsg);

			pre = $('<pre/>', {'class':'code-toolbars line-numbers'});
			code = $('<code/>', {'class':'language-' + language});

			code.text(sentMsg);
			pre.append(code);

			newMsg.append(pre);
			$('#conversation-area').append(newMsg);
			$('#conversation-area').append($('<script/>', { 'src':'../public/javascripts/prism.js' }));
		} else {
			newMsg = $('<div/>', {'class':'conv-right'});
			newMsg.html(sentMsg);
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