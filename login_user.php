<?php
	if(ISSET ($_POST['login'])){
        echo "hello";
		$email = $_POST['email'];
		$password = hash('sha256',$_POST['password']);
		$reqUrl = $_POST['reqUrl'] || "";
		$query = $conn->query("SELECT * FROM `users` WHERE `email` = '$email' && `password` = '$password'");
		$fetch = $query->fetch_array();
		$row = $query->num_rows;
		$appendQuery = "";
		if($row > 0){
			session_start();
			$_SESSION['user_email'] = $fetch['email'];
			$_SESSION['user_firstname'] = $fetch['firstname'];
			$_SESSION['user_lastname'] = $fetch['lastname'];
			if($reqUrl && $reqUrl !== ""){
				$reqUrl =  urldecode($_POST['reqUrl']);
				header("location:$reqUrl");
			}else{
				header('location:index.php');
			}
		}else{
			if($reqUrl && $reqUrl !== ""){
				$reqUrl =  urldecode($_POST['reqUrl']);
				$reqUrl = urlencode($reqUrl);
				$appendQuery = "&reqUrl=$reqUrl";
			}
            header("location:login.php?message=Invalid+username+or+password$appendQuery");
		}
	}
?>