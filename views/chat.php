<!DOCTYPE html>
<html>
	<head>
		<title>chat</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="../public/stylesheets/bootstrap.min.css">
		<link rel="stylesheet" href="../public/stylesheets/styles.css">
		
		<script src="../public/javascripts/jquery.min.js"></script>
		<script>
			function open() {
				document.getElementById("left-pane").style.width = "100%";
				
			}
			function close() {
				document.getElementById("left-pane").style.width = "0%";
			}

			// select particular thread for chatting
			function selectThread() {
				// TODO
				console.log('poop 💩');
			}
		</script>
	</head>

	<body>
		<div class="container">
			<div class="row" id="area">
				<!-- threads-list and search left -->
				<div class="col-xs-12 col-sm-12 col-md-4" id="left-pane">
					<div id="hamburger">
						<span onclick="close()">&#9776; close</span>
					</div>
					<div id="search">
						<input type="text" placeholder="search">
					</div>

					<!-- the threads -->
					<div id="threads-list">
						<div class="threads" onclick="selectThread()">
							<img class="img-circle" src="../public/images/profile.png">
							<span class="name">Sushrith Arkal</span>
							<span class="preview">I like macbook</span>
						</div>
						<div class="threads" onclick="selectThread()">
							<img class="img-circle" src="../public/images/profile.png">
							<span class="name">Sriharsha Hathwar</span>
							<span class="preview">Hello 😃</span>
						</div>
						<div class="threads" onclick="selectThread()">
							<img class="img-circle" src="../public/images/profile.png">
							<span class="name">name</span>
							<span class="preview">&nbsp;</span>
						</div>
						<div class="threads" onclick="selectThread()">
							<img class="img-circle" src="../public/images/profile.png">
							<span class="name">name</span>
							<span class="preview">&nbsp;</span>
						</div>
						<div class="threads" onclick="selectThread()">
							<img class="img-circle" src="../public/images/profile.png">
							<span class="name">name</span>
							<span class="preview">&nbsp;</span>
						</div>
						<div class="threads" onclick="selectThread()">
							<img class="img-circle" src="../public/images/profile.png">
							<span class="name">name</span>
							<span class="preview">&nbsp;</span>
						</div>
						<div class="threads" onclick="selectThread()">
							<img class="img-circle" src="../public/images/profile.png">
							<span class="name">name</span>
							<span class="preview">&nbsp;</span>
						</div>
						<div class="threads" onclick="selectThread()">
							<img class="img-circle" src="../public/images/profile.png">
							<span class="name">name</span>
							<span class="preview">&nbsp;</span>
						</div>
						<div class="threads" onclick="selectThread()">
							<img class="img-circle" src="../public/images/profile.png">
							<span class="name">name</span>
							<span class="preview">&nbsp;</span>
						</div>
						<div class="threads" onclick="selectThread()">
							<img class="img-circle" src="../public/images/profile.png">
							<span class="name">name</span>
							<span class="preview">&nbsp;</span>
						</div>
					</div>

				</div>
				<!-- chat-are right -->
				<div class="col-xs-12 col-sm-12 col-md-8" id="right-pane">
					<div id="hamburger">
						<span onclick="open()">&#9776; threads</span>
					</div>
					<div id="right-pane-header">
						names and stuff here
					</div>
					<!-- conversation area -->
					<div id="conversation-area">
					</div>
					<div id="msg-input">
						<input type="text" id="message-box" class="form-control" required="required" placeholder="type in here..">
					</div>
					
				</div>
			</div>
		</div>
	</body>
</html>