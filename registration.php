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
		color:#333;
		text-shadow: none;
	}
	
	h2 {
		font-family:Helvetica Neue, Arial, sans-serif;
		font-size:1em;
		font-weight:normal;
		font-style:normal;
		color:#333;
		text-shadow: none;
	}
	
	
	h2.social-heading, label {
		font-family:Helvetica Neue, Arial, sans-serif;
		font-size:.7em;
		font-weight:normal;
		font-style:normal;
		color:#333;
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
		background-color:#c4c4c4;
		color: #fff;
	}
	
	span#submit-button-border {
		border-color:#c4c4c4;
	}
	
	input#submit-button:hover {
		background-color:#f7f7f7;
		color: #333;
	}
	
	#inner-container {
		width:310px;
		margin-top: -100px;		
		margin: 0 auto;		
		background-color: #e9e9e9;
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

<body style="background: #d4d4d4;">

	<div id="outer-container"> 
	
		<div id="container"> 
	
			<div id="inner-container"> 
				
									<h3>Registration</h3>							
				
				<div id="content-blocks-wrapper">

					

            <form action="registration.php" method="GET" name="reg">
<fieldset>
	<label for="firstname">FIRSTNAME:</label>
	<input name="firstname" type="text" />
	<br />
	<label for="lastname">LASTNAME:</label>
	<input name="lastname" type="text" />
	<br />
	<label for="email">EMAIL:</label>
	<input name="email" type="text" />
	<br />
	<label for="password">PASSWORD:</label>
	<input name="password" type="password" />
	<br />
								<?php
								echo date_dropdown();
								?>
								</form>
									<div class="clear"></div>
									<span id="submit-button-border"><input type="submit" name="submit" value="Create" id="submit-button" /></span>
</fieldset>

            <?php
            
            function date_dropdown($year_limit = 0){
                    $html_output = '    <div id="date_select" >'."\n";
                    $html_output .= '        <label for="date_day">DATE OF BIRTH:</label>'."\n";
            
                    /*days*/
                    $html_output .= '           <select name="date_day" id="day_select">'."\n";
                        for ($day = 1; $day <= 31; $day++) {
                            $html_output .= '               <option>' . $day . '</option>'."\n";
                        }
                    $html_output .= '           </select>'."\n";
            
                    /*months*/
                    $html_output .= '           <select name="date_month" id="month_select" >'."\n";
                    $months = array("", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
                        for ($month = 1; $month <= 12; $month++) {
                            $html_output .= '               <option value="' . $month . '">' . $months[$month] . '</option>'."\n";
                        }
                    $html_output .= '           </select>'."\n";
            
                    /*years*/
                    $html_output .= '           <select name="date_year" id="year_select">'."\n";
                        for ($year = 1900; $year <= (date("Y") - $year_limit); $year++) {
                            $html_output .= '               <option>' . $year . '</option>'."\n";
                        }
                    $html_output .= '           </select>'."\n";
            
                    $html_output .= '   </div>'."\n";
                return $html_output;
            }
            
            $db = new mysqli("localhost", "root", "root", "security_ITAS218");

            $password = $_GET['password'];
            $firstname = $_GET['firstname'];
            $lastname = $_GET['lastname'];
            $accountname = strtolower($firstname . $lastname);
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
