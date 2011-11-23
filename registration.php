<!DOCTYPE html> 
<html lang="en">
    <head>
        <title>Registration</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
        <link rel="stylesheet" type="text/css" href="css/reset.css" />
        <link rel="stylesheet" type="text/css" href="css/styles.css" />
        <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js?ver=3.2.1'></script>
        <script type='text/javascript' src='http://demo5.launcheffectapp.com/wp-content/themes/launcheffect/js/init.js?ver=1.0'></script>
        <script type="text/javascript">
            function goBack()
            {
                window.location = "index.php";
            }
        </script>
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
                    <h3 style="margin-left: 8px;">Registration</h3>							
                    <div id="content-blocks-wrapper">
                        <form action="registration.php" method="GET" name="reg">
                            <fieldset>
                                <label for="firstname" style="margin-left: 10px;">FIRSTNAME:</label>
                                <input name="firstname" type="text"/>
                                <label for="lastname" style="margin-top: -26px; margin-left: 255px;">LASTNAME:</label>
                                <input name="lastname" type="text"/>
                                <div class="clear"></div>
                                <label for="username" style="margin-left: 10px;">USERNAME:</label>
                                <input name="username" type="text" />
                                <label for="dob" style="margin-top: -26px; margin-left: 255px;">DATE OF BIRTH:</label>
                                <input name="dob" type="text" value="dd/mm/yyyy" />
                                <div class="clear"></div>
                                <label for="email" style="margin-left: 10px;">EMAIL:</label>
                                <input name="email" type="text" />
                                <label for="password" style="margin-top: -26px; margin-left: 255px;">PASSWORD:</label>
                                <input name="password" type="password" />
                                <br />
                                <div class="clear"></div>
                                <br />
                                <span id="submit-button-border" style="margin-left: 10px;"><input type="submit" name="submit" value="Create" id="submit-button"  /></span><span id="submit-button-border"><input type="button" name="back" value="Cancel" id="submit-button" onclick="goBack()" /></span>							
                            </fieldset>
                        </form>
                        <?php
                        $db = new mysqli("localhost", "root", "root", "login");

                        $password = $_GET['password'];
                        $firstname = $_GET['firstname'];
                        $lastname = $_GET['lastname'];
                        $dob = $_GET['dob'];
                        $accountname = strtolower($_GET['username']);
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

                        $query = "INSERT INTO `login`.`users` (`firstname`, `lastname`, `accountname`, `birthdate`, `email`, `password`, `salt`) 
            		VALUES ('$firstname', '$lastname', '$accountname', '$dob', '$email', '$final', '$salt')";

                        if ($_GET['firstname'] && $_GET['lastname'] && $_GET['email'] && $_GET['password']) {
                            $db->query($query);
                            echo "<script> window.location = \"index.php\"; </script>";
                        }

                        session_destroy();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
