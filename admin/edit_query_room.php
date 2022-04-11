<?php
	require_once 'connect.php';
	if(ISSET($_POST['edit_room'])){
		$room_type = $_POST['room_type'];
        $capacity = $_POST['capacity'];
		$price = $_POST['price'];
		if($_FILES['photo']['name'] != '') {
            $photo = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
            $photo_name = addslashes($_FILES['photo']['name']);
            $photo_size = getimagesize($_FILES['photo']['tmp_name']);
        }

        $amenities = '';
		if( isset($_POST['amenities'])) {
            $amenities = json_encode($_POST['amenities']);
        }

		if(! empty($_FILES['photo']['name'])) {
            move_uploaded_file($_FILES['photo']['tmp_name'],"../photo/" . $_FILES['photo']['name']);
            $conn->query("UPDATE `room` SET `room_type` = '$room_type', `capacity`='$capacity', `price` = '$price', `photo` = '$photo_name', `amenities`='$amenities' WHERE `room_id` = '$_REQUEST[room_id]'") or die(mysqli_error());
        }
        $conn->query("UPDATE `room` SET `room_type` = '$room_type', `capacity`='$capacity', `price` = '$price', `amenities`='$amenities' WHERE `room_id` = '$_REQUEST[room_id]'") or die(mysqli_error());

		header("location:room.php");
        echo "<script>";
        echo "window.location.href = 'room.php';";
        echo "</script>";
        exit();
	}
?>