<?php
/*The User registration screen. The registerForm.php script will be used as the layout or UI for the register page, 
and will send data to this script to determine if the user has inputted valid data for registration.
If account is valid, then user account will be created.

This is a modified version of login_register.php created by Stephen Karamatos, credits go to him for 
providing the file as a resource for learning.

The link to the original source file created by Stephen Karamatos can be found here:
http://307.myweb.cs.uwindsor.ca/apps/show-m6c
*/

session_start();	

if ($_SERVER['REQUEST_METHOD'] !== "POST") {
   // If no data is needed to be verified, display form
   include("registerForm.php");
   exit;
}

try {
//Retrieve database information
  require_once ("web_db.php");

  if($_POST['setReg'] === "Register")	{
	  	  $isErr = false;
		  
	  //Validation to ensure the size of certain strings inputted, match the conditions below
	  $err = NULL;
	  if (strlen(trim($_POST['uname'])) < 5 || strlen(trim($_POST['upass'])) < 5 || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		  $err .= "There is an error in the user input, make sure username and password is more then 5 characters in length.";
		  $isErr = true;
	 }
	  if(trim($_POST['upass']) !== trim($_POST['upass2'])){
		  $err .="Passwords do not match";
		   $isErr = true;
	  }
	  //Query a check to see if username exists in the database
      $queryt = $db->prepare("SELECT user_name FROM tlauseraccount WHERE user_name=:getunm");
      $queryt->bindValue(":getunm",trim($_POST['uname']));
	  $queryt->execute();
	  $testValidity = $queryt->rowCount(); 
      if($testValidity == 1 &&  $isErr == false) {
          $err .= "username is taken, please choose a different one.";
		  $isErr = true;
      }
		
	//Query a check to see if email exists in the database
      $queryt = $db->prepare("SELECT user_name FROM tlauseraccount WHERE email=:email");
      $queryt->bindValue(":email",trim($_POST['email']));
	  $queryt->execute();
	  $testValidity = $queryt->rowCount(); 
      if($testValidity == 1 &&  $isErr == false) {
          $err .= "email is taken, please choose a different one.";
		  $isErr = true;
      }
	
		//landlord accounts have to approved by the admin, tenant accounts are already verified
		if(trim($_POST['accType']) === "tenant")
		{
			$checkValid = "verified";
		}
		else {
			$checkValid = "unverified";
		}
	
	  if($isErr == true) { 
         include("registerForm.php");
         exit();
      } 
		

		
	  //Data is stored in the database by inserting the inputted data through a query
      $getDate = date("Y-m-d H:i:s");                   
	  $query = $db->prepare("INSERT INTO tlauseraccount VALUES (:usname, :currDate, SHA2(:pass,256), :fname, :lname, :city, :prov, :email, :acctype, :valid)");
      $query->bindValue(":currDate",$getDate);
      $query->bindValue(":usname",trim($_POST['uname']));
      $query->bindValue(":pass",trim($_POST['upass']));
      $query->bindValue(":fname",trim($_POST['ufname']));
      $query->bindValue(":lname",trim($_POST['ulname']));
      $query->bindValue(":city",trim($_POST['city']));
      $query->bindValue(":prov",trim(strtoupper($_POST['prov'])));
      $query->bindValue(":email",trim($_POST['email']));
	  $query->bindValue(":acctype",trim($_POST['accType']));
	  $query->bindValue(":valid",$checkValid);
      $query->execute();
	$chDat = $query->rowCount();
	
	$boolDat = true;//determine if data is valid
	if($chDat > 1 || $chDat < 1)
	{
		$boolDat = false; 
	} else{
		$boolDat = true;
	}
		
      if ($boolDat == false) {
          $err .= "There is an issue with the data submitted.";
		  $isErr = true;
	  }	else {
             //Send an email to the user to validate account (incomplete)
             $relayStr = "You have successfully registered to RoomForRent.com\n";   
 	     	
             mail(trim($store_query[0]['email']),"Registration for RoomForRent",$relayStr);     

			 //If registration is complete without any errors, send user to confirmation page
             header("Location: confirmation.php");
             exit;	

	  }	
  }
   else{                                            	
   include("registerForm.php");
  }

} catch (Exception $e) {
   echo $e->getMessage();
}
?>