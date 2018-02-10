<?php
/*The User login screen. The loginForm.php script will be used as the layout or UI for the login. 
This page will send data using a post request to determine if the user has a valid account.
If account is valid, then user will be authenticated.

This is a modified version of login_register.php created by Stephen Karamatos, credits go to him for 
providing the file as a resource for learning.

The link to the original source file created by Stephen Karamatos can be found here:
http://307.myweb.cs.uwindsor.ca/apps/show-m6c
*/

//Retrieve session data then test user authentication
session_start();	

if ($_SERVER['REQUEST_METHOD'] !== "POST") {
   //Display form if data check is not needed
   include("loginForm.php");
   exit;
}

try {
//Retrieve database information
  require_once ("web_db.php");  

  //Used to determine what type of account the user is, 1 is tenant, 2 is landlord, 3 is admin
  $typeAcc = 1;
  
  if($_POST['setLog'] === "Login")	{	
  
	  //Query a statement to output a row with the condition of the username and pass equal to the requested login info
      $query = $db->prepare("SELECT user_name FROM tlauseraccount WHERE user_name=:usname AND password = SHA2(:pass,256) AND isValid = 'verified'");
      $query->bindValue(":usname",trim($_POST['cuser']));
      $query->bindValue(":pass",trim($_POST['cpass']));
	  $query->execute();
	  
	  //If the query stored in $query displays 1 row, that means the user password and username is valid
      if($query->rowCount() == 1) {
			 $_SESSION['checkAuthentication00356'] = TRUE;    
			 $_SESSION['userNamstr6321'] = trim($_POST['cuser']);  		 
			 $store_query = $query->fetchAll(PDO::FETCH_ASSOC);		 
			 $_SESSION['checkAuthentication00356_data'] = $store_query[0];
			 
			 //Due a first check to see if account is a tenant account
			 $tempIsAdmin = $db->prepare("SELECT user_name FROM tlauseraccount WHERE user_name = '" .$_POST['cuser']. "' AND accounType = 'tenant'");
			 $tempIsAdmin->execute();
			 //check if row is returned containing the username with tenant access
			 if($tempIsAdmin->rowCount() == 1){
				$typeAcc = 1;
			 }	
			 
			 //Due a second check to see if account is a landlord account
			$tempIsAdmin = $db->prepare("SELECT user_name FROM tlauseraccount WHERE user_name = '" .$_POST['cuser']. "' AND accounType = 'landlord'");
			$tempIsAdmin->execute();
			if($tempIsAdmin->rowCount() == 1){
				$typeAcc = 2;
			}	
			
			switch ($typeAcc) {
			case 1:
				$_SESSION['accounType6334'] = "tenant"; 
				header("Location: index.php");    
				break;
			case 2:
				$_SESSION['accounType6334'] = "landlord"; 
				header("Location: index.php");  
				break;
			}
			exit;
	
		 }
		 else{
			 
		//Due a third check to see if account is a admin account
		$adQuery = $db->prepare("SELECT user_name FROM tlaadminstrator WHERE user_name=:usname AND password = SHA2(:pass,256) AND accounType = 'admin'");
		$adQuery->bindValue(":usname",trim($_POST['cuser']));
		  $adQuery->bindValue(":pass",trim($_POST['cpass']));
			$adQuery->execute();
				if($adQuery->rowCount() == 1){
				$_SESSION['checkAuthentication00356'] = TRUE;    
				 $_SESSION['userNamstr6321'] = trim($_POST['cuser']);  		 
				 $store_query = $adQuery->fetchAll(PDO::FETCH_ASSOC);		 
				 $_SESSION['checkAuthentication00356_data'] = $store_query[0];
				 
					$_SESSION['accounType6334'] = "admin"; 
					header("Location: index.php");  
					 exit;
				}		
			 else  {
				 //User info does not match, display Login form again with error             	
				 $err2 = "Login or password is incorrect, please try again<br />";
				 include("loginForm.php");
				 exit;
			 }	
		 }			 
					 
  }                                            	

  
  else{                                            	
   include("LoginForm.php");
  }

} catch (Exception $e) {
   echo $e->getMessage();
}	  
?>
