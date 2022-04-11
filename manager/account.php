<?php include('../functions.php'); ?>
<!DOCTYPE html>
<?php
require_once 'validate.php';
require 'name.php';
?>
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
        <ul class = "nav navbar-nav pull-right ">
            <li class = "dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class = "glyphicon glyphicon-user"></i> <?php echo $name;?></a>
                <ul class="dropdown-menu">
                    <li><a href="logout.php"><i class = "glyphicon glyphicon-off"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
<div class = "container-fluid">
    <ul class = "nav nav-pills">
        <li><a href = "home.php">Home</a></li>
        <li class="active"><a href = "account.php">Accounts</a></li>
        <?php if( managerRoles('list_reservations') ): ?>
            <li><a href = "reserve.php">Reservation</a></li>
        <?php endif; ?>
        <?php if( managerRoles('list_rooms') ): ?>
            <li><a href = "room.php">Room</a></li>
        <?php endif; ?>
        <?php if( managerRoles('list_reviews') ): ?>
            <li><a href = "reviews.php">Reviews</a></li>
        <?php endif; ?>
    </ul>
</div>
<br />
<div class = "container-fluid">
    <div class = "panel panel-default">
        <div class = "panel-body">
            <div class = "alert alert-info">Account / Edit Profile</div>
            <br />
            <div class = "col-md-4">
                <?php
                $query = $conn->query("SELECT * FROM `admin` WHERE `admin_id` = '".$_SESSION['admin_id']."'") or die(mysqli_error($conn));
                $fetch = $query->fetch_array();
                ?>
                <form method = "POST" enctype = "multipart/form-data">
                    <div class = "form-group">
                        <label>Name </label>
                        <input type="text" name="name" id="name" class="form-control" value="<?= $fetch['name'] ?>">
                    </div>
                    <div class = "form-group">
                        <label>Username </label>
                        <input type = "text" name="username" id="username" value = "<?php echo $fetch['username']?>" class = "form-control" />
                    </div>
                    <div class = "form-group">
                        <label>Password </label>
                        <input type = "password" name="password" id="password" value = "" class = "form-control" />
                    </div>
                    <br />
                    <div class = "form-group">
                        <button name = "edit_account" class = "btn btn-warning form-control"><i class = "glyphicon glyphicon-edit"></i> Save Changes</button>
                    </div>
                </form>
                <?php require_once 'edit_query_account.php'?>
            </div>
        </div>
    </div>
</div>
<br />
<br />
<div style = "text-align:right; margin-right:10px;" class = "navbar navbar-default navbar-fixed-bottom">

</div>
</body>
<script src = "../js/jquery.js"></script>
<script src = "../js/bootstrap.js"></script>
<script type = "text/javascript">
    $(document).ready(function(){
        $pic = $('<img id = "image" width = "100%" height = "100%"/>');
        $lbl = $('<center id = "lbl">[Photo]</center>');
        $("#photo").change(function(){
            $("#lbl").remove();
            var files = !!this.files ? this.files : [];
            if(!files.length || !window.FileReader){
                $("#image").remove();
                $lbl.appendTo("#preview");
            }
            if(/^image/.test(files[0].type)){
                var reader = new FileReader();
                reader.readAsDataURL(files[0]);
                reader.onloadend = function(){
                    $pic.appendTo("#preview");
                    $("#image").attr("src", this.result);
                }
            }
        });
    });
</script>
</html>