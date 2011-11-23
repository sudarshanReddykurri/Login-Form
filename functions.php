<?php

session_start();

class functions {

    public static function update() {

        $db = new mysqli("localhost", "root", "root", "php_helpdesk");
        if ($db->errno) {
            echo ("Unable to connect to the database");
            exit();
        }

        $db->query("USE users;");

        $firstname = $_GET['firstname'];
        $lastname = $_GET['lastname'];
        $accountname = strtolower($firstname . $lastname);
        $email = $_GET['email'];
        $password = $_GET['password'];
        $id = $_SESSION['id'];
        $authlevel = $_SESSION['authlevel'];
        $query = "UPDATE users SET `firstname`='$firstname', `lastname`='$lastname', `accountname`='$accountname', `email`='$email', `password`='$password' where `id` = '$id'";
        $db->query($query);
        if ($authlevel != 1) {
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=main.php">';
        } else {
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=mainadmin.php">';
        }
    }
    
    public static function create() {

        $db = new mysqli("localhost", "root", "root", "php_helpdesk");
        if ($db->errno) {
            echo ("Unable to connect to the database");
            exit();
        }

        $db->query("USE request;");

        $category_id = $_GET['support'];
        $date_in = $_SESSION['date'];
        $due = $_GET['due_date'];
        $subject = $_GET['subject'];
        $description = $_GET['description'];
        $originator_id = $_SESSION['id'];
        $assigned_id = NULL;
        $date_out = NULL;
        $priority = NULL;
        $status = "NEW";
        $query = "INSERT into request (req_id, originator_id, assigned_id, date_out, priority, status_id, cat_id, date_in, due_date, subject, description) 
        VALUES (NULL, '$originator_id', '$assigned_id', '$date_out', '$priority', '$status', '$category_id', '$date_in' , '$due', '$subject', '$description')";
        $db->query($query);

        if ($authlevel != 1) {
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=main.php">';
        } else {
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=mainadmin.php">';
        }
    }

    static function destroy() {

        session_destroy();
    }
    
    

}

?>
