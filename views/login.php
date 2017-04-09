<!DOCTYPE html>
<html>
	<head>
		<title>login</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="../public/stylesheets/bootstrap.min.css">
		<link rel="stylesheet" href="../public/stylesheets/styles.css">
		
		<script src="../public/javascripts/jquery.min.js"></script>
		<script src="../public/javascripts/bootstrap.min.js"></script>
		
	</head>
	<body>
		<div class="jumbotron">
			<div class="container">
				<a href="index.html"><h1>flyly</h1></a>
			</div>
		</div>
		<div class="container">
			<div class="card login-card-container">
				<img id="profile-img" class="profile-img-card" src="../public/images/profile.png">
				<hr class="colorgraph">
				<?php
					if(isset($_GET['s']) && $_GET['s'] == 'f') {
						//write the pretty stuff here css-man
						?>
							<h5>Incorrect Credentials!</h5>
						<?php
					}
				?>
				<form action="../public/phpscripts/login.php" method="POST" role="form">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="glyphicon glyphicon-user"></i>
							</span> 
							<input type="text" class="form-control" name="username" id="input-username" placeholder="Username" autofocus>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="glyphicon glyphicon-lock"></i>
							</span>
							<input type="password" name="password" class="form-control" id="password" placeholder="Password">
						</div>
					</div>

					<div class="form-group">
						<input type="submit" class="btn btn-md btn-primary btn-block" value="Sign in">
					</div>
				</form>

				<div class="form-group">
					<a href="signup.html" class="btn btn-md btn-success btn-block" role="button">Sign up!</a>
				</div>

				<hr class="colorgraph">

				<a href="#" class="forgot-password">
					Forgot password?
				</a>
			</div>
		</div>
	</body>
</html>