<?php
	$redirectBackHereAfterLogin = true;
    $showThisPageOnlyToLoggedInUser = true;
    $showThisPageOnlyToGuestUser = false;
    include('functions.php');
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
        <style>
        #main {
            height: 100%;
            font-size: 20px;
            font-weight: bold;
        }
        #div1 {
            float: left;
            width: 35%;
            height: 100%;
            margin-right: 10%;
        }
        #div2 {
            font-size: 15px;
            width: 70%;
            height: 100%; 
            margin-left: 20%;
        }
    </style>
	</head>
<body>
	<?php
		include "./common/header.php"
	?>
	<div style = "margin-left:0;" class = "container">
		<div class = "panel panel-default">
			<div class = "panel-body">
				<strong><h3>MAKE A RESERVATION</h3></strong>
				<br />
				<?php
					require_once 'admin/connect.php';
					$query = $conn->query("SELECT * FROM `room` WHERE `room_id` = '$_REQUEST[room_id]'") or die(mysql_error());
					$fetch = $query->fetch_array();
				?>
				<div style = "height:300px; width:800px;">
					<div style = "float:left;">
						<img src = "photo/<?php echo $fetch['photo']?>" height = "300px" width = "400px">
					</div>
					<div style = "float:left; margin-left:10px;">
						<h3><?php echo $fetch['room_type']?></h3>
						<h3 style = "color:#FF6347;"><b><?php echo "Php. ".$fetch['price'].".00";?></b></h3>
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
				</div>
				<br style = "clear:both;" />
                <div id="main">
				<div class = "well col-md-4" id="div1">
					<form method = "POST" enctype = "multipart/form-data" id="frmSubmit">
						<div class = "form-group">
							<label>Firstname</label>
							<input type = "text" class = "form-control" value="<?php echo (! empty($_SESSION['reservation_data']['firstname'])) ? $_SESSION['reservation_data']['firstname'] : $_SESSION['user_firstname'] ?>" name = "firstname" required = "required" />
						</div>
						<div class = "form-group">
							<label>Middlename</label>
							<input type = "text" class = "form-control" name = "middlename" value="<?= (! empty($_SESSION['reservation_data']['middlename'])) ? $_SESSION['reservation_data']['middlename'] : '' ?>" required = "required" />
						</div>
						<div class = "form-group">
							<label>Lastname</label>
							<input type = "text" class = "form-control" value="<?php echo (! empty($_SESSION['reservation_data']['lastname'])) ? $_SESSION['reservation_data']['lastname'] : $_SESSION['user_lastname'] ?>" name = "lastname" required = "required" />
						</div>
						<div class = "form-group">
							<label>Address</label>
							<input type = "text" class = "form-control" name = "address" required = "required" value="<?= (! empty($_SESSION['reservation_data']['address'])) ? $_SESSION['reservation_data']['address'] : '' ?>" />
						</div>
						<div class = "form-group">
							<label>Contact No</label>
							<input type = "text" class = "form-control" name = "contactno" required = "required" value="<?= (! empty($_SESSION['reservation_data']['contactno'])) ? $_SESSION['reservation_data']['contactno'] : '' ?>" />
						</div>
						<div class = "form-group">
							<label>Check in (Date)</label>
							<input type = "date" class = "form-control" name = "date" required = "required" value="<?= (! empty($_SESSION['reservation_data']['date'])) ? $_SESSION['reservation_data']['date'] : '' ?>" />
						</div>
                        <div class = "form-group">
                            <label>Check in (Time)</label>
                            <select name="checkin_time" id="checkin_time" class="form-control" required>
                                <option value=""> -- SELECT A TIME -- </option>
                                <option value="00:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkin_time'] == '00:00:00') ) ? 'selected' : '' ?>>12 AM</option>
                                <option value="01:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkin_time'] == '01:00:00') ) ? 'selected' : '' ?>>01 AM</option>
                                <option value="02:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkin_time'] == '02:00:00') ) ? 'selected' : '' ?>>02 AM</option>
                                <option value="03:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkin_time'] == '03:00:00') ) ? 'selected' : '' ?>>03 AM</option>
                                <option value="04:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkin_time'] == '04:00:00') ) ? 'selected' : '' ?>>04 AM</option>
                                <option value="05:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkin_time'] == '05:00:00') ) ? 'selected' : '' ?>>05 AM</option>
                                <option value="06:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkin_time'] == '06:00:00') ) ? 'selected' : '' ?>>06 AM</option>
                                <option value="07:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkin_time'] == '07:00:00') ) ? 'selected' : '' ?>>07 AM</option>
                                <option value="08:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkin_time'] == '08:00:00') ) ? 'selected' : '' ?>>08 AM</option>
                                <option value="09:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkin_time'] == '09:00:00') ) ? 'selected' : '' ?>>09 AM</option>
                                <option value="10:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkin_time'] == '10:00:00') ) ? 'selected' : '' ?>>10 AM</option>
                                <option value="11:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkin_time'] == '11:00:00') ) ? 'selected' : '' ?>>11 AM</option>
                                <option value="12:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkin_time'] == '12:00:00') ) ? 'selected' : '' ?>>12 PM</option>
                                <option value="13:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkin_time'] == '13:00:00') ) ? 'selected' : '' ?>>01 PM</option>
                                <option value="14:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkin_time'] == '14:00:00') ) ? 'selected' : '' ?>>02 PM</option>
                                <option value="15:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkin_time'] == '15:00:00') ) ? 'selected' : '' ?>>03 PM</option>
                                <option value="16:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkin_time'] == '16:00:00') ) ? 'selected' : '' ?>>04 PM</option>
                                <option value="17:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkin_time'] == '17:00:00') ) ? 'selected' : '' ?>>05 PM</option>
                                <option value="18:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkin_time'] == '18:00:00') ) ? 'selected' : '' ?>>06 PM</option>
                                <option value="19:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkin_time'] == '19:00:00') ) ? 'selected' : '' ?>>07 PM</option>
                                <option value="20:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkin_time'] == '20:00:00') ) ? 'selected' : '' ?>>08 PM</option>
                                <option value="21:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkin_time'] == '21:00:00') ) ? 'selected' : '' ?>>09 PM</option>
                                <option value="22:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkin_time'] == '22:00:00') ) ? 'selected' : '' ?>>10 PM</option>
                                <option value="23:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkin_time'] == '23:00:00') ) ? 'selected' : '' ?>>11 PM</option>
                            </select>
                        </div>
                        <div class = "form-group">
                            <label>Check out (Date)</label>
                            <input type = "date" class = "form-control" name = "checkout_date" value="<?= (! empty($_SESSION['reservation_data']['checkout_date'])) ? $_SESSION['reservation_data']['checkout_date'] : '' ?>" required = "required" />
                        </div>
                        <div class = "form-group">
                            <label>Check out (Time)</label>
                            <select name="checkout_time" id="checkout_time" class="form-control" required>
                                <option value=""> -- SELECT A TIME -- </option>
                                <option value="00:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkout_time'] == '00:00:00') ) ? 'selected' : '' ?>>12 AM</option>
                                <option value="01:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkout_time'] == '01:00:00') ) ? 'selected' : '' ?>>01 AM</option>
                                <option value="02:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkout_time'] == '02:00:00') ) ? 'selected' : '' ?>>02 AM</option>
                                <option value="03:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkout_time'] == '03:00:00') ) ? 'selected' : '' ?>>03 AM</option>
                                <option value="04:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkout_time'] == '04:00:00') ) ? 'selected' : '' ?>>04 AM</option>
                                <option value="05:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkout_time'] == '05:00:00') ) ? 'selected' : '' ?>>05 AM</option>
                                <option value="06:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkout_time'] == '06:00:00') ) ? 'selected' : '' ?>>06 AM</option>
                                <option value="07:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkout_time'] == '07:00:00') ) ? 'selected' : '' ?>>07 AM</option>
                                <option value="08:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkout_time'] == '08:00:00') ) ? 'selected' : '' ?>>08 AM</option>
                                <option value="09:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkout_time'] == '09:00:00') ) ? 'selected' : '' ?>>09 AM</option>
                                <option value="10:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkout_time'] == '10:00:00') ) ? 'selected' : '' ?>>10 AM</option>
                                <option value="11:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkout_time'] == '11:00:00') ) ? 'selected' : '' ?>>11 AM</option>
                                <option value="12:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkout_time'] == '12:00:00') ) ? 'selected' : '' ?>>12 PM</option>
                                <option value="13:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkout_time'] == '13:00:00') ) ? 'selected' : '' ?>>01 PM</option>
                                <option value="14:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkout_time'] == '14:00:00') ) ? 'selected' : '' ?>>02 PM</option>
                                <option value="15:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkout_time'] == '15:00:00') ) ? 'selected' : '' ?>>03 PM</option>
                                <option value="16:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkout_time'] == '16:00:00') ) ? 'selected' : '' ?>>04 PM</option>
                                <option value="17:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkout_time'] == '17:00:00') ) ? 'selected' : '' ?>>05 PM</option>
                                <option value="18:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkout_time'] == '18:00:00') ) ? 'selected' : '' ?>>06 PM</option>
                                <option value="19:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkout_time'] == '19:00:00') ) ? 'selected' : '' ?>>07 PM</option>
                                <option value="20:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkout_time'] == '20:00:00') ) ? 'selected' : '' ?>>08 PM</option>
                                <option value="21:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkout_time'] == '21:00:00') ) ? 'selected' : '' ?>>09 PM</option>
                                <option value="22:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkout_time'] == '22:00:00') ) ? 'selected' : '' ?>>10 PM</option>
                                <option value="23:00:00" <?= ( (! empty($_SESSION['reservation_data']['checkin_time'])) && ($_SESSION['reservation_data']['checkout_time'] == '23:00:00') ) ? 'selected' : '' ?>>11 PM</option>
                            </select>
                        </div>
                        <div class = "form-group">
                            <label>Number of Persons</label>
                            <input type = "number" class = "form-control" name = "number_of_persons" id="number_of_persons" value="<?= (! empty($_SESSION['reservation_data']['number_of_persons'])) ? $_SESSION['reservation_data']['number_of_persons'] : '1' ?>" required = "required" />
                        </div>
                        <div class = "form-group">
                            <label>Number of Rooms Required</label>
                            <input type = "number" class = "form-control" name = "number_of_rooms" id="number_of_rooms" value="<?= (! empty($_SESSION['reservation_data']['number_of_rooms'])) ? $_SESSION['reservation_data']['number_of_rooms'] : '1' ?>" required = "required" />
                        </div>
						<br />
						<div class = "form-group">
							<button class = "btn btn-info form-control" name = "add_guest"><i class = "glyphicon glyphicon-save"></i> Submit</button>
						</div>
                        <br>
                        <?php if( (isset($_SESSION['flash'])) && (! empty($_SESSION['flash'])) ): ?>
                            <div class="form-group">
                                <?= $_SESSION['flash'] ?>
                                <?php unset($_SESSION['flash']) ?>
                            </div>
                        <?php endif; ?>
                        <?php
                            if( isset($_SESSION['reservation_data'])) {
                                unset($_SESSION['reservation_data']);
                            }
                        ?>
					</form>
				</div>
                <div id="div2">
                <strong><h4><b>RULES AND REGULATION</b></h4></strong>
				<br />
				<strong><h4 style = "color:#ff0000;"><b>1. Payment</b></h4></strong>
				<p><b style = "color:#ff0000;">Once payment is and cannot be refunded.</b> Until specific reason and you need to contact us. </p>
				<br />
				<strong><h4 style = "color:#ff0000;"><b>2. Settlement of Bills</b></h4></strong>
				<p>Bills must be settled on presentation, <b style = "color:#ff0000;">personal cheques are not accepted.</b></p>
				<br />
				<strong><h4 style = "color:#ff0000;"><b>3. Check-in<b></h4></strong>
				<p><b style = "color:#ff0000;">Please present your ID card, Passport or Temporary Residence Card upon Check-in.</b> By Law visitors must present personal documents for hotel records. These documents will be returned upon departure.</p>
				<br />
				<strong><h4 style = "color:#ff0000;"><b>4. Departure</b></h4></strong>
				<p>Check out time is ( mention your checkout time here ) please inform the reception if you wish to retain your room beyond this time. <b style = "color:#ff0000;">Extension will be given depending on the availability</b> . If the room is available, normal tariff will be charged. On failure of the guest to vacate the room on expiry or period the management shall have the right to remove the guest and his/her belongings from the room occupied by the Guest.</p>
				<br />
				<strong><h4 style = "color:#ff0000;"><b>5. Luggage Storage</b></h4></strong>
				<p>Subject to availability of the storage space, the guest can store luggage in the luggage room, <b style = "color:#ff0000;">at the guest's sole risk as to loss or damage from any cause</b>, Luggage may not be stored for period of over 30 days.</p>
				<br />
				<strong><h4 style = "color:#ff0000;"><b>6. Pets</b></h4></strong>
				<p>Mention your policy for Pets ( allowed or not- allowed ) (Allow us to make separate arrangements. )</p>
				<br />
				<strong><h4 style = "color:#ff0000;"><b>7. Damage to Property<b></h4></strong>
				<p><b style = "color:#ff0000;">The guest will be held responsible for any loss or damage to the hotel property caused by themselves</b>, their guests or any person for whom they are responsible.</p>
				<br />
                        </div>
                        </div>
				<div class = "col-md-4"></div>
				<?php require_once 'add_query_reserve.php'?>
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
    <script>
        $(document).ready(function() {
            $(document).on('submit', '#frmSubmit', function(event) {

            });

            $(document).on('change', '#number_of_persons', function () {
                if($(this).val() <= 0) {
                    $(this).val('1');
                }
            });

            $(document).on('blur', '#number_of_persons', function () {
                if($(this).val() <= 0) {
                    $(this).val('1');
                }
            });

            $(document).on('change', '#number_of_rooms', function () {
                if($(this).val() <= 0) {
                    $(this).val('1');
                }
            });

            $(document).on('blur', '#number_of_rooms', function () {
                if($(this).val() <= 0) {
                    $(this).val('1');
                }
            });
        });
    </script>
</html>