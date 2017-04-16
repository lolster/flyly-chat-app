<?php
	session_start(); 
	require('../public/phpscripts/entry_chat.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>chat</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="../public/stylesheets/bootstrap.min.css">
		<link rel="stylesheet" href="../public/stylesheets/styles.css">
		<link rel="stylesheet" href="../public/stylesheets/prism.css">

		<script src="../public/javascripts/jquery.min.js"></script>
		<script src="../public/javascripts/bootstrap.min.js"></script>
		<script src="../public/javascripts/prism.js"></script>
		<script src="../public/javascripts/ui.js"></script>
		<script src="../public/javascripts/sendMsg.js"></script>

		<script>
			$(window).on('load', function() {
				beAtBottom();
				createParallax();
			});

			/* EDITED BY MR.HUNTER WILL BE BUGGY PLS FIX OR ELSE RIP*/
			var userId = <?php echo $userid;?>;
			var userFriendsName = <?php echo json_encode($userFriends);?>;
			var userFriendsFirstName = <?php echo json_encode($userFriendsFirstName);?>;
			var userFriendsLastName = <?php echo json_encode($userFriendsLastName);?>;
			//var mainThread = document.createElement('div');
			//var $mainThread = $('<div>', {id:'threads-list'});

			$(document).ready(() => {
				var $mainThread = $('#threads-list');
				for (var i = 0; i < userFriendsName.length; ++i) {
					var $subThread = $('<div>', {class:'threads', id:userFriendsName[i]});
					$subThread.on('click', selectThread);
					var $profImage = $('<img>', {class:'img-circle', src:'../public/images/profile.png'});
					$subThread.append($profImage);
					var name = userFriendsFirstName[i] + ' ' + userFriendsLastName[i];
					var $divOne = $('<div>', {class:'name'});
					$divOne.text(name);
					$subThread.append($divOne);
					var $spanTwo = $('<span>', {class:'preview', id:userFriendsName[i] + 'preview'})
					$subThread.append($spanTwo);
					// $spanTwo.text() -> need to call later after fetching the messages
					// call after appending
					// getPreview(userId , name);
					$mainThread.append($subThread);

					// update the user name in righht-pane-header
					// TODO
					//$('#profile-name').text(name);
				}
				
			
				// $('#left-pane').append($mainThread);
				for (var i = 0; i < userFriendsName.length; ++i) {
					console.log('yolo');
					console.log(userFriendsName[i]);
					getPreview(userId, userFriendsName[i]);
				}
			});

			//function to get the last message sent between this user and person
			function getPreview(userId , name) {
				//console.log('getPreview: userid: ' + userId + 'name: ' + name);
				if(!userId || !name) {
					console.log('error! ' + 'getPreview: userid: ' + userId + ' name: ' + name);
					return;
				}
				var xhr = new XMLHttpRequest();
				xhr.onreadystatechange = function () {
					console.log(this);
					if(this.readyState == 4 && this.status == 200){
						$('#' + name + 'preview').html(this.responseText);
						console.log('yolo' + this.responseText);
					}
				};
				xhr.open('POST', '../public/phpscripts/getMessage.php', true);
				xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
				var arr = 'uid=' + encodeURI(userId) + '&name=' + encodeURI(name);
				xhr.send(arr);
			}

			// select particular thread for chatting
			function selectThread() {
				//getPreview(userId, name);
				// MASSIVE TODO
				getPreview(1, 'hunter');
				// TODO 
				//$('#profile-name').text('poop');
				beAtBottom();
			}

			function logOut() {
				alert('logout');
				window.location = '../public/phpscripts/logout.php';
			}
		</script>
	</head>

	<body>
		<div id="bg-img"></div>
		<div class="container">
			<div class="row" id="area">
				<!-- threads-list and search left -->
				<div class="col-xs-12 col-sm-12 col-md-4" id="left-pane">
					<div id="search">
						<span id="hamburger-left" onclick="closePane()">&#9776;</span>
						<input type="text" placeholder="search" id="search-box">
					</div>

					<!-- the threads -->
					<div id="threads-list">
						<div class="threads" onclick="selectThread()">
							<img class="img-circle" src="../public/images/profile.png">
							<div class="name">placeholder</div>
							<span class="preview">placeholder placeholder placeholder placeholder placeholder placeholder placeholder placeholder </span>
						</div>

					</div>
				</div>
				<!-- chat-are right -->
				<div class="col-xs-12 col-sm-12 col-md-8" id="right-pane">
					<div id="right-pane-header">
						<span id="hamburger" onclick="openPane()">&#9776;</span>
							<img class="img img-circle" id="profile-pic" src="../public/images/profile.png">
							<!-- THIS BELOW THING SHOULD BE CHANGED SUHAS!!!!!!!!!!!!!!!!
								THIS SHOULD BE BASED UPON THE THREADS THAT GET SELECTED..	-->
							<div id="profile-name">Placeholder Name</div>
							<!-- settings to log out -->
							<span id="logout" class="glyphicon glyphicon-log-out" onclick="logOut()"></span>
					</div>

					<!-- conversation area -->
					<div id="conversation-area" onclick="contractChatArea()">
						<div class="conv-left">test 123</div>
						<div class="conv-left">other person</div>
						<div class="conv-right">hello me</div>
						<div class="conv-left">On April 3rd, the 2017 edition of éclat was launched by Professor D. Jawahar, Pro Chancellor, PES University and CEO, PES institutions, in the presence of Dr V. Krishna, the Chairperson of the Mechanical Engineering Department of PES University. This edition consists of articles compiled by talented, creative minds of PES during the course of the preceding two years. The student copies shall be passed on to every department soon. We hope you enjoy dwelling into an ocean of thoughts articulated to enlighten, entertain and blow your mind!</div>
						<div class="conv-right">Noice!! 😃</div>
						<div class="conv-right">Here's some more stuff:</div>
						<div class="conv-right">1. The bags decompose: Did you know that most British tea bags are made from a relative of the banana? Manila hemp is made from the fiber of abaca leaf stalks. The bag itself will break down and the very little plastic they use to seal the tea bags virtually disappears within 6 months, according to the UK Tea Infusions Association. </div>
						<div class="conv-left">Abstract—The following mini-project hopes to recommend the user about the value of a car that he/she plans to buy from a 2nd- hand car reseller. A statistical approach is used to give a guideline to the buyer to purchase a car based on different parameters like location of the car, year of manufacture, car-name, model and variant, fuel-type and kilometers on the odometer. We web scraped to get the data sets, extracted traits from it, fit a model to it and created a simple recommendation system.</div>
					</div>

					<!-- input box -->
					<div id="msg-input">
						<textarea id="msg-box" class="form-control" rows="2" required="required" onclick="expandChatArea()" placeholder="type in here.."></textarea>
						<button type="submit" id="send-btn" class="btn btn-primary">Send</button>
					</div>
					
				</div>
			</div>
		</div>
		<script>
			var currActiveThread = userFriendsName[0];
			function getMessages(otherUser, time) {
				//get messages between otherUser and userId
			}

		</script>
	</body>
</html>