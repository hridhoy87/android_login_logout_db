<?php
require "DataBase.php";
$db = new DataBase();
if (isset($_POST['f_name']) && isset($_POST['spouse_BA_no']) && isset($_POST['username']) && isset($_POST['password'])) {
    if ($db->dbConnect()) {
        if ($db->signUp("users", $_POST['f_name'], $_POST['spouse_BA_no'], $_POST['username'], $_POST['password'])) {
            echo "Sign Up Success";
        } else echo "Sign up Failed";
    } else echo "Error: Database connection";
} else echo "All fields are required";
?>
