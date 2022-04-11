<?php
	require_once 'connect.php';
	if(ISSET($_POST['edit_account'])){
		$name = $_POST['name'];
		$username = $_POST['username'];
		$password = $_POST['password'];
        $roles = ( (isset($_POST['roles'])) && (is_array($_POST['roles'])) && (count($_POST['roles'])) ) ? json_encode($_POST['roles']) : '';
        if(! empty($password)) {
            $conn->query("UPDATE `admin` SET `name` = '$name', `username` = '$username', `password` = '$password', `roles` = '$roles' WHERE `admin_id` = '$_REQUEST[admin_id]'") or die(mysqli_error($conn));
        } else {
            $conn->query("UPDATE `admin` SET `name` = '$name', `username` = '$username', `roles` = '$roles' WHERE `admin_id` = '$_REQUEST[admin_id]'") or die(mysqli_error($conn));
        }

		header("location:staffs.php");
	}	