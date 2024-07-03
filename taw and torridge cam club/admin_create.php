<?php
    // Command to start the session containing 'super gloabal' variables.
    session_start();
    // Link to 'config/conn.php' containing the database connection code and 'functions.php' containing all the application functions.
    // 'require_once' is used instead of 'include' as the require function is designed for when the file is required by your application
    // such as an important file containing configuration variables, without which the application would break. Whereas include is used to 
    // include files that the application flow would continue when not found, such as templates.
    require_once 'config/conn.php';
    require_once 'functions.php';

    //--------------------  Reference to 'check_login' function on 'functions.php'  --------------------
    check_login($conn);
    //--------------------  Reference to 'admin_rank_check' function on 'functions.php'  --------------------
    admin_rank_check();
    // This 'IF' statement declares that if the user has used the submit button on the sign up form to gain access to this process page then
    // execute the code within the if statement.
        if(isset($_POST['submit']))
        {
            // This assigns the values POSTED to this page using '$_POST' method to the variables to be passed onto a function.
            $varfName = $_POST['fName'];
            $varlName = $_POST['lName'];
            $varaddress = $_POST['Address'];
            $varphoneNum = $_POST['pNum'];
            $varemail = $_POST['Email'];
            $varpassword = md5($_POST['Password']);
            $varrank = $_POST['Rank'];

            //--------------------  Reference to 'adminCreateUserAccount' function on 'functions.php'  --------------------
            adminCreateUserAccount($conn, $varfName, $varlName, $varaddress, $varphoneNum, $varemail, $varpassword, $varrank);
        }