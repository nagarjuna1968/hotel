<?php
    session_start();
    if( isset($_SESSION['user_email'])) {
        unset($_SESSION['user_email']);
    }
    if( isset($_SESSION['user_firstname'])) {
        unset($_SESSION['user_firstname']);
    }
    if( isset($_SESSION['user_lastname'])) {
        unset($_SESSION['user_lastname']);
    }
    $_SESSION['flash'] = '<div style="background-color: #DCFFD1; border:1px dashed #0D6F00; color:#0D6F00; padding:10px 12px;margin: 0 30px;">Success! You have been logged out.</div>';
    echo "<script>";
    echo "window.location.href = 'login.php';";
    echo "</script>";
?>