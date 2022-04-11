<?php
$redirectBackHereAfterLogin = true;
$showThisPageOnlyToLoggedInUser = true;
$showThisPageOnlyToGuestUser = false;
include('functions.php');
?>
<!DOCTYPE html>
<html lang = "en">
<head>
    <title>Payment Details | Hotel Online Reservation</title>
    <link rel = "icon" href = "images/logo.jpg" 
        type = "image/x-icon">
    <meta charset = "utf-8" />
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0" />
    <link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css " />
    <link rel = "stylesheet" type = "text/css" href = "css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php
include "./common/header.php"
?>
<div style = "margin-left:0;" class = "container">
    <div class = "panel panel-default">
        <div class = "panel-body">
            <strong><h3>PAYMENT DETAILS</h3></strong>
            <br />
            <?php
                require_once 'admin/connect.php';
                $sql_booking = "SELECT * FROM `transaction` WHERE `transaction_id`=".$_GET['tr'];
                $result_booking = $conn->query($sql_booking);
                $rows_booking = $result_booking->fetch_assoc();

                if( empty($rows_booking)) {
                    redirect('reservation.php');
                }

                if(! empty($rows_booking['room_id'])) {
                    $sql_room = "SELECT * FROM `room` WHERE `room_id`=".$rows_booking['room_id'];
                    $result_room = $conn->query($sql_room);
                    $rows_room = $result_room->fetch_assoc();
            ?>
            <div class="row">
                <div class="col-12 col-md-6">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="name_on_card">Name on Card</label>
                            <div><input type="text" name="name_on_card" id="name_on_card" class="form-control" required></div>
                        </div>
                        <div class="form-group">
                            <label for="name_on_card">Card Number</label>
                            <div><input type="text" name="card_number" id="card_number" class="form-control" required></div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-9">
                                <label for="">Expiry Date</label>
                                <div style="display: flex;">
                                    <div style="width: 50%; padding-right: 5px;">
                                        <select name="expiry_month" id="expiry_month" class="form-control" required>
                                            <option value="">-- MONTH --</option>
                                            <option value="01">January</option>
                                            <option value="02">February</option>
                                            <option value="03">March</option>
                                            <option value="04">April</option>
                                            <option value="05">May</option>
                                            <option value="06">June</option>
                                            <option value="07">July</option>
                                            <option value="08">August</option>
                                            <option value="09">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                    </div>
                                    <div style="width: 50%; padding-left: 5px;">
                                        <select name="expiry_year" id="expiry_year" class="form-control" required>
                                            <option value="">-- YEAR --</option>
                                            <?php for($i = date('Y') ; $i <= (date('Y') + 15 ); $i++): ?>
                                                <option value="<?= $i ?>"><?= $i ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="">CVV</label>
                                <div style="display: flex;" class="mt-3">
                                    <div style="width: 60%;"><input required type="password" name="cvv" class="form-control" id="cvv" style="text-align: right;"></div>
                                    <div style="width: 40%;text-align: right;margin-top: 5px;"><i class="fa fa-credit-card-alt fa-2x" aria-hidden="true"></i></div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">PAY <?= $rows_room['price']*$rows_booking['number_of_rooms'] ?></button>
                            <input type="hidden" name="tr_id" id="tr_id" value="<?= $_GET['tr'] ?>">
                        </div>
                    </form>
                </div>
                <div class="col-12 col-md-6">
                    <h2>Order Summary</h2>
                    <div>
                        <div class="row" style="margin-top: 15px;">
                            <div class="col-12 col-md-3"><img src="<?php echo 'photo/'.$rows_room['photo'] ?>" style="max-width: 100%" alt=""></div>
                            <div class="col-12 col-md-9">
                                <div style="font-size: 18px;font-weight: 600;"><?= $rows_room['room_type'] ?></div>
                                <div style="color: green;">Price : <?= $rows_room['price'] ?></div>
                                <div>Number of Rooms : <?= $rows_booking['number_of_rooms'] ?></div>
                                <div>Total Amount to Pay : <?= $rows_room['price']*$rows_booking['number_of_rooms'] ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12" style="padding-left: 10px;">
                                <div>
                                    <?php
                                    $amenities = json_decode($rows_room['amenities']);
                                    if( (isset($amenities)) && (is_array($amenities)) && (count($amenities)) ) :
                                        echo "<div style='padding: 0 0 0 2px;'>";
                                        foreach ($amenities as $item):
                                            ?>
                                            <div style="margin-right: 15px;"><?= "&#10003; ".ucwords(str_replace('_', ' ', $item)) ?></div>
                                        <?php endforeach; ?>
                                        <?php echo "</div>"; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                    <?php require_once 'add_query_payment_details.php'?>
            <?php } ?>
        </div>
    </div>
</div>
<br />
<br />
<div style = "text-align:right; margin-right:10px;" class = "navbar navbar-default navbar-fixed-bottom">

</div>
</body>
<script src = "js/jquery.js"></script>
<script src = "js/bootstrap.js"></script>
<script>
    $(document).ready(function() {
        $(document).on('keypress', '#cvv', function (event) {
            if($(this).val().length > 2) {
                event.preventDefault();
            }
        });
        $(document).on('keypress', '#card_number', function(event) {
            var length = $(this).val().length;
            if( (length==4) || (length == 9) || (length == 14) ){
                $(this).val($(this).val() + '-');
            }
            if(length>18) {
                event.preventDefault();
            }
            console.log(length);
        });
        $('#card_number').bind("cut copy paste",function(e) {
            e.preventDefault();
        });
    });
</script>
</html>