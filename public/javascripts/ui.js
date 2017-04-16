function openPane() {
	if (window.innerWidth < 992) {
		$('#left-pane').css('width', '100%');
	}
}

function closePane() {
	if (window.innerWidth < 992) {
		$('#left-pane').css('width', '0%');
	}
}

function beAtBottom() {
	$('#conversation-area').animate({
		scrollTop:$('#conversation-area')[0].scrollHeight - 300
	}, 'slow');
}

function createParallax() {
	var movementStrength = 20;
	var height = movementStrength / $(window).height();
	var width = movementStrength / $(window).width();

	$(document.body).mousemove(function(e) {
		var pageX = e.pageX - ($(window).width() / 2);
		var pageY = e.pageY - ($(window).height() / 2);
		var newvalueX = width * pageX * -1 - 25;
		var newvalueY = height * pageY * -1 - 50;
		$('#bg-img').css('background-position', newvalueX + 'px     ' + newvalueY + 'px');
	});
}

function expandChatArea() {
	document.getElementById('conversation-area').style.height = '60%';
	document.getElementById('msg-input').style.height = '30%';
	document.getElementById('msg-box').style.height = '90%';
	beAtBottom();
}

function contractChatArea() {
	document.getElementById('conversation-area').style.height = '80%';
	document.getElementById('msg-input').style.height = '10%';
	document.getElementById('msg-box').style.height = '50%';
}