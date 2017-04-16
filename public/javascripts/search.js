$(document).ready(() => {
	var keyUpTimeout = 10;
	var keyUpInterval = null;
	$('#search-box').on('keyup', (event) => {
		if(keyUpInterval) {
			clearTimeout(keyUpInterval);
		}
		keyUpInterval = setTimeout(() => {showRelevantUsers(event);}, keyUpTimeout);
	})

	var showRelevantUsers = function(event) {
		var search = $('#search-box').val();
		console.log('search: ' + search.length);
		var list = $('.threads');
		if(event.keyCode == 27) {
			$('#search-box').val('');
			for(var i = 0; i < list.length; i++) {
				$(list[i]).css({'display':'inherit'});
			}
			return;
		}
		if(!search || search.length != 0) {
			var re = '.*' + search + '.*';
			for(var i = 0; i < list.length; i++) {
				var curr = $(list[i]);
				var name = curr.attr('id');
				var fullname = $('#' + name + 'name.name').text().toLowerCase();
				console.log(fullname)
				if(name.search(re) != -1) {
					curr.css({'display':'inherit'});
				}
				else if(fullname.search(re) != -1) {
					curr.css({'display':'inherit'});
				}
				else {
					curr.css({'display':'none'});
				}
			}
		}
		else {
			for(var i = 0; i < list.length; i++) {
				$(list[i]).css({'display':'inherit'});
			}
		}
	}
});