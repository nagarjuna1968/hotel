<?php session_start(); ?>
<?php include('../functions.php'); ?>
<!DOCTYPE html>
<?php require_once "connect.php"?>
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
    </div>
</nav>
<div class = "container">
    <br />
    <br />
    <div class = "col-md-4"></div>
    <div class = "col-md-4">
        <div class = "panel panel-danger">
            <div class = "panel-heading">
                <h4>Register as Manager</h4>
            </div>
            <div class = "panel-body">
                <form method = "POST">
                    <?php if(isset($_SESSION['flash'])): ?>
                    <div class="form-group">
                        <div><?= $_SESSION['flash'] ?></div>
                    </div>
                    <?php unset($_SESSION['flash']); ?>
                    <?php endif; ?>
                    <div class = "form-group">
                        <label>Name</label>
                        <input type = "text" name = "name" class = "form-control" value="<?= (isset($_SESSION['registration_data']['name'])) ? $_SESSION['registration_data']['name'] : '' ?>" required = "required" />
                    </div>
                    <div class = "form-group">
                        <label>Username</label>
                        <input type = "text" name = "username" class = "form-control" value="<?= (isset($_SESSION['registration_data']['username'])) ? $_SESSION['registration_data']['username'] : '' ?>" required = "required" />
                    </div>
                    <div class = "form-group">
                        <label>Password</label>
                        <input type = "password" name = "password" class = "form-control" required = "required" />
                    </div>
                    <br />
                    <div class = "form-group">
                        <button name = "register" class = "form-control btn btn-primary"><i class = "glyphicon glyphicon-log-in"> Register</i></button>
                        <div style="text-align: center;margin-top: 7px;">[ <a href="index.php">Login as Manager</a> ]</div>
                    </div>
                </form>
                <?php require_once 'register_post.php'?>
                <?php
                    if( isset($_SESSION['registration_data'])) {
                        unset($_SESSION['registration_data']);
                    }
                ?>
            </div>
        </div>
    </div>
    <div class = "col-md-4"></div>
</div>
<br />
<br />
<div style = "text-align:right; margin-right:10px;" class = "navbar navbar-default navbar-fixed-bottom">

</div>
</body>
<script src = "../js/jquery.js"></script>
<script src = "../js/bootstrap.js"></script>
</html>