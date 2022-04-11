<?php
if(ISSET($_POST['add_account'])){
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $roles = ( (isset($_POST['roles'])) && (is_array($_POST['roles'])) && (count($_POST['roles'])) ) ? json_encode($_POST['roles']) : '';
    $query = $conn->query("SELECT * FROM `admin` WHERE `username` = '$username'") or die(mysqli_error());
    $valid = $query->num_rows;
    if($valid > 0){
        echo "<center><label style = 'color:red;'>Username already taken</center></label>";
    }else{
        $conn->query("INSERT INTO `admin` (name, username, password, roles) VALUES('$name', '$username', '$password','$roles')") or die(mysqli_error($conn));
        echo "<script>";
        echo "window.location.href = 'staffs.php';";
        echo "</script>";
        // header("location:staffs.php");
    }
}
?>