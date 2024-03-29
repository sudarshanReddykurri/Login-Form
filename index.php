<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <title>Login Page</title>
        <meta name="description" content="Simple Login Form">

        <link rel="stylesheet" href="css/reset.css">
        <link rel="stylesheet" href="css/styles.css">

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

    <body>
        <div id="outer-container">
            <div id="container">
                <div id="inner-container">
                    <h1>Login Page</h1>
                    <div id="content-blocks-wrapper">
                        <form action="index.php" method="POST" name="ticket">
                            <fieldset>
                                <label for="accountname">USERNAME:</label>
                                <input name="accountname" type="text">
                                <label for="password">PASSWORD:</label>
                                <input name="password" type="password">
                                <div class="clear"></div>
                                <span id="submit-button-border"><input type="submit" name="submit" value="Login" id="submit-button"  ></span>
                                <div class="clear"></div>
                                <br>
                            </fieldset>
                        </form>
                        <?php

                        function myAutoLoader($class) {
                            include $class . '.php';
                        }

                        spl_autoload_register('myAutoLoader');

                        $db = new mysqli("localhost", "root", "root", "login");
                        if ($db->errno) {
                            die("Unable to connect to the database");
                        }

                        if (isset($_POST['accountname']) && isset($_POST['password'])) {
                            $username = mysqli_real_escape_string($_POST['accountname']);
                            $pswd = mysqli_real_escape_string($_POST['password']);
                            $query = "select * FROM users WHERE accountname = '$username'";
                            $result = $db->query($query);
                            $row = $result->fetch_object();
                            $salt = $row->salt;


                            $hash = hash("sha256", $salt . $pswd); //prepend the salt, then hash
                            if ($row->accountname == $username && $row->password == $hash) {
                                echo "<script> window.location = \"http://google.ca\"; </script>";
                                exit;
                            } else {
                                echo "<span style= \"color:#ff5e60; margin-left:10px;\">Username or password is incorrect.</span><br><br>";
                            }
                        }
                        ?>
                        <span class="register">Register for an account <a href="registration.php">here</a>.</span>
                    </div><!-- end #content-blocks-wrapper -->
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <ul id="footer">
            <li>
                Page development by <a href="http://mnmlly.com">Jason Lennstrom</a>.
            </li>
        </ul>

        <script defer src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js?ver=3.2.1'></script>
        <script defer src='http://demo5.launcheffectapp.com/wp-content/themes/launcheffect/js/init.js?ver=1.0'></script>
    </body>
</html>
