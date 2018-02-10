<?php
/*This is the a general information page that is used to give a brief description 
of what the website is about.*/

//Retrieve session data then test user authentication
	session_start();
	
	if(!isset($_SESSION['checkAuthentication00356'])){
		$isAuthen = FALSE;
	}
	else{
		$isAuthen = TRUE;
		$userNam = $_SESSION['userNamstr6321'];
		//check what type of account the signed in user is using session variables
		if(isset($_SESSION["accounType6334"]))
		{
			if($_SESSION["accounType6334"] === "tenant"){
				$accountType = "tenant";		
			}
			else if($_SESSION["accounType6334"] === "landlord"){
				$accountType = "landlord";
			}
			else if ($_SESSION["accounType6334"] === "admin"){
				$accountType = "admin";
				header( "Location: accAdmin.php" );
			}
		}

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
<link rel="icon" type="image/png" href="images/logoIcon-16x16.png" sizes="16x16"/>
<link rel="icon" type="image/png" href="images/logoIcon-32x32.png" sizes="32x32"/>
<style type="text/css">
<!--remove blank space padding on the top of page layout-->
html, body {
    margin: 0;
    padding: 0;
}
 
</style>

<title>RoomForRent Your Source For Temporary Living</title>

</head>
<link rel="stylesheet" type="text/css" href="webStyle.css" />
<body style="margin: 0px; padding: 0px; font-family: 'Trebuchet MS',verdana;">

<table id="img" width="100%" style="height: 100%;" cellpadding="1" cellspacing="0" border="0">
<tr>


<!-- ============ TOP GENERAL NAVIGATION BAR ============== -->
<tr>
	<td colspan="3" valign="middle" height="30" bgcolor="black">
	<?php
		echo "<a id='c2' style='float: left;' >Welcome ".$userNam."</a>";
	?>
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

<!-- ============ TOP SECOND NAVIGATION BAR ============== -->
<!--Links to each page is placed here.-->
<table width="100%" style="height: 100%;" cellpadding="10" cellspacing="0" border="0">
		<tr>
			<!--Navigation Bar-->
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
</table>

<table width="100%" style="height: 100%;" cellpadding="10" cellspacing="0" border="0">
<tr>
<!-- ============ MAIN CONTENT ============== -->
	<td width="80%" valign="top" bgcolor="#d2d8c7">
		<h2 class="mailc2">About</h2>
		<hr>
<!--General Description-->
	<p> 
	A website created for 60-307 Web-Based Data Management:
	</p>
	<p>
	A work-flow based application used to rent out rooms via advertisements 
	placed on the website to tenants, from landlords with a valid rental 
	license for apartments, or houses in Canada. Landlords can provide a 
	listing on rooms for users to view. A tenant user browses the website 
	containing advertisement on rooms for rent, and can contact the landlord,
	and send an application for the room. Tenants can also create a listing
	on the website to search for a room mate. Tenants and landlords have to 
	register on the website by inputting data, in which the super-user (administrator)
	will verify the information and approve, or disapprove of the account
	for the landlords account. The super-user (administrator) also decides 
	whether to approve or disapprove the listing by the landlord or tenant.
	<p>
	
	<!--Filler Space-->
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
<!-- ============ WEBSITE FOOTER ============== -->
<tr><td colspan="3" align="center" height="20" bgcolor="black" style="color:#777;">RoomForRent</td></tr>
</table>
</body>

<html>


