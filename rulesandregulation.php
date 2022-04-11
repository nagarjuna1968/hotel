<!DOCTYPE html>
<html lang = "en">
	<head>
		<title>Hotel Online Reservation</title>
		<link rel = "icon" href = "images/logo.jpg" 
        type = "image/x-icon">
		<meta charset = "utf-8" />
		<meta name = "viewport" content = "width=device-width, initial-scale=1.0" />
		<link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css " />
		<link rel = "stylesheet" type = "text/css" href = "css/style.css" />
	</head>
<body>
	<?php
		$redirectBackHereAfterLogin = false;
		$showThisPageOnlyToLoggedInUser = false;
		$showThisPageOnlyToGuestUser = false;
		include "./common/header.php"
	?>
	<div style = "margin-left:0;" class = "container">
		<div class = "panel panel-default">
			<div class = "panel-body">
				<strong><h4><b>RULES AND REGULATION</b></h4></strong>
				<br />
				<strong><h4 style = "color:#ff0000;"><b>1. Tariff</b></h4></strong>
				<p>The tariff is for the room only and is exclusive of any government taxes applicable Meals and other services are available at extra cost . To know your room tariff, please contact the Duty Manager, <b style = "color:#ff0000;">guest registration forms must be signed on arrivals.</b> </p>
				<br />
				<strong><h4 style = "color:#ff0000;"><b>2. Settlement of Bills</b></h4></strong>
				<p>Bills must be settled on presentation, <b style = "color:#ff0000;">personal cheques are not accepted.</b></p>
				<br />
				<strong><h4 style = "color:#ff0000;"><b>3. Company's Lien on Guest's Luggage and Belongings</b></h4></strong>
				<p>In the case of default in payment of dues by a guest, the management shall have the linen on their luggage and belongings, and be entitled to detain the same and to sell or auction such property at any time without reference to the guest. The net sale proceeds will be appropriate towards the amount due by the guest without prejudice to the management's rights to adopt such further recovery proceedings as my be required.</p>
				<br />
				<strong><h4 style = "color:#ff0000;"><b>4. Check-in<b></h4></strong>
				<p><b style = "color:#ff0000;">Please present your ID card, Passport or Temporary Residence Card upon Check-in.</b> By Law visitors must present personal documents for hotel records. These documents will be returned upon departure.</p>
				<br />
				<strong><h4 style = "color:#ff0000;"><b>5. Departure</b></h4></strong>
				<p>Check out time is ( mention your checkout time here ) please inform the reception if you wish to retain your room beyond this time. <b style = "color:#ff0000;">Extension will be given depending on the availability</b> . If the room is available, normal tariff will be charged. On failure of the guest to vacate the room on expiry or period the management shall have the right to remove the guest and his/her belongings from the room occupied by the Guest.</p>
				<br />
				<strong><h4 style = "color:#ff0000;"><b>6. Luggage Storage</b></h4></strong>
				<p>Subject to availability of the storage space, the guest can store luggage in the luggage room, <b style = "color:#ff0000;">at the guest's sole risk as to loss or damage from any cause</b>, Luggage may not be stored for period of over 30 days.</p>
				<br />
				<strong><h4 style = "color:#ff0000;"><b>7. Pets</b></h4></strong>
				<p>Mention your policy for Pets ( allowed or not- allowed ) (Allow us to make separate arrangements. )</p>
				<br />
				<strong><h4 style = "color:#ff0000;"><b>8. Hazardous Goods</b></h4></strong>
				<p>Bringing goods and / or storing of raw or exposed cinema films, or any other article of a combustible or hazardous nature and / or prohibited goods and / or goods of objectionable nature is prohibited.</p>
				<br />
				<strong><h4 style = "color:#ff0000;"><b>9. Damage to Property<b></h4></strong>
				<p><b style = "color:#ff0000;">The guest will be held responsible for any loss or damage to the hotel property caused by themselves</b>, their guests or any person for whom they are responsible.</p>
				<br />
				<strong><h4 style = "color:#ff0000;"><b>10. Management's Rights</b></h4></strong>
				<p>It is agreed that the guest will conduct him/ herself in a respectable manner and will not cause any nuisance or annoyance within the hotel premise.</p>
				<br />
				
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
</html>