<!DOCTYPE html>
<html lang = "en">
	<head>
		<title>Hotel Online Reservation</title>
		<link rel = "icon" href = "images/logo.jpg" 
        type = "image/x-icon">
		<meta charset = "utf-8" />
		<meta name = "viewport" content = "width=device-width, initial-scale=1.0" />
		<link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css " />
		<link rel = "stylesheet" type = "text/css" href = "css/style.css" />
		<style>
			.background{
				margin: 0;
    position: absolute;
    top: 75%;
    left: 65%;
    -ms-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
  	width: 50%;
    height: 80%;
			}
		</style>
	</head>
<body>
	<?php
		$redirectBackHereAfterLogin = false;
		$showThisPageOnlyToLoggedInUser = false;
		$showThisPageOnlyToGuestUser = true;
		include "./common/header.php"
	?>
	<div style = "margin-left:0;" class = "container">
		<div class = "panel panel-default">
			<div class = "panel-body">
				<strong><h3>Register</h3></strong>
				<a href = "contactus.php">any problem?</a>
				<br />
				<div>
					<img src="images/background.jpg"  class="background"/>
				</div>
				<div class = "well col-md-4">
					<form method = "POST" enctype = "multipart/form-data">
						<div class = "form-group">
							<label>Firstname</label>
							<input type = "text" class = "form-control" name = "firstname" required = "required" />
						</div>
						<div class = "form-group">
							<label>Lastname</label>
							<input type = "text" class = "form-control" name = "lastname"/>
						</div>
						<div class = "form-group">
							<label>Email</label>
							<input type = "email" class = "form-control" name = "email" required = "required" />
						</div>
						<div class = "form-group">
							<label>Password</label>
							<input type = "password" class = "form-control" name = "password" required = "required" />
						</div>
						<br />
						<?php
							if(isset($_GET['message'])){
								$message = $_GET['message'];
								echo "<p class='alert alert-danger'>$message</p>";
							}
						?>
						<div class = "form-group">
							<button class = "btn btn-info form-control" name = "register"><i class = "glyphicon glyphicon-save"></i> Submit</button>
						</div>
					</form>
				</div>
				<div class = "col-md-4"></div>
				<?php
					require_once 'add_query_reserve.php';
					require_once 'register_user.php';
				?>
				
			</div>
		</div>
	</div>
	<br />
	<br />
	<div style = "text-align:right; margin-right:10px;" class = "navbar navbar-default navbar-fixed-bottom">
		 
	</div>
</body>
<script src = "js/jquery.js"></script>
<script src = "js/bootstrap.js"></script>	
</html>

