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
			function openNav() {
				document.getElementById("threads-list").style.width = "100%";
				document.getElementById("chat-area").style.display = "none";
			}

			function closeNav() {
				document.getElementById("chat-area").style.display = "block";
				document.getElementById("threads-list").style.width = "0%";
			}
		</script>
	</head>
	<body>
		<br><br>
		<div class="container">
			<hr id="full-view" class="colorgraph">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-4" id="threads-list">
					<div id="hamburger">
						<span onclick="closeNav()">&#9776; close</span>
						<hr class="colorgraph">
					</div>
					<div class="well">
						LEFT
					</div>
					<div class="well">
						LEFT
					</div>
					<div class="well">
						LEFT
					</div>
					<div class="well">
						LEFT
					</div>
					<hr class="colorgraph">
				</div>
				<div class="col-xs-12 col-sm-12 col-md-8" id="chat-area">
					<div id="hamburger">
						<span onclick="openNav()">&#9776; threads</span>
						<hr class="colorgraph">
					</div>
					<div class="well">
						RIGHT
					</div>
					<div class="well">
						RIGHT
					</div>
					<div class="well">
						RIGHT
					</div>
					<div class="well">
						RIGHT
					</div>
					<hr class="colorgraph">
				</div>
			</div>
		</div>
	</body>
</html>