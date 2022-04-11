<?php
require_once 'connect.php';
$conn->query("DELETE FROM `reviews` WHERE `id` = '$_REQUEST[id]'") or die(mysqli_error());
header("location: reviews.php");