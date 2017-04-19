$(window).on('load', function() {
	beAtBottom();
	createParallax();
	populateThreadsList();
	$('#code-btn').popover('dispose');
	document.title = 'Select a thread to start chatting...';
});


function populateThreadsList() {
	// TODO: show all friends at first and have preview as select thread t ostart chatting
	var threadsList = $('#threads-list');
	for (var i = 0; i < userFriendsName.length; ++i) {
		// individual thread
		// TODO: change profile image
		var thread = $('<div>', {class: 'threads', id:userFriendsName[i]});
		var profileImg = $('<img>', {class: 'img-circle', src:'../public/images/profile.png'});
		var name = userFriendsFirstName[i] + ' ' + userFriendsLastName[i];
		var nameDiv = $('<div>', {class:'name', id:userFriendsName[i] + 'name'});
		nameDiv.text(name);
		var previewSpan = $('<span>', {class:'preview', id:userFriendsName[i] + 'preview'});
		previewSpan.text('select thread to chat!');

		thread.append(profileImg);
		thread.append(nameDiv);
		thread.append(previewSpan);
		thread.on('click', selectThread);

		threadsList.append(thread);
	}

	// replace placeholder previews with actual
	for (var i = 0; i < userFriendsName.length; ++i) {
		getPreview(userId, userFriendsName[i]);
	}

	// TODO: check if this breaks later
	// acts like manual click
	var latest = userFriendsName[0] + 'name';
	$('#' + latest).trigger('click');
}

function logOut() {
	var response = confirm('Are you sure you want to log out?');
	if (response) {
		window.location = '../public/phpscripts/logout.php';
	}
}