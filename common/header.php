<?php
	session_start();
	$isUserLoggedIn = false;
	if(!ISSET($_SESSION['user_email'])){
		$isUserLoggedIn = false;
	}else{
		$isUserLoggedIn = true;
	}
	if($isUserLoggedIn){
        if($showThisPageOnlyToGuestUser){
			header("location:index.php");
        }
	}else{
		if($showThisPageOnlyToLoggedInUser){
            $reqUrl = $_SERVER['REQUEST_URI'];
            if($redirectBackHereAfterLogin){
				$reqUrl = urlencode($reqUrl);
                header("location:login.php?message=Please+login+to+continue&reqUrl=$reqUrl");
            }else{
                header("location:login.php");
            }
        }
	}
?>
<nav style = "background-color:rgba(0, 0, 0, 0.1);" class = "navbar navbar-default">
		<div  class = "container-fluid">
			<div class = "navbar-header">
			<img class="logo-img" style="float: left; position: relative;margin: 10px 15px 15px 10px;" src="images/logo.jpg" width="30" height="30" ALT="align box" ALIGN=CENTER>
				<a class = "navbar-brand" >Hotel Online Reservation</a>
			</div>
		</div>
	</nav>	
	<div class="menu-bar">
		<ul id = "menu">
			<li><b><a href = "index.php" style="color: #FF6347";>Home</a></b></li> |
			<li><b><a href = "aboutus.php" style="color: #FF6347";>About us</a></b></li> |
			<li><b><a href = "contactus.php" style="color: #FF6347";>Contact us</a></b></li> |
			<li><b><a href = "gallery.php" style="color: #FF6347";>Gallery</a></b></li> |
			<li><b><a href = "dineandlounge.php" style="color: #FF6347";>Dine and Lounge</a></b></li> |			
			<li><b><a href = "reservation.php" style="color: #FF6347";>Make a reservation</a></b></li> |
			<li><b><a href = "rulesandregulation.php" style="color: #FF6347";>Rules and Regulation</a><b></li>
		</ul>
		<ul  id = "auth-menu">
			<?php
				if($isUserLoggedIn){
			?>
				<li><b><a style="color: #FF6347";><?php echo $_SESSION['user_firstname'] ?></a></b></li> |
				<li><b><a href="logout.php" style="color: #FF6347";>Logout</a></b></li>
			<?php
				}else{ 
			?>
				<li><b><a href = "register.php" style="color: #FF6347";>Register</a></b></li> |
				<li><b><a href = "login.php" style="color: #FF6347";>Login</a></b></li> 
			<?php
				} 
			?>
		</ul>
	</div>