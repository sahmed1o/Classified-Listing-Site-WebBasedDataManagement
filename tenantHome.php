<?php
/*This is the home page for the users with an authenticated tenant account.
Users can navigate using the menus at the top, as well as post ads.

This page is a heavily modified form of my guestbookadmin.php solution sent in for the
Assignment in module 4. But the original creator of the complete file was Stephen Karamatos, so
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
<link rel="icon" type="image/png" href="images/logoIcon-16x16.png" sizes="16x16">
<link rel="icon" type="image/png" href="images/logoIcon-32x32.png" sizes="32x32">

<title>RoomForRent Your Source For Temporary Living</title>
<!--Implement plugins-->
<!-- 
Jquery Library:
I do not claim ownership for the software library or for the creation of it. 
The license falls under a MIT License and can be 
found here: https://jquery.org
Link to license: https://jquery.org/license/
Copyright (C) Copyright 2016 The jQuery Foundation
-->
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<link type="text/css" rel="stylesheet" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css"></link>
<script type="text/javascript" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
<!--Implement plugins-->
<script  type="text/javascript">
//Data tables library is used to change tables generated below
/*I do not claim ownership for the library or for the creation of it.
The library falls under a MIT License and can be 
found here: https://datatables.net/
Link to license: https://datatables.net/license/mit
Copyright (C) 2008-2016, SpryMedia Ltd.*/ 
$(document).ready(function(){
	$('#apartm').DataTable({
		"pagingType": "full_numbers",
		"pageLength": 5,
		"order": [[2,'asc'],[3,'desc']]
	});
});

//A search bar using ajax that uses a get request to search for an ad in the database
$(document).ready(function(){
    $("#searchbutton").click(function(){
		var gks = $("#gks").val();
		var street = $("#street").val();
		var provi = $("#provi").val();
		var city = $("#city").val();
		var acctyp = $("#acctyp").val();
		var datert = $("#datert").val();
		var eprice = $("#eprice").val();
		var pricer = $("#pricer").val();
        $.ajax({
			type: 'GET',
			success: function()
			{
				 window.location.href =  "search.php?gks="+gks+"&street="+street+"&provi="+provi
				 +"&city="+city+"&acctyp="+acctyp+"&datert="+datert+"&eprice="+eprice+"&pricer="+pricer;
			}
		});
    });
});
</script>

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
<!--Links ACROSS THE TOP-->
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
<!-- ============ SEARCH BAR ============== -->
<td width="20%" valign="top" bgcolor="#d2d8c7">
<form id="frm" action=".">
			<div class="titleSearch">
				<label style="color:black;">Search</label>
			</div>
			<div class="">
				<label id="" for="type-text">General Keywords</label>
				<input type="text" name="gks" id="gks">
				
			</div>
			<div class="">
				<label id="" for="type-search">Street</label>
				<input type="search" name="street" id="street">
				
			</div>
			<div class="">
				<label id="" for="type-tel">Province</label>
				<input type="tel" name="provi" id="provi">

			</div>
			<div class="">
				<label id="" for="type-url">City</label>
				<input type="url" name="city" id="city">
				
			</div>
			<div class="">
				<label id="" for="type-email">What User? (tenant or landlord)</label>
				<input type="email" name="acctyp" id="acctyp">
				
			</div>

			<div class="">
				<label id="" for="type-date">Date (date)</label>
				<input type="date" name="datert" id="datert">
				
			</div>

			<div class="">
				<label id="" for="type-number">Exact Price</label>
				<input type="number" name="eprice" id="eprice" min="0" max="1000000">
					
			</div>
			<div class="">
				<label id="" for="type-range">Price Range</label>
				<input type="range" name="pricer" id="pricer" min="0" max="10000">
				<hr/>
			</div>
			<div class="submitSearch">
				<label > </label>
				<input class="searchbuttonn" id="searchbutton" type="button" value="Submit" name="search" style="cursor: pointer;">
				<label > </label>
			</div>
		</form>
</td>
<!-- ============ MAIN CONTENT ============== -->
	<td width="80%" valign="top" bgcolor="#d2d8c7">
		<p >Ad Postings from Tenants</p>
		<hr>
		<div class="titleprh">Showing 1 - 5 out of 
		<?php
			/*Used to output total ads posted by tenants that are approved.*/
			//Database information is retrieved
			require_once("web_db.php"); 
			//information is recieved from the database and stored in the $output2 variable
			$output2 = $db->query("select COUNT(*) from `tlaadvertisement` where status = 'Approved' and account_type = 'tenant'");
			$action2 = $output2->fetch(PDO::FETCH_ASSOC);
			//do a check to determine if their is any output from the query
			$checkDat2 = $output2->rowCount();
			if($checkDat2 != 0){
				echo "{$action2['COUNT(*)']}";
			}
			else{
				echo "0";
			}
		?>
		ads that are posted</div>
	<!-- Generate advertisment listing of ads posted by Tenants -->
	<table id="apartm" class="display" style="border: 1px solid black;" >
	<thead>
	<tr style="background-color: white;">
		<th>ID</th>
		<th>Ad Title</th>
		<th>Date Posted</th>
		<th>Preview</th>
	</tr>
	</thead>
	<tbody>
<?php  
try {
	//Database information is retrieved
	  require_once("web_db.php");
	  
	//Temporarily holds a string, used to hold description of the advertisment for tenants
	$tempStoreInfo = "";
	//information is recieved from the database and stored in the $output variable
	$output = $db->query("SELECT * from tlaadvertisement where account_type = 'tenant' ORDER BY date_Posted DESC");
	$checkDat = $output->rowCount();
	//do a check to determine if their is any output from the query
	if($checkDat != 0){
			//show ads that have been approved by the admin
			$count = 0;
			//generate table
			while($action = $output->fetch(PDO::FETCH_ASSOC)) {
			if($action['status'] === "Approved"){
				$imgLink = $action['img_link'];
				if($action['img_link'] == NULL){
					$imgLink = "temp.png";
				}
				$tempStoreInfo = implode(' ', array_slice(explode(' ', $action['details']), 0, 50));
				echo "<tr><td>{$count}</td>
				<td>
					<a href='outputPage.php?id=".$action['id']."'>{$action['advertisement_title']}<a>
					<p>Description: </p>
					<p>{$tempStoreInfo}...</p>
				</td>
				<td>{$action['date_Posted']}</td>
				<td>
					<img src='roomImage/".$imgLink."' width='100' height='100'>
					$ {$action['price']}
				</td>
				<form method='post'>
				<input type='hidden' name='adID' value=".htmlspecialchars($action['id']).">			
				</form>
				</tr>";
				$count++;
			}
		}
	} 
	else {
		echo '<p>No Advertisements have been posted.</p>';		
	}
		echo "</tbody>";
		echo "</table>";
}catch (Exception $errC) {
	die('Error: '. $errC->getMessage());
}
?>
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
<!-- ============ FOOTER ============== -->
<tr><td colspan="3" align="center" height="20" bgcolor="black" style="color:#777;">RoomForRent</td></tr>
</table>
</body>

<html>


