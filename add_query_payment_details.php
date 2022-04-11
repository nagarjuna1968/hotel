<?php
require_once 'admin/connect.php';
if(ISSET($_POST['tr_id'])){
    $name_on_card = $_POST['name_on_card'];
    $card_number = $_POST['card_number'];
    $expiry_month = $_POST['expiry_month'];
    $expiry_year = $_POST['expiry_year'];
    $cvv = $_POST['cvv'];
    $tr_id = $_POST['tr_id'];
    $query = $conn->query("SELECT * FROM `transaction` WHERE `transaction_id` = '$tr_id'") or die(mysqli_error($conn));
    $fetch = $query->fetch_array();

    if(! empty($fetch)) {
        $sql = "UPDATE `transaction` SET `name_on_card`='$name_on_card', `credit_card_number`='$card_number', `expiry_month`='$expiry_month', `expiry_year`='$expiry_year', `cvv`='$cvv' WHERE `transaction_id`=".$tr_id;
        $result = $conn->query($sql) or die(mysqli_error($conn));

        echo "<script>";
        echo "window.location.href = '".'reply_reserve.php?tr='.$tr_id."';";
        echo "</script>";
        exit();
    }
}
?>