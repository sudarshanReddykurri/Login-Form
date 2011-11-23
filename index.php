<!DOCTYPE html> 
<html lang="en"> 
	<title>Login Page</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<meta name="description" content="Simple Login Form"  /> 
	<link rel="stylesheet" type="text/css" href="css/reset.css" />
	<link rel="stylesheet" type="text/css" href="css/styles.css" />
	
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
					                $username = mysql_real_escape_string($_POST['accountname']);
					                $pswd = mysql_real_escape_string($_POST['password']);
					                $query = "select * FROM users WHERE accountname = '$username'";
					                $result = $db->query($query);
					                $row = $result->fetch_object();
					                $salt = $row->salt;
					
					
					                $hash = hash("sha256", $salt . $pswd); //prepend the salt, then hash
					                if ($row->accountname == $username && $row->password == $hash) {
					                    echo "<script> window.location = \"http://google.ca\"; </script>";
					                    exit;
					                } else {
					                    echo "<span style= \"color:#ff5e60; margin-left:10px;\">Username or password is incorrect.</span><br /><br />";
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