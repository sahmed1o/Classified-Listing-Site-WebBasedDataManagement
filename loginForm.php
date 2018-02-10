<?php
/* The login form used for the creation of the UI for login.php. 

This script is a modified version of login_register_form.php created by Stephen Karamatos, credits go to him for providing the file as a resource
for learning.

The link to the original source file created by Stephen Karamatos can be found here:
http://307.myweb.cs.uwindsor.ca/apps/show-m6c

*/


//Retrieve session data then test user authentication
	if(!isset($_SESSION['checkAuthentication00356'])){
		$isAuthen = FALSE;
	}
	else{
		$isAuthen = TRUE;
	}
	
	
	//if user is authenticated, go to home page
	if($isAuthen === TRUE){
		header( "Location: index.php" );
	}	
	
?>
<!DOCTYPE html>
<html>
<head>
<!-- These are the icons used for browsers, mainly for aesthetics. -->
<link rel="icon" type="image/png" href="images/logoIcon-16x16.png" sizes="16x16">
<link rel="icon" type="image/png" href="images/logoIcon-32x32.png" sizes="32x32">

<title>RoomForRent Your Source For Temporary Living</title>
<style type="text/css">
<!--remove blank space padding on the top of page layout-->
html, body {
    margin: 0;
    padding: 0;
}
</style>
<link rel="stylesheet" type="text/css" href="webStyle.css" />
</head>
<body style="margin: 0px; padding: 0px; font-family: 'Trebuchet MS',verdana;">

<table id="img2" width="100%" style="height: 100%;" cellpadding="1" cellspacing="0" border="0">
<tr>


<!-- ============ TOP GENERAL NAVIGATION BAR ============== -->
<tr>
	<td colspan="3" valign="middle" height="30" bgcolor="black">
		<a id="c2" href="#" style="float: left;" >Welcome</a>
		
		<a id="c1" href="registration.php" style="float: right;">Register</a>
		<a id="c1" href="login.php" style="float: right;">Login</a>

	</td>
</tr>

<!-- ============ HEADER ============== -->
	<td  valign="top" colspan="3" style="height: 600px;" >
		<img src="images/Logo.png" width="400" height="100">
	

<!-- Filler space to position div-->
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>


<!-- login form-->		
<div id="centerAlign">
		<div >
<?php 
if(isset($err2))	{
         echo "<p style='color:red;'>".$err2."</p>\n";
       } 
?>
		 <div id="login">
		  <form id="login_frm" action="" method="POST" name="login">
			<div class="titleText">
				<label >Login</label>
			</div>
			<fieldset>
			  <div class='field'><label for='cuser'>User Name</label>
				 <input type='text' required name='cuser' maxlength='20'style="width: 250px;" /></div>
			   <div class='field'><label for='cpass'>Password</label>
				 <input type='password' required name='cpass' maxlength='20' style="width: 250px;" /></div>
			  <input type="submit" name="setLog" value="Login" />
			</fieldset> 
		  </form>
		  <p style="color:white;">If an account has been already made, you can log in</p>
		  <p style="color:white;">If your new to this website,then register by clicking <a href="registration.php" class="instructions">here</a></p>
		  </div>
		</div>
		<!--End Login form -->	
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		
	</div>
	</td>
</tr>
</table>
<!-- ============ FOOTER ============== -->
<table width="100%" style="height: 100%;" cellpadding="1" cellspacing="0" border="0">
<tr><td colspan="3" align="center" height="20" bgcolor="black" style="color:#777;">RoomForRent</td></tr>
</table>

</body>

<html>


