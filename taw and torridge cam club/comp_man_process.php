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
    // This 'IF' statement determines if the the submit button has been used to access to this prccess page.
    // If the user has used the submit button then execute the code within the 'IF' statement.
        if(isset($_POST['submit']))
        {
            // This assigns the values POSTED to this page using '$_POST' method to the variables to be passed onto a function.
            $vardate = $_POST['date'];
            $varcat = $_POST['cat'];

            //--------------------  Reference to 'createNewComp' function on 'functions.php'  --------------------  
            createNewComp($conn, $vardate, $varcat);
        } 
        
        // If the user gained access to this page without using the submit button execute the code within the 'ELSE' statement.
        else {
            // This redirects the user to the 'comp_man.php' page.
            header("location: comp_man.php");
            // This ends the process stopping the script from running.
            exit();
        }