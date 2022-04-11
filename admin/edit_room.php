<!DOCTYPE html>
<?php
	require_once 'validate.php';
	require 'name.php';
?>
<html lang = "en">
	<head>
		<title>Hotel Online Reservation</title>
		<meta charset = "utf-8" />
		<meta name = "viewport" content = "width=device-width, initial-scale=1.0" />
		<link rel = "stylesheet" type = "text/css" href = "../css/bootstrap.css " />
		<link rel = "stylesheet" type = "text/css" href = "../css/style.css" />
	</head>
<body>
	<nav style = "background-color:rgba(0, 0, 0, 0.1);" class = "navbar navbar-default">
		<div  class = "container-fluid">
			<div class = "navbar-header">
				<a class = "navbar-brand" >Hotel Online Reservation</a>
			</div>
			<ul class = "nav navbar-nav pull-right ">
				<li class = "dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class = "glyphicon glyphicon-user"></i> <?php echo $name;?></a>
					<ul class="dropdown-menu">
						<li><a href="logout.php"><i class = "glyphicon glyphicon-off"></i> Logout</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
	<div class = "container-fluid">	
		<ul class = "nav nav-pills">
			<li><a href = "home.php">Home</a></li>
			<li><a href = "reserve.php">Reservation</a></li>
			<li class="active"><a href = "room.php">Room</a></li>
            <li><a href = "reviews.php">Reviews</a></li>
            <?php if($_SESSION['type'] == 'admin'): ?>
                <li><a href = "staffs.php">Managers</a></li>
            <?php endif; ?>
		</ul>	
	</div>
	<br />
	<div class = "container-fluid">
		<div class = "panel panel-default">
			<div class = "panel-body">
				<div class = "alert alert-info">Transaction / Room / Change Room</div>
				<br />
				<div class = "col-md-4">
					<?php
						$query = $conn->query("SELECT * FROM `room` WHERE `room_id` = '$_REQUEST[room_id]'") or die(mysqli_error());
						$fetch = $query->fetch_array();
					?>
					<form method = "POST" enctype = "multipart/form-data">
						<div class = "form-group">
							<label>Room Type </label>
							<select class = "form-control" required = required name = "room_type">
								<option value = "">Choose an option</option>
								<option value = "Standard" <?php if($fetch['room_type'] == "Standard"){echo "selected";}?>>Standard</option>
								<option value = "Superior" <?php if($fetch['room_type'] == "Superior"){echo "selected";}?>>Superior</option>
								<option value = "Super Deluxe" <?php if($fetch['room_type'] == "Super Deluxe"){echo "selected";}?>>Super Deluxe</option>
								<option value = "Jr. Suite" <?php if($fetch['room_type'] == "Jr. Suite"){echo "selected";}?>>Jr. Suite</option>
								<option value = "Executive Suite" <?php if($fetch['room_type'] == "Executive Suite"){echo "selected";}?>>Executive Suite</option>
							</select>
						</div>
                        <div class = "form-group">
                            <label>Accommodation </label>
                            <input type = "number" min = "0" max = "999999999" value = "<?php echo $fetch['capacity']?>" class = "form-control" name = "capacity" />
                        </div>
						<div class = "form-group">
							<label>Price </label>
							<input type = "number" min = "0" max = "999999999" value = "<?php echo $fetch['price']?>" class = "form-control" name = "price" />
						</div>
						<div class = "form-group">
							<label>Photo </label>
							<div id = "preview" style = "width:150px; height :150px; border:1px solid #000;">
								<img src = "../photo/<?php echo $fetch['photo']?>" id = "lbl" width = "100%" height = "100%"/>
							</div>
							<input type = "file" id = "photo" name = "photo" />
						</div>
						<br />
                        <h3>Amenities</h3>
                        <?php
                            $amenities_arr = json_decode($fetch['amenities']);
                        ?>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <label for="amenities_kitchen_facility">
                                    <input type="checkbox" value="kitchen_facility" id="amenities_kitchen_facility" name="amenities[]" <?= ( (is_array($amenities_arr)) && (in_array('kitchen_facility', $amenities_arr)) ) ? 'checked' : '' ; ?>>
                                    Kitchen Facility
                                </label>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="amenities_tv_with_cable">
                                    <input type="checkbox" value="tv_with_cable" id="amenities_tv_with_cable" name="amenities[]" <?= ( (is_array($amenities_arr)) && (in_array('tv_with_cable', $amenities_arr)) ) ? 'checked' : '' ; ?>>
                                    TV with cable
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <label for="amenities_hair_dryer">
                                    <input type="checkbox" value="hair_dryer" id="amenities_hair_dryer" name="amenities[]" <?= ( (is_array($amenities_arr)) && (in_array('hair_dryer', $amenities_arr)) ) ? 'checked' : '' ; ?>>
                                    Hair Dryer
                                </label>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="amenities_dining_options">
                                    <input type="checkbox" value="dining_options" id="amenities_dining_options" name="amenities[]" <?= ( (is_array($amenities_arr)) && (in_array('dining_options', $amenities_arr)) ) ? 'checked' : '' ; ?>>
                                    Dining Options
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <label for="amenities_recreational_activities">
                                    <input type="checkbox" value="recreational_activities" id="amenities_recreational_activities" name="amenities[]" <?= ( (is_array($amenities_arr)) && (in_array('recreational_activities', $amenities_arr)) ) ? 'checked' : '' ; ?>>
                                    Recreational activities
                                </label>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="amenities_swimming_pool">
                                    <input type="checkbox" value="swimming_pool" id="amenities_swimming_pool" name="amenities[]" <?= ( (is_array($amenities_arr)) && (in_array('swimming_pool', $amenities_arr)) ) ? 'checked' : '' ; ?>>
                                    Swimming pool
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <label for="amenities_parking">
                                    <input type="checkbox" value="parking" id="amenities_parking" name="amenities[]" <?= ( (is_array($amenities_arr)) && (in_array('parking', $amenities_arr)) ) ? 'checked' : '' ; ?>>
                                    Parking
                                </label>
                            </div>
                        </div>
                        <br>
						<div class = "form-group">
							<button name = "edit_room" class = "btn btn-warning form-control"><i class = "glyphicon glyphicon-edit"></i> Save Changes</button>
						</div>
					</form>
					<?php require_once 'edit_query_room.php'?>
				</div>
			</div>
		</div>
	</div>
	<br />
	<br />
	<div style = "text-align:right; margin-right:10px;" class = "navbar navbar-default navbar-fixed-bottom">
		 
	</div>
</body>
<script src = "../js/jquery.js"></script>
<script src = "../js/bootstrap.js"></script>
<script type = "text/javascript">
	$(document).ready(function(){
		$pic = $('<img id = "image" width = "100%" height = "100%"/>');
		$lbl = $('<center id = "lbl">[Photo]</center>');
		$("#photo").change(function(){
			$("#lbl").remove();
			var files = !!this.files ? this.files : [];
			if(!files.length || !window.FileReader){
				$("#image").remove();
				$lbl.appendTo("#preview");
			}
			if(/^image/.test(files[0].type)){
				var reader = new FileReader();
				reader.readAsDataURL(files[0]);
				reader.onloadend = function(){
					$pic.appendTo("#preview");
					$("#image").attr("src", this.result);
				}
			}
		});
	});
</script>
</html>