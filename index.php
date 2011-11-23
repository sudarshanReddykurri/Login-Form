<!DOCTYPE html> 
<html lang="en"> 
	<title>Login Page</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<meta name="description" content="Simple Login Form"  /> 
	<link rel="stylesheet" type="text/css" href="css/reset.css" />
	<link rel="stylesheet" type="text/css" href="css/styles.css" />
	<style type="text/css">
	h3 {
		font-family:Helvetica Neue, Arial, sans-serif;
		font-size:2em;
		padding-bottom: 25px;
		font-weight:normal;
		font-style:normal;
		color: #333;
		text-shadow: 0px 1px 1px #fff;!important
	}
	
	h2 {
		font-family:Helvetica Neue, Arial, sans-serif;
		font-size:1em;
		font-weight:normal;
		font-style:normal;
		color:#333;
		text-shadow: 0px 1px 1px white;
	}
	
	
	h2.social-heading, label {
		font-family:Helvetica Neue, Arial, sans-serif;
		font-size:.7em;
		font-weight:normal;
		font-style:normal;
		color: #333;
		text-shadow: none;
	}
	
	p, ul#inner-footer li a {
		font-size:1.0em;
				font-family:Helvetica Neue, Arial, sans-serif;
				
	}

	p, span.register {
		color:#333;
	}
	
	p a, ul#inner-footer li a, span.register a {
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
		background-color: #fff;
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

<body style="background: url(images/bkg_body.gif)  repeat-x white;">

	<div id="outer-container" style="background: url(images/bg1.gif) top center no-repeat;"> 
	
		<div id="container"> 
	
			<div id="inner-container"> 

									<h3 style="margin-left: 8px;">Login Page</h3>

				<div id="content-blocks-wrapper">

            		<form action="index.php" method="POST" name="ticket">
						<fieldset>
						<label for="accountname" style="margin-left: 10px;">USERNAME:</label>
						<input name="accountname" type="text"/>
						<label for="password" style="margin-top: -26px; margin-left: 255px;">PASSWORD:</label>
						<input name="password" type="password"/>
						<div class="clear"></div>
							<span id="submit-button-border" style="margin-left: 10px;"><input type="submit" name="submit" value="Login" id="submit-button"  /></span>
							<div class="clear"></div>
							<br />
																			</fieldset>
					</form>
					
					 <?php
					
					            function myAutoLoader($class) {
					                include $class . '.php';
					            }
					
					            spl_autoload_register('myAutoLoader');
					
					            $db = new mysqli("localhost", "root", "root", "login");
					            if ($db->errno) {
					                console . log("Unable to connect to the database");
					                exit();
					            }
					
					            $db->query("USE users");
					
					            if (isset($_POST['accountname']) && isset($_POST['password'])) {
					                $username = $_POST['accountname'];
					                $pswd = $_POST['password'];
					                $query = "select * FROM users WHERE accountname = '$username'";
					                $result = $db->query($query);
					                $row = $result->fetch_object();
					                $salt = $row->salt;
					
					
					                $hash = hash("sha256", $salt . $pswd); //prepend the salt, then hash
					                if ($row->accountname == $username && $row->password == $hash) {
					                    echo "<script> window.location = \"http://google.ca\"; </script>";
					                    exit;
					                } else {
					                    echo "<span style= \"color:#fe5d5f; margin-left:10px;\">Username or password is incorrect.</span><br /><br />";
					                }
					            }
					            ?>
					
					<span class="register" style="margin-left: 10px;">For those without an account please register for one<a href="registration.php"> here</a>.</span>
					
				</div><!-- end #content-blocks-wrapper -->
			
				<div class="clear"></div>
								
			</div> 
	
		</div> 
	
	</div> 

<ul id="footer" style="padding-bottom: 7px;">
	<li>
		Page development by <a href="http://mnmlly.com" style="text-decoration: none; color:#58d1ef;!important !important">Jason Lennstrom</a>.
	</li>
		</ul>
						
</body>
</html>