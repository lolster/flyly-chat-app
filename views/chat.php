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

		<script src="../public/javascripts/chatPageInit.js"></script>
		<script src="../public/javascripts/ui.js"></script>
		<script src="../public/javascripts/socket.io.js"></script>
		<!-- <script src="../public/javascripts/underscore-min.js"></script> -->
		<script>
			var username = <?php echo "'$user'"; ?>;
			var userId = <?php echo $userid;?>;
			var userFriendsName = <?php echo json_encode($userFriends);?>;
			var userFriendsFirstName = <?php echo json_encode($userFriendsFirstName);?>;
			var userFriendsLastName = <?php echo json_encode($userFriendsLastName);?>;
		</script>
		<script src="../public/javascripts/sendMsg.js"></script>
		<script src="../public/javascripts/selectThread.js"></script>
		<script src="../public/javascripts/search.js"></script>
		<script src="../public/javascripts/fileRead.js"></script>
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
						<!-- div to append theads to -->
					</div>
				</div>
				<!-- chat-are right -->
				<div class="col-xs-12 col-sm-12 col-md-8" id="right-pane">
					<div id="right-pane-header">
						<span id="hamburger" onclick="openPane()">&#9776;</span>
							<!-- TODO: change image accordingly -->
							<img class="img img-circle" id="profile-pic" src="../public/images/profile.png">
							<!-- profile name to be replaced -->
							<div id="profile-name">Placeholder Name</div>
							<!-- log out button -->
							<span id="logout" class="glyphicon glyphicon-log-out" onclick="logOut()"></span>
					</div>

					<!-- conversation area -->
					<div id="conversation-area" onclick="contractChatArea()">
						<!-- div to append messages to -->
					</div>

					<!-- input box -->
					<div id="msg-input">
						<textarea id="msg-box" class="form-control" rows="2" required="required" onclick="expandChatArea()" placeholder="type in here.."></textarea>
						<!-- button to attach file to send code -->
						<!-- <input type="file" id="code-btn" class="btn btn-primary" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Click to send program file/code snippet" value=""> -->
						<!-- send message -->
						<button type="submit" id="send-btn" class="btn btn-primary">Send</button>
						<label class="btn btn-default btn-file">
    						Upload File <input type="file" id="file-in" hidden>
						</label>
					</div>
					
				</div>
			</div>
		</div>
	</body>
</html>