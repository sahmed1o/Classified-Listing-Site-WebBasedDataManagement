<?php
/* Simply used to logout by removing session data, then redirecting back to the index page. 
  
A non modified version of logout.php created by Stephen Karamatos for assignment 6, credits go to him for 
providing the file as a resource for learning. I don't claim any credit in the making of this file. The file
is used for educational purposes for the user to log out of the website.
*/
  
  session_start();
  $_SESSION = array();
  session_destroy();  
  header("Location: index.php");
  exit;
?>