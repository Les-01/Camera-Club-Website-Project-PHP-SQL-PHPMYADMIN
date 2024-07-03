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

    // This assigns the competition ID of the competition the image is being entered into to the variable '$varCompId'. 
    $varcompId = $_SESSION['fld_competition_id'];
    // This assigns the member ID of the member entering the image into the competition into to the variable '$varmemId'. 
    $varmemId = $_SESSION['fld_member_id'];        

    // This 'IF' statement declares that if the submit button has been used to access this proccess page execute the code within the 'IF' statement.
        if(isset($_POST['submit']))
        {
            // This assigns the value POSTED to this page using '$_POST' method to the variable to be passed on to a function.
            $varimgId = $_POST['comp_vote'];
            competitionvoting ($conn, $varimgId, $varmemId, $varcompId);
        }