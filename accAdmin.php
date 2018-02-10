<?php
/*This is the admin account page where admins make decisions on whether accounts
are removed, or approved, or whether to approve or remove advertisements posted by tenants
or landlords. 

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
<!--Implement plugins and or libraries-->
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
<!--Implement plugins and or libraries-->
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
				 style="cursor: pointer;" onMouseDown="location.href='index.php'"><em><strong>Home</strong></em></td>
				 <td id="sidePanel"><em><strong></strong></em></td>
			</tr>
</table>

<table width="100%" style="height: 100%;" cellpadding="10" cellspacing="0" border="0">
<tr>
<!-- ============ USED TO CHANGE STATE OF WHAT ADS TO DISPLAY VIA A POST REQUEST ============== -->
	<td width="80%" valign="top" bgcolor="#d2d8c7">
					<form method='post'>
						<input type='hidden' name='adID' value=".htmlspecialchars($action['id']).">	 	
						<input type='submit' name='tenad' value='Tenant Ads' style='background-color: green; width: 10em;  height: 2em;' >
						<input type='submit' name='lanad' value='Landlord Ads' style='background-color: orange; width: 10em;  height: 2em;' >
						<input type='submit' name='tenacc' value='Tenant Account' style='background-color: green; width: 10em;  height: 2em;'>
						<input type='submit' name='lanacc' value='Landlord Account' style='background-color: orange; width: 10em;  height: 2em;'>
					</form>
<?php  
try {
	//Database information is retrieved
	  require_once("web_db.php");
	  
	  
	  //this determines what to show on the admin page based on the button pressed
		$state = NULL; 
		
			//show tenant ads
			if(isset($_POST['tenad'])){
				//output table headers for tenant ads
				 $state = 1;
				 echo" <p >Ad Postings from Tenants</p>
		<hr>
		<div class='titleprh'>Control Panel</div>
			<table id='apartm' class='display' style='border: 1px solid black;' >
			<thead>
			<tr style='background-color: white;'>
				<th>ID</th>
				<th>Ad Title</th>
				<th>Date Posted</th>
				<th>Preview</th>
				<th>Status</th>
				<th>Options</th>
			</tr>
			</thead>
			<tbody>";
			}
			
			//show landlord ads
			else if(isset($_POST['lanad'])){
				//output table headers for landlord ads
				 $state = 2;
				 echo" <p >Ad Postings from Landlords</p>
		<hr>
		<div class='titleprh'>Control Panel</div>
			<table id='apartm' class='display' style='border: 1px solid black;' >
			<thead>
			<tr style='background-color: white;'>
				<th>ID</th>
				<th>Ad Title</th>
				<th>Date Posted</th>
				<th>Preview</th>
				<th>Status</th>
				<th>Options</th>
			</tr>
			</thead>
			<tbody>";
			}
			
			//show tenant accounts
			else if(isset($_POST['tenacc'])){
				//output table headers for tenant accounts
				 $state = 3;
				 echo" <p >Tenant Accounts Registered</p>
		<hr>
		<div class='titleprh'>Control Panel</div>
			<table id='apartm' class='display' style='border: 1px solid black;' >
			<thead>
			<tr style='background-color: white;'>
				<th>ID</th>
				<th>UserName</th>
				<th>Date Created</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>City</th>
				<th>Province</th>
				<th>Email</th>
				<th>Account Type</th>
				<th>Status</th>
				<th>Options</th>
			</tr>
			</thead>
			<tbody>";
			}
			
			//show landlord account
			else if(isset($_POST['lanacc'])){
				//output table headers for landlord accounts
				 $state = 4;
					 echo" <p >Landlord Accounts Registered</p>
		<hr>
		<div class='titleprh'>Control Panel</div>
			<table id='apartm' class='display' style='border: 1px solid black;' >
			<thead>
			<tr style='background-color: white;'>
				<th>ID</th>
				<th>UserName</th>
				<th>Date Created</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>City</th>
				<th>Province</th>
				<th>Email</th>
				<th>Account Type</th>
				<th>Status</th>
				<th>Options</th>
			</tr>
			</thead>
			<tbody>";
			}
			else{
				//If a post request is not made then show a general table header
				 echo" <p >Ad Postings from Tenants</p>
		<hr>
		<div class='titleprh'>Control Panel</div>
			<table id='apartm' class='display' style='border: 1px solid black;' >
			<thead>
			<tr style='background-color: white;'>
				<th>ID</th>
				<th>Ad Title</th>
				<th>Date Posted</th>
				<th>Preview</th>
				<th>Status</th>
				<th>Options</th>
			</tr>
			</thead>
			<tbody>";
			$state = 1;
			}
		
			
			
		/*Post request for ADVERTISEMENT*/
		//Approve ad
		if(isset($_POST['Approve'])){
		//set status of advertisement to 'Approve', then alert a message using javascript
		$db->query("update tlaadvertisement set status = 'Approved' where id = '" .$_POST['adID']. "'");
		echo "<script type='text/javascript'>"; 
		echo "alert('The Ad titled ".$_POST['adTitle']." has been approved')"; 
		echo "</script>";
		}
		
		//Reject ad but don't delete it
		if(isset($_POST['Reject'])){
		//set status of advertisement to 'reject', then alert a message using javascript
		$db->query("update tlaadvertisement set status = 'Reject' where id = '" .$_POST['adID']. "'");
		echo "<script type='text/javascript'>"; 
		echo "alert('The Ad titled ".$_POST['adTitle']." has been rejected')"; 
		echo "</script>";
		}
		
		//Delete ad
		if(isset($_POST['Delete'])){
		//Query a deletion of the ad using its id, then alert a message using javascript
		$db->query("delete from tlaadvertisement where id = '" .$_POST['adID']. "'");
		echo "<script type='text/javascript'>"; 
		echo "alert('The Ad titled ".$_POST['adTitle']." has been deleted')"; 
		echo "</script>";
		}
		/* *********************************************************** */
		
		
		/*Post request for ACCOUNTS*/
		//Approve ad
		if(isset($_POST['ApproveAcc'])){
		//Verify user accounts, then alert a message using javascript
		$db->query("update tlauseraccount set isValid = 'verified' where user_name = '" .$_POST['userNam']. "'");
		echo "<script type='text/javascript'>"; 
		echo "alert('The User ".$_POST['userNam']." has been approved')"; 
		echo "</script>";
		}
		
		//Reject ad but don't delete it
		if(isset($_POST['RejectAcc'])){
		//Reject user accounts, then alert a message using javascript
		$db->query("update tlauseraccount set isValid = 'Rejected' where user_name = '" .$_POST['userNam']. "'");
		echo "<script type='text/javascript'>"; 
		echo "alert('The User ".$_POST['userNam']." has been rejected')"; 
		echo "</script>";
		}
		
		//Delete ad
		if(isset($_POST['DeleteAcc'])){
		//Query a deletion of the user account using its id, then alert a message using javascript
		$db->query("delete from tlauseraccount where user_name = '" .$_POST['userNam']. "'");
		echo "<script type='text/javascript'>"; 
		echo "alert('The User ".$_POST['userNam']." has been deleted')"; 
		echo "</script>";
		}
		/* *********************************************************** */
		
		/* ================ output tenant ads ======================= */
		if($state == 1){
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
						$imgLink = $action['img_link'];
						if($action['img_link'] == NULL){
							$imgLink = "temp.png";
						}
						$tempStoreInfo = implode(' ', array_slice(explode(' ', $action['details']), 0, 50));
						echo "<tr><td>{$count}</td>
						<td>
							<a href='outputPageAdmin.php?id=".$action['id']."'>{$action['advertisement_title']}<a>
							<p>Description: </p>
							<p>{$tempStoreInfo}...</p>
						</td>
						<td>{$action['date_Posted']}</td>
						<td>
							<img src='roomImage/".$imgLink."' width='100' height='100'>
							$ {$action['price']}
						</td>
						<td>{$action['status']}</td>
						<td>
							<form method='post'>
								<input type='hidden' name='adID' value=".htmlspecialchars($action['id']).">	
								<input type='hidden' name='adTitle' value='{$action['advertisement_title']}'>	 								
								<input type='submit' name='Approve' value='Approve' style='background-color: green; width: 10em;  height: 2em;' >
								<input type='submit' name='Reject' value='Reject' style='background-color: orange; width: 10em;  height: 2em;' >
								<input type='submit' name='Delete' value='Delete' style='background-color: red; width: 10em;  height: 2em;'>
							</form>
							<form method='post' action='mailto:".$action['email']."' >
									<input type='submit' value='Email User' style='background-color: purple; width: 10em;  height: 2em;'>
							</form>
						</td>
						</tr>";
						$count++;
					}
				}				
			else {
				echo '<p>No Advertisements have been posted.</p>';		
			}
			echo "</tbody>";
			echo "</table>";
		}
		
		/* ================ output landlord ads ======================= */
		if($state == 2){
			//Temporarily holds a string, used to hold description of the advertisment for landlords
			$tempStoreInfo = "";
			//information is recieved from the database and stored in the $output variable
			$output = $db->query("SELECT * from tlaadvertisement where account_type = 'landlord' ORDER BY date_Posted DESC");
			$checkDat = $output->rowCount();
			//do a check to determine if their is any output from the query
			if($checkDat != 0){
					//show ads that have been approved by the admin
					$count = 0;
					//generate table
					while($action = $output->fetch(PDO::FETCH_ASSOC)) {
						$imgLink = $action['img_link'];
						if($action['img_link'] == NULL){
							$imgLink = "temp.png";
						}
						$tempStoreInfo = implode(' ', array_slice(explode(' ', $action['details']), 0, 50));
						echo "<tr><td>{$count}</td>
						<td>
							<a href='outputPageAdmin.php?id=".$action['id']."'>{$action['advertisement_title']}<a>
							<p>Description: </p>
							<p>{$tempStoreInfo}...</p>
						</td>
						<td>{$action['date_Posted']}</td>
						<td>
							<img src='roomImage/".$imgLink."' width='100' height='100'>
							$ {$action['price']}
						</td>
						<td>{$action['status']}</td>
						<td>
							<form method='post'>
								<input type='hidden' name='adID' value=".htmlspecialchars($action['id']).">
								<input type='hidden' name='adTitle' value='{$action['advertisement_title']}'>	
								<input type='submit' name='Approve' value='Approve' style='background-color: green; width: 10em;  height: 2em;' >
								<input type='submit' name='Reject' value='Reject' style='background-color: orange; width: 10em;  height: 2em;' >
								<input type='submit' name='Delete' value='Delete' style='background-color: red; width: 10em;  height: 2em;'>
							</form>
							<form method='post' action='mailto:".$action['email']."' >
									<input type='submit' value='Email User' style='background-color: purple; width: 10em;  height: 2em;'>
							</form>
						</td>
						</tr>";
						$count++;
					}
				}				
			else {
				echo '<p>No Advertisements have been posted.</p>';		
			}
			echo "</tbody>";
			echo "</table>";
		}
		
		/* ================ output tenant account ======================= */
		if($state == 3){
			//Temporarily holds a string, used to hold data for user accounts related to the tenant
			$tempStoreInfo = "";
			//information is recieved from the database and stored in the $output variable
			$output = $db->query("SELECT * from tlauseraccount where accounType = 'tenant' ORDER BY create_date DESC");
			$checkDat = $output->rowCount();
			//do a check to determine if their is any output from the query
			if($checkDat != 0){
					//show ads that have been approved by the admin
					$count = 0;
					//generate table
					while($action = $output->fetch(PDO::FETCH_ASSOC)) {
						echo "<tr><td>{$count}</td>
						<td>
							{$action['user_name']}
						</td>
						<td>{$action['create_date']}</td>
						<td>{$action['first_name']}</td>
						<td>{$action['last_name']}</td>
						<td>{$action['city']}</td>
						<td>{$action['prov']}</td>
						<td>{$action['email']}</td>
						<td>{$action['accounType']}</td>
						<td>{$action['isValid']}</td>
						<td>
							<form method='post'> 	
							<input type='hidden' name='userNam' value=".htmlspecialchars($action['user_name']).">	 
								<input type='submit' name='ApproveAcc' value='Approve Account' style='background-color: green; width: 10em;  height: 2em;' >
								<input type='submit' name='RejectAcc' value='Reject Account' style='background-color: orange; width: 10em;  height: 2em;' >
								<input type='submit' name='DeleteAcc' value='Delete Account' style='background-color: red; width: 10em;  height: 2em;'>
							</form>
							<form method='post' action='mailto:".$action['email']."' >
									<input type='submit' value='Email User' style='background-color: purple; width: 10em;  height: 2em;'>
							</form>
						</td>
						</tr>";
						$count++;
					}
				}				
			else {
				echo '<p>No Advertisements have been posted.</p>';		
			}
			echo "</tbody>";
			echo "</table>";
		}
		
		/* ================ output landlord account ======================= */
		if($state == 4){
			//Temporarily holds a string, used to hold data for user accounts related to the tenant
			$tempStoreInfo = "";
			//information is recieved from the database and stored in the $output variable
			$output = $db->query("SELECT * from tlauseraccount where accounType = 'landlord' ORDER BY create_date DESC");
			$checkDat = $output->rowCount();
			//do a check to determine if their is any output from the query
			if($checkDat != 0){
					//show ads that have been approved by the admin
					$count = 0;
					//generate table
					while($action = $output->fetch(PDO::FETCH_ASSOC)) {
						echo "<tr><td>{$count}</td>
						<td>
							{$action['user_name']}
						</td>
						<td>{$action['create_date']}</td>
						<td>{$action['first_name']}</td>
						<td>{$action['last_name']}</td>
						<td>{$action['city']}</td>
						<td>{$action['prov']}</td>
						<td>{$action['email']}</td>
						<td>{$action['accounType']}</td>
						<td>{$action['isValid']}</td>
						<td>
							<form method='post'> 	
									<input type='hidden' name='userNam' value=".htmlspecialchars($action['user_name']).">	
								<input type='submit' name='ApproveAcc' value='Approve Account' style='background-color: green; width: 10em;  height: 2em;' >
								<input type='submit' name='RejectAcc' value='Reject Account' style='background-color: orange; width: 10em;  height: 2em;' >
								<input type='submit' name='DeleteAcc' value='Delete Account' style='background-color: red; width: 10em;  height: 2em;'>
							</form>
							<form method='post' action='mailto:".$action['email']."' >
									<input type='submit' value='Email User' style='background-color: purple; width: 10em;  height: 2em;'>
							</form>
						</td>
						</tr>";
						$count++;
					}
				}				
			else {
				echo '<p>No Advertisements have been posted.</p>';		
			}
			echo "</tbody>";
			echo "</table>";
		}
		
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
<tr><td colspan="3" align="center" height="20" bgcolor="#0066ff" style="color:black;">RoomForRent</td></tr>
</table>
</body>

<html>


