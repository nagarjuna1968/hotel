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
        <li><a href = "reserve.php">Reservation</a></li>
        <li><a href = "room.php">Room</a></li>
        <li><a href = "reviews.php">Reviews</a></li>
        <?php if($_SESSION['type'] == 'admin'): ?>
            <li class = "active"><a class = "active" href = "staffs.php">Managers</a></li>
        <?php endif; ?>
    </ul>
</div>
<br />
<div class = "container-fluid">
    <div class = "panel panel-default">
        <div class = "panel-body">
            <div class = "alert alert-info">Managers / Change Account</div>
            <?php
            $query = $conn->query("SELECT * FROM `admin` WHERE `admin_id` = '$_REQUEST[admin_id]'") or die(mysqli_error());
            $fetch = $query->fetch_array();
            ?>
            <br />
            <div class = "col-md-4">
                <form method = "POST" action = "edit_query_account.php?admin_id=<?php echo $fetch['admin_id']?>">
                    <div class = "form-group">
                        <label>Name </label>
                        <input type = "text" class = "form-control" value = "<?php echo $fetch['name']?>" name = "name" />
                    </div>
                    <div class = "form-group">
                        <label>Username </label>
                        <input type = "text" class = "form-control" value = "<?php echo $fetch['username']?>" name = "username" />
                    </div>
                    <div class = "form-group">
                        <label>Password </label>
                        <input type = "password" class = "form-control" value = "<?php echo $fetch['password']?>" name = "password" />
                    </div>
                    <?php
                        $roles = json_decode($fetch['roles']);
                    ?>
                    <h3>Assigned Roles</h3>
                    <hr>
                    <h4>Reservations</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="roles_list_reservation">
                                <input type="checkbox" name="roles[]" id="roles_list_reservation" <?= ( (isset($roles)) && (in_array('list_reservations', $roles)) ) ? 'checked' : '' ?> value="list_reservations"> List Reservations
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="roles_edit_reservation">
                                <input type="checkbox" name="roles[]" id="roles_edit_reservation" <?= ( (isset($roles)) && (in_array('edit_reservation', $roles)) ) ? 'checked' : '' ?> value="edit_reservation"> Edit Reservation
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="roles_delete_reservation">
                                <input type="checkbox" name="roles[]" id="roles_delete_reservation" <?= ( (isset($roles)) && (in_array('delete_reservation', $roles)) ) ? 'checked' : '' ?> value="delete_reservation"> Delete Reservation
                            </label>
                        </div>
                    </div>
                    <hr>
                    <h4>Rooms</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="roles_list_room">
                                <input type="checkbox" name="roles[]" id="roles_list_room" <?= ( (isset($roles)) && (in_array('list_rooms', $roles)) ) ? 'checked' : '' ?> value="list_rooms"> List Rooms
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="roles_add_room">
                                <input type="checkbox" name="roles[]" id="roles_add_room" <?= ( (isset($roles)) && (in_array('add_room', $roles)) ) ? 'checked' : '' ?> value="add_room"> Add Room
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="roles_edit_room">
                                <input type="checkbox" name="roles[]" id="roles_edit_room" <?= ( (isset($roles)) && (in_array('edit_room', $roles)) ) ? 'checked' : '' ?> value="edit_room"> Edit Room
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="roles_delete_room">
                                <input type="checkbox" name="roles[]" id="roles_delete_room" <?= ( (isset($roles)) && (in_array('delete_room', $roles)) ) ? 'checked' : '' ?> value="delete_room"> Delete Room
                            </label>
                        </div>
                    </div>
                    <hr>
                    <h4>Reviews</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="roles_list_review">
                                <input type="checkbox" name="roles[]" id="roles_list_review" <?= ( (isset($roles)) && (in_array('list_reviews', $roles)) ) ? 'checked' : '' ?> value="list_reviews"> List Reviews
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="roles_delete_review">
                                <input type="checkbox" name="roles[]" id="roles_delete_review" <?= ( (isset($roles)) && (in_array('delete_review', $roles)) ) ? 'checked' : '' ?> value="delete_review"> Delete Review
                            </label>
                        </div>
                    </div>
                    <br />
                    <div class = "form-group">
                        <button name = "edit_account" class = "btn btn-warning form-control"><i class = "glyphicon glyphicon-edit"></i> Save Changes</button>
                    </div>
                </form>
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
</html>