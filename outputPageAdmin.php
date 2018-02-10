<?php
/*Displays the advertisement that the ADMIN user clicked on in full detail referencing the id
with a GET request. The difference between this page and outputPage.php is that this one is for
admins to see the advertisments in full depth, when logged in.

This page is a heavily modified form of my guestbookadmin.php solution sent in for the
Assignment in module 4, as well as guestbook.php created by Stephen Karamatos for the submit form. 
The original creator of the complete file was Stephen Karamatos, so
credits go to him for providing the files as a resource for learning. 

The complete file provided by Stephen Karamatos without guestbookadmin.php can be found here:
http://307.myweb.cs.uwindsor.ca/apps/show-m4a
*/

//Retrieve the session data from the session variables then test user authentication
	session_start();
	
	if(!isset($_SESSION['checkAuthentication00356'])){
		$isAuthen = FALSE;
	}
	else{
		$isAuthen = TRUE;
		$userNam = $_SESSION['userNamstr6321'];

	}
	
	
	//if user account is not authenticated, then redirect user to login page
	if($isAuthen === FALSE)
	{
		header( "Location: login.php" );
	}
?>
<!DOCTYPE html>
<html>
<head>
<!-- These are the icons used for browsers, mainly for aesthetics. -->
<link rel="icon" type="image/png" href="images/logoIcon-16x16.png" sizes="16x16">
<link rel="icon" type="image/png" href="images/logoIcon-32x32.png" sizes="32x32">

<title>RoomForRent Your Source For Temporary Living</title>
<!--Implement plugins and or libraries-->
<!--The tiny MCE library is used to change the text area for the form input. The 
free version is used.
I do not claim ownership for the library or for the creation of it. 
The library falls under a Open Source (LGPL 2.1) License and can be 
found here: https://www.tinymce.com/
Link to license: https://www.tinymce.com/pricing/
Copyright (C) 2016,Ephox --> 
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>
<!-- 
Jquery Library:
I do not claim ownership for the software library or for the creation of it. 
The license falls under a MIT License and can be 
found here: https://jquery.org
Link to license: https://jquery.org/license/
Copyright (C) Copyright 2016 The jQuery Foundation
-->
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<!--Implement plugins and or libraries-->
</head>
<link rel="stylesheet" type="text/css" href="webStyle.css" />
<body style="margin: 0px; padding: 0px; font-family: 'Trebuchet MS',verdana;">

<table id="img" width="100%" style="height: 100%;" cellpadding="1" cellspacing="0" border="0">
<tr>


<!-- ============ TOP GENERAL NAVIGATION BAR ============== -->
<tr>
	<td colspan="3" valign="middle" height="30" bgcolor="#0066ff" >
	<?php
		echo "<a id='c2Admin' style='float: left;' >Welcome ".$userNam."</a>";
	?>
		<a id="c1Admin" href="logout.php" style="float: right;">Logout</a>
		<a id="c1Admin" href="account.php" style="float: right;">Account</a>

	</td>
</tr>

<!-- ============ HEADER ============== -->
	<td colspan="3" style="height: 140px;" >
		<img src="images/Logo.png" width="400" height="100">
	</td>

</tr>
</table>

<!-- ============ TOP SECOND NAVIGATION BAR ============== -->
<!--Links ACROSS THE TOP-->
<table width="100%" style="height: 100%;" cellpadding="10" cellspacing="0" border="0">
		<tr>
			<!--Navigation Bar-->
				<td id="sidePanel"><em><strong></strong></em></td>
				<td id="chButton" 
				 style="cursor: pointer;" onMouseDown="location.href='index.php'"><em><strong>Home</strong></em>
				 </td>
				 	<td id="sidePanel"><em><strong></strong></em></td>
			</tr>
</table>

<table width="100%" style="height: 100%;" cellpadding="10" cellspacing="0" border="0">
<tr>

<!-- ============ MAIN CONTENT ============== -->
	<td width="80%" valign="top" bgcolor="#d2d8c7">
		<p >Detailed info</p>
		<hr>
	
<!--Generate ad page-->
	<?php
	try {
	//Database information is retrieved
	  require_once("web_db.php");
	
	if (isset($_POST['sendMessage'])) {  
	//get the ad and posters information from the table and store it, 
	//this is mainly to extract info about the poster and ad
		$output2 = $db->query("select * from tlaadvertisement where id = '".$_GET['id']."'");
		$action2 = $output2->fetch(PDO::FETCH_ASSOC);
		
		
		 //Send an email to the ad poster using the email and ad title gathered from the ad_ID, and send an email
			 $relayStr = "Email sent from: ".$_POST['mail']."\r\n";
             $relayStr .= $_POST['details'];   	
		 
             mail(trim($action2['email']),$action2['advertisement_title'],strip_tags($relayStr));     
			 header("Location: confirmation2.php");
	}
	
		//get the information from the table and store it in the $output variable
		$output = $db->query("select * from tlaadvertisement where id = '".$_GET['id']."'");
		$action = $output->fetch(PDO::FETCH_ASSOC);
		//output image, if image is not uploaded then use standard image on server
			$imgLink = $action['img_link'];
			if($action['img_link'] == NULL){
					$imgLink = "temp.png";
			}
			echo "<h1>{$action['advertisement_title']}:</h1>
			<div class='titleprh'>Additional Information</div>
			<table border='1' style='width:100%; background-color: white;'>
			<tr>
				<td>Street</td>
				<td>{$action['Street']}</td>
			</tr>
			<tr>
				<td>Province</td>
				<td>{$action['province']}</td>
			</tr>
			<tr>
				<td>City</td>
				<td>{$action['city']}</td>
			</tr>
			<tr>
				<td>Price</td>
				<td>$ {$action['price']}</td>
			</tr>
			<tr>	
				<td>Date Posted</td>
				<td>{$action['date_Posted']}</td>
			</tr>
			</table>
			<table border='1' style='width:100%; background-color: white;'>
			<tr>	
				<td>Description</td>
				<td>Image</td>
			</tr>
			<tr>	
				<td>{$action['details']}</td>
				<td><img src='roomImage/".$imgLink."' width='300' height='300'></td>
			</tr>";
		echo "</table>";

		//This form is used to contact the ad poster, submit a message and it will be emailed to ad poster
		if($action['account_type'] === "tenant"){
			echo "<h2>Contact Tenant:</h2>";
		}
		else{
			echo "<h2>Contact Landlord:</h2>";
		}
		
}catch (Exception $e) {
	die('Database Error: '. $e->getMessage());
}

?>
<div class="titleprh">Contact Form</div>
<form id="pstA" action='' method='post' onsubmit='return datValid();' enctype='multipart/form-data'>
<br>
<div style="margin-left:30px; margin-right:30px;" >
	<label id="sa">Name:</label>
	<input class='settr' type='text' name='advertisement_title' placeholder="Full Name" />
</div>
<br>
 <div style="margin-left:30px; margin-right:30px;">
	<label id="sa">Email:</label>
	<input class='settr' type='text' name='mail' placeholder="Your Email" />
</div>
<br>

<div style="margin-left:30px; margin-right:30px;">
	<label id="sa">Message:</label>
	<textarea style="width: 300px; height: 150px; " rows='20' id='details' name='details' placeholder="Message"></textarea>
</div>
<br>
<div>
	<input style="margin-left:30px; background-color: #72A4D2; width: 200px; height: 50px; cursor: pointer;" 
	type='submit' name='sendMessage' value='Send Message'  /></div>
	<br>
</div>
<input type='hidden' name='userID' value="<?php echo htmlspecialchars($userID); ?>"  />
</form>


<!--Filler space-->
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	
		<hr>
	</td>
</tr>
<!-- ============ FOOTER ============== -->
<tr><td colspan="3" align="center" height="20" bgcolor="#0066ff" style="color:black;">RoomForRent</td></tr>
</table>
</body>

<html>


