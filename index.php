<?php
/*The index page is used for redirection. If the user is authenticated and a tenant then it will redirect
the user to the tenant page. If the user is a landlord it will redirect them to the landlord page.*/

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
				header( "Location: tenantHome.php" );		
			}
			else if($_SESSION["accounType6334"] === "landlord"){
				header( "Location: landlordHome.php" );
			}
			else if ($_SESSION["accounType6334"] === "admin"){
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

</head>

<body>

</body>

<html>


