<?php
/*This page is used to create an admin account on the web server. If the
variables $adminUsr and $adminPass are changed, the values are tested
for duplication. If there is no duplications using the primary key "username" stored
in the database, then an admin account is created using the data stored in those two variables.

The two variables only need to be changed, then the file should be runned on the 
browser to have the admin account be created. 

The following admin account can already be used for testing on the website:
Admin account:
username: myAdmin
password: adminPass

*/

session_start();	


try {
//Database information is retrieved
  require_once ("web_db.php");
  
	  	 //assign details about the admin account here
		 $adminUsr = "myAdmin";
		 $adminPass = "adminPass";

		 
	  //Query a check to avoid duplication and see if username already exists in the database
      $queryt = $db->prepare("SELECT user_name FROM tlaadminstrator WHERE user_name=:getunm");
      $queryt->bindValue(":getunm",trim($adminUsr));
	  $queryt->execute();
	  $testValidity = $queryt->rowCount(); 
      if($testValidity == 1 &&  $isErr == false) {
          $err .= "username is taken, please choose a different one.";
		  $isErr = true;
      }
		
	  //Query a statement to created the account using the information provided above
      $getDate = date("Y-m-d H:i:s");                   
	  $query = $db->prepare("INSERT INTO tlaadminstrator VALUES (:usname, :currDate, SHA2(:pass,256), :acctype, :valid)");
      $query->bindValue(":currDate",$getDate);
      $query->bindValue(":usname",trim($adminUsr));
      $query->bindValue(":pass",trim($adminPass));
	  $query->bindValue(":acctype","admin");
	  $query->bindValue(":valid","valid");
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
            echo "Admin account has been created";	
	  }	
  

} catch (Exception $e) {
   echo $e->getMessage();
}
?>