<!DOCTYPE html> 
<html lang="en"> 
	<title>Registration</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<link rel="stylesheet" type="text/css" href="css/reset.css" />
	<link rel="stylesheet" type="text/css" href="css/styles.css" />
	<style type="text/css">
	h3 {
		font-family:Helvetica Neue, Arial, sans-serif;
		font-size:2em;
		padding-bottom: 25px;
		font-weight:normal;
		font-style:normal;
		color: #B5B5B5;
text-shadow: 0px 1px 1px #fff;!important

		text-shadow: none;
	}
	
	h2 {
		font-family:Helvetica Neue, Arial, sans-serif;
		font-size:1em;
		font-weight:normal;
		font-style:normal;
		color:#333;text-shadow: 0px 1px 1px white;
		color: #B5B5B5;		text-shadow: none;
	}
	
	
	h2.social-heading, label {
		font-family:Helvetica Neue, Arial, sans-serif;
		font-size:.7em;
		font-weight:normal;
		font-style:normal;
text-shadow: 0px 1px 1px white;
color: #B5B5B5;
		text-shadow: none;
	}
	
	p, ul#inner-footer li a {
		font-size:1.0em;
				font-family:Helvetica Neue, Arial, sans-serif;
				
	}

	p, span.privacy-policy {
		color:#333;
	}
	
	p a, ul#inner-footer li a, span.privacy-policy a {
		color:#f60 !important;
	}
	
	input#submit-button {
		background-color:#fff;
		color: #333;
		font-family:Helvetica Neue, Arial, sans-serif;
	}
	
	span#submit-button-border {
		border-color:#aaa;
	}
	
	input#submit-button:hover {
		background-color:#333;
		color: #fff;
	}
	
	#inner-container {
		width:502px;
		margin-top: -100px;		
		margin: 0 auto;		
		background-color: #f4f4f4;
		-webkit-border-radius: 5px; /* Saf3-4, iOS 1-3.2, Android <e;1.6 */
		   -moz-border-radius: 5px; /* FF1-3.6 */
		        border-radius: 5px; /* Opera 10.5, IE9, Saf5, Chrome, FF4, iOS 4, Android 2.1+ */
		        
		/* useful if you don't want a bg color from leaking outside the border: */        
		-moz-background-clip: padding; -webkit-background-clip: padding-box; background-clip: padding-box; 				
	}
	

	.feature {
		width:510px;
	}
	
	.social-container {
		width:492px;
	}


	input,
	textarea,
	input#submit-button {
		-webkit-appearance: none !important;
	}

</style>
	
<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js?ver=3.2.1'></script>
<script type='text/javascript' src='http://demo5.launcheffectapp.com/wp-content/themes/launcheffect/js/init.js?ver=1.0'></script>
	<!--[if lt IE 8]>
	<style type="text/css">
		#outer-container{display:block}
		#container{top:50%;display:block}
		#inner-container{top:-50%;position:relative}
	</style>
	<![endif]--> 
	<!--[if IE 7]>
	<style type="text/css">
		#outer-container{
		position:relative;
		overflow:hidden;
		}
	</style>
	<![endif]--> 
</head>

<body style="background: #ff9c5e;">

	<div id="outer-container"> 
	
		<div id="container"> 
	
			<div id="inner-container"> 
				
									<h3>Registration</h3>							
				
				<div id="content-blocks-wrapper">

					

<form action="registration.php" method="GET" name="reg">
	<fieldset>
	<label for="firstname">FIRSTNAME:</label>
	<input name="firstname" type="text"/>
	<label for="lastname" style="margin-top: -26px; margin-left: 245px;">LASTNAME:</label>
	<input name="lastname" type="text"/>
	<div class="clear"></div>
	<label for="username" style=" ">USERNAME:</label>
	<input name="username" type="text" />
	<label for="dob" style="margin-top: -26px; margin-left: 245px;">DATE OF BIRTH:</label>
	<input name="dob" type="text" value="dd/mm/yyyy" />
	<div class="clear"></div>
	<label for="email">EMAIL:</label>
	<input name="email" type="text"  style=""/>
	<label for="password" style="margin-top: -26px; margin-left: 245px;">PASSWORD:</label>
	<input name="password" type="password" />
	<br />
	<div class="clear"></div>
	<br />
	<span id="submit-button-border"><input type="submit" name="submit" value="Create" id="submit-button" /></span><span id="submit-button-border"><input type="button" name="back" value="Cancel" id="submit-button" /></span>								
	</fieldset>
 </form>
 

            <?php
            
            $db = new mysqli("localhost", "root", "root", "security_ITAS218");

            $password = $_GET['password'];
            $firstname = $_GET['firstname'];
            $lastname = $_GET['lastname'];
            $dob = $_GET['dob'];
            $accountname = $_GET['username'];
            $email = $_GET['email'];

            $salt = bin2hex(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)); //get 256 random bits in hex
            $hash = hash("sha256", $salt . $password); //prepend the salt, then hash
            //store the salt and hash in the same string, so only 1 DB column is needed
            $final = $hash;


            if ($db->errno) {
                echo ("Unable to connect to the database");
                exit();
            }

            $db->query("USE users;");

            $query = "INSERT INTO `security_ITAS218`.`users` (`firstname`, `lastname`, `accountname`, `email`, `password`, `salt`) 
            VALUES ('$firstname', '$lastname', '$accountname', '$email', '$final', '$salt')";

            if ($_GET['firstname'] && $_GET['lastname'] && $_GET['email'] && $_GET['password']) {
                $db->query($query);
                echo "<script> window.location = \"index.php\"; </script>";
            }

            session_destroy();
            ?>
        </div>
    </body>

</html>
