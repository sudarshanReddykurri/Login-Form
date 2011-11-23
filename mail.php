<?php
session_start();
	if(isset($_POST))
	{
		// change this to match YOUR email address
			$to = "$_SESSION['email']";
		// the subject of the email that you will receive
		$subject = "Account Registration";
		
		// body of the email
		// *****************
		$message = "Thanks for making an account using the ___________ Registration Page. Hope you enjoy your time using our service.";
		// *****************
		// end of the body
		
		// send mail message
		mail($to,$subject,$message);
	}
?>