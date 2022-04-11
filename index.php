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
	</head>
<body>
	<?php
		$redirectBackHereAfterLogin = false;
		$showThisPageOnlyToLoggedInUser = false;
		$showThisPageOnlyToGuestUser = false;
		include "./common/header.php"
	?>
    <?php
    include('admin/connect.php');

    if(isset($_POST['btnReview'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $review = $_POST['review'];

        $sql = "INSERT INTO `reviews` (`name`, `email`, `mobile`, `review`) VALUES ('$name', '$email', '$mobile', '$review')";
        $conn->query($sql) or die(mysqli_error($conn));
        $_SESSION['flash'] = '<div style="background-color: #DCFFD1; border:1px dashed #0D6F00; color:#0D6F00; padding:10px 12px;margin: 0 30px;">Success! Thank you for reviewing us.</div>';
        echo "<script>";
        echo "window.location.href = 'index.php?con=1';";
        echo "</script>";
    }
    ?>
	<div id="myCarousel" class="carousel slide container-fluid" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
			<li data-target="#myCarousel" data-slide-to="2"></li>
			<li data-target="#myCarousel" data-slide-to="3"></li>
			<li data-target="#myCarousel" data-slide-to="4"></li>
			<li data-target="#myCarousel" data-slide-to="5"></li>
			<li data-target="#myCarousel" data-slide-to="6"></li>
		</ol>
		<div style = "margin:auto;" class="carousel-inner" role="listbox">
			<div class="item active">
				<img src="images/a.jpg" style = "width:100%; height:450px;" />
			</div>
		
			<div class="item">
				<img src="images/b.jpg" style = "width:100%; height:450px;"  />
			</div>
		
			<div class="item">
				<img src="images/c.jpg" style = "width:100%; height:450px;" />
			</div>
		
			<div class="item">
				<img src="images/d.jpg" style = "width:100%; height:450px;" />
			</div>
			
			<div class="item">
				<img src="images/e.jpg" style = "width:100%; height:450px;" />
			</div>
			
			<div class="item">
				<img src="images/f.jpeg" style = "width:100%; height:450px;" />
			</div>
			
			<div class="item">
				<img src="images/g.png" style = "width:100%; height:450px;" />
			</div>
			
			
		</div>
		<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>	
	</div>
	<br />
	<br />
	<hr>
        <div class="row well" style="color: #ed9e21">
            <div class="col-12 col-md-9" >
              <h4><strong style="color: #FF6347"><b>About</strong></b></h4><br>
              <p style="color: #FF6347">Online hotel reservations are a popular way to reserve hotel rooms. Travelers may book rooms on a computer utilising internet security to safeguard their privacy and financial information, as well as numerous online travel agencies to compare costs and amenities at various hotels.</p>
              <br>
              <p style="color: #FF6347">Prior to the Internet, tourists might make a reservation by writing, calling the hotel directly, or through a travel agent. Online travel agencies now include images of hotels and rooms, information on rates and promotions, and even information on nearby resorts. Many also allow travellers' reviews to be logged with the online travel agent.</p>
              <br>
              <p style="color: #FF6347">Online hotel reservations are also helpful for making last minute travel arrangements. Hotels may drop the price of a room if some rooms are still available. There are several websites that specialize in searches for deals on rooms.</p>
              
            </div>
            <div class="col-12 col-md-3">
                <form action="" method="post">
                    <h3 style="color: #FF6347">Please leave a review</h3>
                    <?php if( (isset($_SESSION['flash'])) && (! empty($_SESSION['flash'])) ): ?>
                        <div style="margin-bottom: 5px;"><?= $_SESSION['flash'] ?></div>
                    <?php endif; ?>
                    <div class="form-group">
                        <input type="text" name="name" id="name" required class="form-control" placeholder="Enter Your Name">
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter Your Email ID">
                    </div>
                    <div class="form-group">
                        <input type="text" name="mobile" id="mobile" required class="form-control" placeholder="Enter Your mobile Number">
                    </div>
                    <div class="form-group">
                        <textarea name="review" id="review" required class="form-control" cols="30" rows="5" placeholder="Enter your review"></textarea>
                    </div>
                    <div>
                        <button type="submit" name="btnReview" class="btn btn-primary">LEAVE YOUR REVIEW</button>
                    </div>
                    <br><br><br>
                </form>
            </div>
        </div>
	<div style = "text-align:right; margin-right:10px;" class = "navbar navbar-default navbar-fixed-bottom">
		<?php
            if( (isset($_GET['con'])) && ($_GET['con'] == '1') && (! empty($_SESSION['flash'])) ) {
                $_SESSION['flash'] = '';
            }
        ?>
	</div>
</body>
<script src = "js/jquery.js"></script>
<script src = "js/bootstrap.js"></script>	
</html>