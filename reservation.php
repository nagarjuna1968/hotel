<?php
	$redirectBackHereAfterLogin = false;
    $showThisPageOnlyToLoggedInUser = false;
    $showThisPageOnlyToGuestUser = false;
?>
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
		include "./common/header.php"
	?>
	<div style = "margin-left:0;" class = "container">
		<div class = "panel panel-default">
			<div class = "panel-body">
				<strong><h3>MAKE A RESERVATION</h3></strong>
				<?php
					require_once 'admin/connect.php';
					$query = $conn->query("SELECT * FROM `room` ORDER BY `price` ASC") or die(mysql_error());
					while($fetch = $query->fetch_array()){
				?>
					<div class = "well" style = "height:300px; width:100%;position: relative;">
                        <div>
                            <div style = "float:left;">
                                <img src = "photo/<?php echo $fetch['photo']?>" height = "250" width = "350"/>
                            </div>
                            <div style = "float:left; margin-left:10px;">
                                <h3><?php echo $fetch['room_type']?> </h3>
                                <h4 style="color: #FF6347"><b><?php echo "Price:  ".$fetch['price'].".00"?></b></h4>
                                <h4>Accommodation : <?= (! empty($fetch['capacity'])) ? $fetch['capacity'].' person(s) / room' : 'Not Mentioned' ?></h4>
                                <?php
                                $amenities = json_decode($fetch['amenities']);
                                if( (isset($amenities)) && (is_array($amenities)) && (count($amenities)) ) :
                                    echo "<div style='padding: 0 0 0 2px;'>";
                                    foreach ($amenities as $item):
                                        ?>
                                        <div style="margin-right: 15px;"><?= "&#10003; ".ucwords(str_replace('_', ' ', $item)) ?></div>
                                    <?php endforeach; ?>
                                    <?php echo "</div>"; ?>
                                <?php endif; ?>
                            </div>
                            <div style="clear: both;"></div>
                        </div>
                        <a style = "position: absolute;bottom:15px;right:15px;" href = "add_reserve.php?room_id=<?php echo $fetch['room_id']?>" class = "btn btn-info"><i class = "glyphicon glyphicon-list"></i> Reserve</a>
					</div>
				<?php
					}
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