<?php
/* 
This page is used to submit advertisements using user input.

This page is a heavily modified form of my guestbookadmin.php solution sent in for the
Assignment in module 4, guestbook.php created by Stephen Karamatos for the submit form, and
task5_upload.php for the image upload portion of the form. 
The original creator of the complete file was Stephen Karamatos, so
credits go to him for providing the files as a resource for learning. 

The complete file provided by Stephen Karamatos without guestbookadmin.php can be found here:
http://307.myweb.cs.uwindsor.ca/apps/show-m4a

The image upload file created by Stephen Karamatos can be found here:
http://307.myweb.cs.uwindsor.ca/apps/show-t5a

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
<!--Implement plugins and or libraries-->
</head>
<!-- 
Jquery Library:
I do not claim ownership for the software library or for the creation of it. 
The license falls under a MIT License and can be 
found here: https://jquery.org
Link to license: https://jquery.org/license/
Copyright (C) Copyright 2016 The jQuery Foundation
-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script>
function datValid() {
  // Inputted data by the is checked when form is submitted
  // If data fulfills conditions below, then set error flag false and show no errors.
  var errors = true;

  //Check if user data inputted is valid
  if (document.forms[0].elements['details'].value.length < 10
  || document.forms[0].elements['street'].value.length < 5
  || document.forms[0].elements['advertisement_title'].value.length < 3
  || document.forms[0].elements['province'].value.length < 5
  || document.forms[0].elements['city'].value.length < 5) {
	errors = false;
  }  
  return(errors);
}

//Search bar using ajax
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
		<p >Ad Posting</p>
		<hr>
		
<?php
/*Data submitted from the form as a POST request is used to post an advertisement on 
the website depending on the account type of the user. */

$advertisement_title = NULL; 
$streetr = NULL; 
$province = NULL; 
$city = NULL; 
$details = NULL; 
$email = NULL; 
$imgLink = NULL;
$validE = NULL;
$promptERR = NULL;
$price = 0;

try {
//Database information is retrieved
 require_once ("web_db.php"); 
 //A flag used to determine if the form is hidden or not when outputting a message on the screen
  $notHidden = TRUE;  

	//Access first database of user and get the email of logged in user, then submit email of user 
	$sql = "select email from tlauseraccount where user_name = '".$userNam."' limit 1";
	$output = $db->query($sql); 
	$email = $db->query($sql)->fetchColumn();
	
  if (isset($_POST['getInfo'])) {  
   //remove any spaces or html tags
   $advertisement_title = strip_tags(trim($_POST['advertisement_title']));
   $streetr = strip_tags(trim($_POST['street']));
   $province = strip_tags(trim($_POST['province']));
   $city = strip_tags(trim($_POST['city']));
   $details = strip_tags(trim($_POST['details']));
   $userID = strip_tags(trim($_POST['userID']));
   $imgLink = preg_replace("/[^a-z0-9-.]/", "_", strtolower(basename($_FILES["imgLink"]["name"]))); 
   $acctype = trim($_SESSION['accounType6334']);
   $price = $_POST['price'];
   
   
    //Image validation is done here
	//Check file size of image and ensure it doesn't go over a certain size
	if ($_FILES["imgLink"]["size"] > 700000) {
		$validE = true;
		$promptERR .= "The file is to large. ";
	} 
	//image file check is completed here

   //Data validation to check if the size of inputted data fit conditions below
   if (strlen($advertisement_title) < 3){
	   $validE = true;
	   $promptERR .= "Provide a Advertisement title that is larger then 3 characters. ";
   } 
   if (strlen($streetr) < 2) {
	$validE = true;
	$promptERR .= "Street address is to short, provide a valid street address. ";
   }
   if (strlen($province) < 3){
	 $validE = true;
	 $promptERR .= "Enter the full name of province (3 characters or more). ";
   }
   if (strlen($city) < 3){
	   $validE = true;
	   $promptERR .= "Provide a city.";
   }
   if (strlen($details) < 5){
	   $validE = true;
	   $promptERR .= "Please provide more information. ";
   } 
   if (strlen($userID) <> 23){
	   $validE = true;
	   $promptERR .= "Unmatched UserID.";
   }
   if(!is_numeric($price)){
	   $validE = true;
	   $promptERR .= "Price is not a valid number";
   }

   //If user inputted data is formatted, data is saved to database using a query
   if (!$validE) {
       $statement = $db->prepare("REPLACE INTO `tlaadvertisement` SET ".
        "advertisement_title = :adTitle, ".
        "Street = :street, ".
		"province = :prov, ".
		"city = :cit, ".
		"email = :emal, ".
        "details = :deta, ".
        "date_Posted = '".date("Y-m-d H:i:s")."', ".
        "status = :status, ".
		"img_link = :imgLink, ".
        "id = :userd, ".
		"user_name = :userna, ".
		"price = :pricety, ".
		"account_type = :typeacc");
		
		$chechApprov = "pending approval";
       $statement->bindParam(":adTitle",$advertisement_title);
       $statement->bindParam(":street",$streetr);
	   $statement->bindParam(":prov",$province);
	   $statement->bindParam(":cit",$city);
	   $statement->bindParam(":emal",$email);
       $statement->bindParam(":deta",$details);
       $statement->bindParam(":userd",$userID);
       $statement->bindParam(":status",$chechApprov);
	   $statement->bindParam(":imgLink",$imgLink);
	   $statement->bindParam(":userna",$userNam);
	    $statement->bindParam(":pricety",$price);
	   $statement->bindParam(":typeacc",$acctype);
       $statement->execute();
       $notHidden = FALSE; 
       echo "<p >Your submission has been sent in for review. Place wait until an admin verifies the advertisement.</p>";
	   echo "<p>You can click <a href='submitAd.php'>here</a> to post another ad.</p>";
	   echo "<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>";
	    //Image is saved to roomImage folder assuming no errors are found
		if (!move_uploaded_file($_FILES["imgLink"]["tmp_name"], "roomImage/$imgLink")) {
			$promptERR .= "Error: the image file does not meet specified requirements, please make sure it is a valid image.";
			$validE = true;
		}
	

    } 
	else {  
       echo "<p class='error'>Error: $promptERR</p>";
	   $validE = true;
    } 
  } 

  if ($notHidden) { 
     // generate a a unique string to avoid duplicate data
     $userID = uniqid(NULL,TRUE);
	 
//submit form for the advertisements
?>
<p>Enter any information regarding the advertisement below.</p>
<div class="titleprh">Information about the ad</div>
<form id="pstA" action='' method='post' onsubmit='return datValid();' enctype='multipart/form-data'>
<br>
<div style="margin-left:30px; margin-right:30px;">
	<label id="sa">Ad Title:</label>
		<input class='settr' type='text' name='advertisement_title' placeholder="Title of advertisement" />
</div>
<br>
 <div style="margin-left:30px; margin-right:30px;">
	<label id="sa">Street:</label>
		<input class='settr' type='text' name='street' placeholder="Address" />
</div>
<br>
<div style="margin-left:30px; margin-right:30px;">
	<label id="sa">Province:</label>
			<input class='settr' type='text' name='province' placeholder="Province"/>
</div>
<br>
<div style="margin-left:30px; margin-right:30px;">
	<label id="sa">City:</label>
			<input class='settr' type='text' name='city' placeholder="City" />
</div>
<br>
<div style="margin-left:30px; margin-right:30px;">
	<label id="sa">Price($):</label>
			<input class='settr' type='text' name='price' placeholder="Cost, $ symbol is not necessary" />
</div>
<br>
 <div style="margin-left:30px; margin-right:30px;">
    <label id="">Description:</label>
			<textarea rows='20' id='details' name='details'></textarea>
</div>
	 <div style="margin-left:30px; margin-right:30px">
			 <label id="">Pick image to upload:</label>
			<input type='file' name='imgLink' id='imgLink'/>
	  </div>
   <div class=''>
		<p>&nbsp;</p>
  </div>
	  <div>
		<input style="margin-left:30px; background-color: #72A4D2; width: 200px; height: 50px; cursor: pointer;" 
		type='submit' name='getInfo' value='Post Your Ad'  /></div>
		<br>
</div>
<input type='hidden' name='userID' value="<?php echo htmlspecialchars($userID); ?>"  />
</form>
<?php
	}
	
echo "<p>&nbsp;</p><p>&nbsp;</p>";

}catch (Exception $e) {
     echo "<p class='error'>Error: There was an error when submitting data to the database.</p>";
}
?>

		<hr>
	</td>
</tr>
<!-- ============ FOOTER ============== -->
<tr><td colspan="3" align="center" height="20" bgcolor="black" style="color:#777;">RoomForRent</td></tr>
</table>
</body>

<html>


