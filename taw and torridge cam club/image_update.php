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
    //--------------------  Reference to 'secr_rank_check' function on 'functions.php'  --------------------
    secr_rank_check();      

    // This 'IF' statement determines if the the submit button has been used to access this prccess page.
    // If the submit button has been used then execute the code within the 'IF' statement.
    if(isset($_POST['submit']))
    {
        // This assigns the values POSTED to this page using '$_POST' method to the variables to be passed on to a function.
        $varimgId = $_POST['imgId'];
        $variTitle = $_POST['iTitle'];
        $variPath = $_POST['iPath'];
        $variPoints = $_POST['iPoints'];
        $varentId = $_POST['entId'];
        $varmemId = $_POST['memId'];
        $varcompId = $_POST['compId'];
        
        //--------------------  Reference to 'adminUpdateImage' function on 'functions.php'  --------------------
        adminUpdateImage($conn, $varimgId, $variTitle, $variPath, $variPoints, $varentId, $varmemId, $varcompId);     
    } 

    // This 'IF' statement determines if the the del button has been used to access this prccess page.
    // If the del button has been used then execute the code within the 'IF' statement.
    if(isset($_POST['del']))
    {     
        // This assigns the value POSTED to this page using '$_POST' method to the variable to be passed on to a function.  
        $varimgId = $_POST['imgId'];        

        //--------------------  Reference to 'adminDeleteImage' function on 'functions.php'  --------------------
        adminDeleteImage($conn, $varimgId);
    }