<?php
/* The registration form used for the creation of the UI for registration.php. 

This script is a modified version of login_register_form.php created by Stephen Karamatos,
credits go to him for providing the file as a resource for learning.

The link to the original source file created by Stephen Karamatos can be found here:
http://307.myweb.cs.uwindsor.ca/apps/show-m6c

*/
?>
<!DOCTYPE html>
<html>
<head>
<!-- These are the icons used for browsers, mainly for aesthetics. -->
<link rel="icon" type="image/png" href="images/logoIcon-16x16.png" sizes="16x16">
<link rel="icon" type="image/png" href="images/logoIcon-32x32.png" sizes="32x32">

<title>RoomForRent Your Source For Temporary Living</title>
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


<!--Register form -->
<div id="centerAlign">
		<div >
<?php 
if(isset($err))	{
         echo "<p style='color:red;'>".$err."</p>\n";
       } 
?>
		 <div id="login">
		  <form id="login_frm" action="" method="POST" name="login">
			<div class="titleText">
				<label >Register</label>
			</div>
			<fieldset>
			<div class='field'><label for='uname'>User Name</label>
					<input type='text' required name='uname' maxlength='20' style="width: 250px;" />
				 </div>
			   <div class='field'><label for='upass'>Password</label>
				 <input type='password' required name='upass' maxlength='20' style="width: 250px;" />
				 </div>
			   <div class='field'><label for='upass2'>Re-enter Password</label>
					<input type='password' required name='upass2' maxlength='20' style="width: 250px;" />
				 </div>
			   <div class='field'><label for='email'>Email Address</label>
					<input type='text' required name='email' maxlength='100' style="width: 250px;" />
				 </div>
			   <div class='field'><label for='ufname'>First Name</label>
					<input type='text' required name='ufname' maxlength='40' style="width: 250px;" />
				 </div>
			   <div class='field'><label for='ulname'>Last Name</label>
					<input type='text' required name='ulname' maxlength='40' style="width: 250px;" />
				 </div>
			   <div class='field'><label for='city'>City</label>
					<input type='text' name='city' maxlength='70' style="width: 250px;" />
				 </div>
			   <div class='field'><label for='prov'>Province</label>
					<input type='text' name='prov' maxlength='2' style="width: 250px;" />
				 </div>
				<div class='field'><label for='accType'>Account Type</label>
					<input type="radio" name="accType" value="tenant" checked> Tenant
					<input type="radio" name="accType" value="landlord"> Landlord
				 </div>
			   <input type="submit" name="setReg" value="Register">
			  </fieldset>
			</form>
		  </div>
		  <p style="color:white;">If you already have an account, then click <a href="login.php" class="instructions">here to log in</a></p>
		</div>
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


