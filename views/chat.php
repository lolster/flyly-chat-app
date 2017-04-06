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

			function beAtBottom() {
				//// doesnt work
				document.getElementById("conversation-area").scrollTop = objDiv.scrollHeight;
			}
		</script>
	</head>

	<body onload="beAtBottom()">
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
						<img class="img img-circle" id="profile-pic" src="../public/images/profile.png">
						<div id="profile-name">Sushrith</div>
					</div>

					<!-- conversation area -->
					<div id="conversation-area">
						<div class="conv-left">
							test 123
						</div>
						<div class="conv-left">
							other person
						</div>
						<div class="conv-right">
							hello me
						</div>
						<div class="conv-left">
							On April 3rd, the 2017 edition of éclat was launched by Professor D. Jawahar, Pro Chancellor, PES University and CEO, PES institutions, in the presence of Dr V. Krishna, the Chairperson of the Mechanical Engineering Department of PES University. This edition consists of articles compiled by talented, creative minds of PES during the course of the preceding two years. The student copies shall be passed on to every department soon. We hope you enjoy dwelling into an ocean of thoughts articulated to enlighten, entertain and blow your mind!
						</div>
						<div class="conv-right">
							Noice!! 😃
						</div>
						<div class="conv-right">
							Here's some more stuff:
						</div>
						<div class="conv-right">
							1. The bags decompose: Did you know that most British tea bags are made from a relative of the banana? Manila hemp is made from the fiber of abaca leaf stalks. The bag itself will break down and the very little plastic they use to seal the tea bags virtually disappears within 6 months, according to the UK Tea & Infusions Association. 
						</div>


					</div>

					<!-- input box -->
					<div id="msg-input">
						<input type="text" id="message-box" class="form-control" required="required" placeholder="type in here..">
					</div>
					
				</div>
			</div>
		</div>
	</body>
</html>