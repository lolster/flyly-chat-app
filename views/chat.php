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
				document.getElementById("threads-list").style.width = "100%";
				
			}
			function close() {
				document.getElementById("threads-list").style.width = "0%";
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
			<div class="row">
				<!-- threads-list left -->
				<div class="col-xs-12 col-sm-12 col-md-4" id="threads-list">
					<div id="hamburger">
						<span onclick="close()">&#9776; close</span>
					</div>
					<div id="search">
						<input type="text" placeholder="search">
					</div>
					<hr class="colorgraph">

					<!-- the threads -->
					<div class="list">
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
				<!-- chat-area right -->
				<div class="col-xs-12 col-sm-12 col-md-8" id="chat-area">
					<div id="hamburger">
						<span onclick="open()">&#9776; threads</span>
					</div>
					<div id="chat-area-header">
					</div>
					<hr class="colorgraph">

					<!-- conversation area -->
					<div id="conversation-area">
						<div class="jumbotron text-center">
							<h1>TODO</h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>