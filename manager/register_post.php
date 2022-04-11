<?php
if(ISSET ($_POST['register'])){
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = $conn->query("SELECT * FROM `admin` WHERE `username` = '$username'") or die(mysqli_error());
    $fetch = $query->fetch_array();
    $row = $query->num_rows;

    if($row > 0){
        $_SESSION['flash'] = '<div style="background-color: #FFD1D1; border:1px dashed #6F0000; color:#6F0000; padding:10px 12px;margin: 0 30px;">Error! Username is already in use.</div>';
        $_SESSION['registration_data'] = $_POST;
        header('location:register.php');
    }else{
        $sql = "INSERT INTO `admin` (`name`, `username`, `password`) VALUES ('$name', '$username', '$password')";
        $conn->query($sql);
        $_SESSION['flash'] = '<div style="background-color: #DCFFD1; border:1px dashed #0D6F00; color:#0D6F00; padding:10px 12px;margin: 0 30px;">Success! Registration Completed. Please Login.</div>';
        header('location:index.php');
    }
}
?>