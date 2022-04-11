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
	<nav style = "background-color:rgba(0, 0, 0, 0.1);" class = "navbar navbar-default">
		<div  class = "container-fluid">
			<div class = "navbar-header">
				<a class = "navbar-brand" >Hotel Online Reservation</a>
			</div>
		</div>
	</nav>	
	<ul id = "menu">
		<li><a href = "index.php">Home</a></li> |
		<li><a href = "aboutus.php">About us</a></li> |
		<li><a href = "contactus.php">Contact us</a></li> |
		<li><a href = "gallery.php">Gallery</a></li> |
		<li><a href = "dineandlounge.php">Dine and Lounge</a></li> |			
		<li><a href = "reservation.php">Make a reservation</a></li> |
		<li><a href = "rulesandregulation.php">Rules and Regulation</a></li>
	</ul>
	<div style = "margin-left:0;" class = "container">
		<div class = "panel panel-default">
			<div class = "panel-body">
				<strong><h3>MAKE A RESERVATION</h3></strong>
				<br />
                <?php
                    require_once 'admin/connect.php';
                    $sql_booking = "SELECT * FROM `transaction` WHERE `transaction_id`=".$_GET['tr'];
                    $result_booking = $conn->query($sql_booking);
                    $rows_booking = $result_booking->fetch_assoc();

                    if( empty($rows_booking)) {
                        redirect('reservation.php');
                    }
                ?>
				<div class = "col-md-3"></div>
				<div class = "well col-md-6">
                    <?php if( (isset($_GET['ty'])) && ($_GET['ty'] == '1') ): ?>
                        <center><h3>Please visit our Hotel for verification</h3></center>
                        <br />
                        <center><h4>THANK YOU!</h4></center>
                        <br />
                        <center><a href = "reservation.php" class = "btn btn-success"><i class = "glphyicon glyphicon-check"></i> Back to reservation</a></center>
                    <?php else: ?>
                        <h3>Please leave a review</h3>
                        <form action="" method="post">
                            <div>
                                <textarea name="review" class="form-control" required id="review" cols="30" rows="10"></textarea>
                            </div>
                            <div style="margin-top: 15px;">
                                <button class="btn btn-primary">Share Review</button>
                                <a href="reply_reserve.php?tr=<?= $_GET['tr'] ?>&ty=1" class="btn btn-success">Continue</a>
                                <input type="hidden" name="tr_id" id="tr_id" value="<?php echo $_GET['tr'] ?>">
                            </div>
                        </form>
                    <?php endif; ?>
				</div>
				<div class = "col-md-4"></div>
                <?php include('add_query_review.php') ?>
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