<?php
    if(ISSET ($_POST['register'])){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = hash('sha256',$_POST['password']);
        $query = $conn->query("SELECT * FROM `users` WHERE `email` = '$email'");
        $fetch = $query->fetch_array();
        $row = $query->num_rows;
        
        if($row > 0){
            session_start();
            $_SESSION['admin_id'] = $fetch['admin_id'];
            header('location:register.php?message=Email+allready+taken');
        }else{
            $conn->query("INSERT INTO `users` (firstname, lastname, email, password) VALUES('$firstname', '$lastname', '$email' , '$password')");
            header('location:login.php?successMessage=Account+created');
        }
    }
?>