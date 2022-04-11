<?php
	require_once 'admin/connect.php';
	if(ISSET($_POST['add_guest'])){
		$firstname = $_POST['firstname'];
		$middlename = $_POST['middlename'];
		$lastname = $_POST['lastname'];
		$address = $_POST['address'];
		$contactno = $_POST['contactno'];
		$checkin = $_POST['date'];
        $checkin_time = $_POST['checkin_time'];
        $checkout = $_POST['checkout_date'];
        $checkout_time = $_POST['checkout_time'];
		$conn->query("INSERT INTO `guest` (firstname, middlename, lastname, address, contactno) VALUES('$firstname', '$middlename', '$lastname', '$address', '$contactno')") or die(mysqli_error());
		$query = $conn->query("SELECT * FROM `guest` WHERE `firstname` = '$firstname' && `lastname` = '$lastname' && `contactno` = '$contactno'") or die(mysqli_error());
		$fetch = $query->fetch_array();
		$query2 = $conn->query("SELECT * FROM `transaction` WHERE `checkin` = '$checkin' && `room_id` = '$_REQUEST[room_id]' && `status` = 'Pending'") or die(mysqli_error());
		$row = $query2->num_rows;
		if(strtotime($checkin.' '.$checkin_time) >= strtotime($checkout.' '.$checkout_time)) {
            $_SESSION['flash'] = '<div style="background-color: #FFD1D1; border:1px dashed #6F0000; color:#6F0000; padding:10px 12px;margin: 0 30px;">Error! Checkout time can not be less than checkin time.</div>';
            $_SESSION['reservation_data'] = $_REQUEST;
            redirect('add_reserve.php?room_id='.$_REQUEST['room_id']);
        }
		if($checkin < date("Y-m-d", strtotime('+8 HOURS'))){	
				echo "<script>alert('Must be present date')</script>";
			}else{
				if($row > 0){
					echo "<div class = 'col-md-4'>
								<label style = 'color:#ff0000;'>Not Available Date</label><br />";
							$q_date = $conn->query("SELECT * FROM `transaction` WHERE `status` = 'Pending'") or die(mysqli_error());
							while($f_date = $q_date->fetch_array()){
								echo "<ul>
										<li>	
											<label class = 'alert-danger'>".date("M d, Y", strtotime($f_date['checkin']."+8HOURS"))."</label>	
										</li>
									</ul>";
							}
						"</div>";
				}else{	
						if($guest_id = $fetch['guest_id']){
							$room_id = $_REQUEST['room_id'];
                            $number_of_persons = $_REQUEST['number_of_persons'];
                            $number_of_rooms = $_REQUEST['number_of_rooms'];

							$sql_room = "SELECT * FROM `room` WHERE `room_id`=".$room_id;
                            $query_room = $conn->query($sql_room) or die(mysqli_error($conn));
                            $fetch_room = $query_room->fetch_assoc();

                            if(! empty($fetch_room)) {
                                if(! empty($fetch_room['capacity'])) {
                                    $total_rooms_required = ceil($number_of_persons / $fetch_room['capacity']);
                                    if($_REQUEST['number_of_rooms'] >= $total_rooms_required) {
                                        $conn->query("INSERT INTO `transaction`(guest_id, room_id, status, checkin, checkin_time, checkout, checkout_time, number_of_persons, number_of_rooms) VALUES ('$guest_id', '$room_id', 'Pending', '$checkin', '$checkin_time', '$checkout', '$checkout_time','$number_of_persons', '$number_of_rooms')") or die(mysqli_error($conn));

                                        $txt = "<div>Hello!</div>";
                                        $txt .= "<div>Your booking was successful, please proceed to payment.</div>";
                                        $txt .= "<div style='margin-top:12px;font-size:14px;'>YOUR BOOKING SUMMARY</div>";
                                        $txt .= '<div><strong>Name</strong> : '.$firstname.' '.$middlename.' '.$lastname.'</div>';
                                        $txt .= '<div><strong>Address</strong> : '.$address.'</div>';
                                        $txt .= '<div><strong>Contact Number</strong> : '.$contactno.'</div>';
                                        $txt .= '<div><strong>Room Type</strong> : '.$fetch_room['room_type'].'</div>';
                                        $txt .= '<div><strong>Number of Person</strong> : '.$number_of_persons.'</div>';
                                        $txt .= '<div><strong>Number of Rooms booked</strong> : '.$number_of_rooms.'</div>';

                                        $ch = curl_init();

                                        curl_setopt($ch, CURLOPT_URL,"https://www.fabroba.com/api/test-email");
                                        curl_setopt($ch, CURLOPT_POST, 1);
                                        curl_setopt($ch, CURLOPT_POSTFIELDS,
                                            "to=".$_SESSION['user_email']."&subject=Booking Successful&body=".$txt);

                                        // Receive server response ...
                                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                                        $server_output = curl_exec($ch);

                                        curl_close ($ch);

                                        redirect('payment_details.php?tr='.$conn->insert_id);
                                        // header("location:reply_reserve.php");
                                    } else {
                                        $_SESSION['flash'] = '<div style="background-color: #FFD1D1; border:1px dashed #6F0000; color:#6F0000; padding:10px 12px;margin: 0 30px;">Error! You need to book '.$total_rooms_required.' rooms.</div>';
                                        $_SESSION['reservation_data'] = $_REQUEST;
                                        redirect('add_reserve.php?room_id='.$room_id);
                                    }
                                } else {
                                    $conn->query("INSERT INTO `transaction`(guest_id, room_id, status, checkin, checkin_time, checkout, checkout_time, number_of_persons, number_of_rooms) VALUES ('$guest_id', '$room_id', 'Pending', '$checkin', '$checkin_time', '$checkout', '$checkout_time','$number_of_persons', '$number_of_rooms')") or die(mysqli_error($conn));

                                    $txt = "<div>Hello!</div>";
                                    $txt .= "<div>Your booking was successful, please proceed to payment.</div>";
                                    $txt .= "<div style='margin-top:12px;font-size:14px;'>YOUR BOOKING SUMMARY</div>";
                                    $txt .= '<div><strong>Name</strong> : '.$firstname.' '.$middlename.' '.$lastname.'</div>';
                                    $txt .= '<div><strong>Address</strong> : '.$address.'</div>';
                                    $txt .= '<div><strong>Contact Number</strong> : '.$contactno.'</div>';
                                    $txt .= '<div><strong>Room Type</strong> : '.$fetch_room['room_type'].'</div>';
                                    $txt .= '<div><strong>Number of Person</strong> : '.$number_of_persons.'</div>';
                                    $txt .= '<div><strong>Number of Rooms booked</strong> : '.$number_of_rooms.'</div>';

                                    $ch = curl_init();

                                    curl_setopt($ch, CURLOPT_URL,"https://www.fabroba.com/api/test-email");
                                    curl_setopt($ch, CURLOPT_POST, 1);
                                    curl_setopt($ch, CURLOPT_POSTFIELDS,
                                        "to=".$_SESSION['user_email']."&subject=Booking Successful&body=".$txt);

                                    // Receive server response ...
                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                                    $server_output = curl_exec($ch);

                                    curl_close ($ch);


                                    redirect('payment_details.php?tr='.$conn->insert_id);
                                    // header("location:reply_reserve.php");
                                }
                            }
						}else{
							echo "<script>alert('Error Javascript Exception!')</script>";
						}
				}	
			}	
	}	
?>