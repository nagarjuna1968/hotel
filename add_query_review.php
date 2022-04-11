<?php
require_once 'admin/connect.php';
if(ISSET($_POST['tr_id'])){
    $review = $_POST['review'];
    $tr_id = $_POST['tr_id'];
    $query = $conn->query("SELECT * FROM `transaction` WHERE `transaction_id` = '$tr_id'") or die(mysqli_error($conn));
    $fetch = $query->fetch_array();

    if(! empty($fetch)) {
        $sql = "UPDATE `transaction` SET `review`='$review' WHERE `transaction_id`=".$tr_id;
        $result = $conn->query($sql) or die(mysqli_error($conn));

        echo "<script>";
        echo "window.location.href = '".'reply_reserve.php?tr='.$tr_id.'&ty=1'."';";
        echo "</script>";
        exit();
        // redirect('reply_reserve.php?tr='.$tr_id.'&ty=1');
    }
}
?>