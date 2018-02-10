<?php
/*Just a regular confirmation page that appears after a user posts an ad. Used as feedback
for users posting ads. */
?>
<!DOCTYPE html>
<html>
<head>
<!-- These are the icons used for browsers, mainly for aesthetics. -->
<link rel="icon" type="image/png" href="images/logoIcon-16x16.png" sizes="16x16">
<link rel="icon" type="image/png" href="images/logoIcon-32x32.png" sizes="32x32">

<title>RoomForRent Your Source For Temporary Living</title>

</head>
<link rel="stylesheet" type="text/css" href="webStyle.css" />
<body style="margin: 0px; padding: 0px; font-family: 'Trebuchet MS',verdana;">

<table id="img" width="100%" style="height: 100%;" cellpadding="1" cellspacing="0" border="0">
<tr>


<!-- ============ TOP GENERAL NAVIGATION BAR ============== -->
<tr>
	<td colspan="3" valign="middle" height="30" bgcolor="black">
		<a id="c2" href="#" style="float: left;" >Welcome</a>
		<a id="c1" href="tenantHome.php" style="float: left;">Find Tenants</a>
		<a id="c1" href="landlordHome.php" style="float: left;">Find Landlord</a>
		
		<a id="c1" href="logout.php" style="float: right;">Logout</a>
		<a id="c1" href="account.php" style="float: right;">Account</a>

	</td>
</tr>

<!-- ============ HEADER ============== -->
	<td colspan="3" style="height: 140px;" >
		<img src="images/Logo.png" width="400" height="100">
	</td>

</tr>
</table>

<!-- ============ TOP BAR ============== -->
<table width="100%" style="height: 100%;" cellpadding="10" cellspacing="0" border="0">
		<tr>
			<!--Navigation User Bar-->
				<td id="sidePanel"><em><strong></strong></em></td>
				<td id="chButton" 
				 style="cursor: pointer;" onMouseDown="location.href='index.php'"><em><strong>Home</strong></em></td>
				<td id="chButton"
				  style="cursor: pointer;" onMouseDown="location.href='userAds.php'"><em><strong>My Ads</strong></em></td>
			  <td id="chButton"
				  style="cursor: pointer;" onMouseDown="location.href='submitAd.php'"><em><strong>Post Ad</strong></em></td>	
				<td id="chButton" 
				  style="cursor: pointer;" onMouseDown="location.href='contact.php'"><em><strong>Contact</strong></em></td>
				<td id="chButton"
				 style="cursor: pointer;" onMouseDown="location.href='about.php'"><em><strong>About</strong></em></td>
				 	<td id="sidePanel"><em><strong></strong></em></td>
			</tr>

<tr>
</table>

<table width="100%" style="height: 100%;" cellpadding="10" cellspacing="0" border="0">

<!-- ============ MAIN CONTENT ============== -->
<div id="body">
	<td width="80%" valign="top" bgcolor="#d2d8c7">
	
	<!-- Confirmation Message -->
	<p>Confirmation</p>
	<hr>
	<p> 
	Your email has been successfully sent.
	You can click <a href="index.php">here to check out more advertisements.</a>
	</p>
	<p>&nbsp;</p>
	<p><img src="images/thumbsup.png" width="354" height="316"></p>
	
<!-- Filler space to spread out web page-->
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<hr>
	</td>
	
	</tr>

</div>

<!-- ============ FOOTER ============== -->
<tr><td colspan="3" align="center" height="20" bgcolor="black" style="color:#777;">RoomForRent</td></tr>
</table>
</body>

<html>


