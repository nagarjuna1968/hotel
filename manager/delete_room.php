<?php
	require_once 'connect.php';
    include('../functions.php');
    $conn->query("DELETE FROM `room` WHERE `room_id` = '$_REQUEST[room_id]'") or die(mysqli_error($conn));
	header("location:room.php");
?>