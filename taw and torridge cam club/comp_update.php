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
    // This 'IF' statement determines if the the submit button has been used to access this prccess page.
    // If the submit button has been used then execute the code within the 'IF' statement.
        if(isset($_POST['submit']))
        {
            // This assigns the values POSTED to this page using '$_POST' method to the variables to be passed on to a function.
            $varcompId = $_POST['compId'];
            $vardate = $_POST['date'];
            $varcat = $_POST['cat'];
            //--------------------  Reference to 'adminUpdateComp' function on 'functions.php'  --------------------
            adminUpdateComp($conn, $varcompId, $vardate, $varcat);
        } 

        // This 'IF' statement determines if the the submit button has been used to access this prccess page.
        // If the submit button has been used then execute the code within the 'IF' statement.
        if(isset($_POST['del']))
        {       
            // This assigns the values POSTED to this page using '$_POST' method to the variables to be passed on to a function.
            $varcompId = $_POST['compId'];
            //--------------------  Reference to 'adminDeleteComp' function on 'functions.php'  --------------------
            adminDeleteComp($conn, $varcompId);
        } 
        
        // This 'IF' statement determines if the the submit button has been used to access this prccess page.
        // If the submit button has been used then execute the code within the 'IF' statement.
        if(isset($_POST['setplace']))
        {
            // This assigns the values POSTED to this page using '$_POST' method to the variables to be passed on to a function.
            $varresId = $_POST['resId'];
            $varimgId = $_POST['imgId'];
            $varplace = $_POST['place']; 
            //--------------------  Reference to 'adminSetCompPlace' function on 'functions.php'  --------------------
            adminSetCompPlace($conn, $varresId, $varimgId, $varplace);
            //--------------------  Reference to 'adminSetImagePoints' function on 'functions.php'  --------------------
            adminSetImagePoints($conn, $varimgId, $varplace);
        }