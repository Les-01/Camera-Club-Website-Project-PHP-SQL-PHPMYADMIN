<?php
    // Command to start the session containing 'super gloabal' variables.
    session_start();
    // Link to 'config/conn.php' containing the database connection code and 'functions.php' containing all the application functions.
    // 'require_once' is used instead of 'include' as the require function is designed for when the file is required by your application
    // such as an important file containing configuration variables, without which the application would break. Whereas include is used to 
    // include files that the application flow would continue when not found, such as templates.
    require_once 'config/conn.php';
    require_once 'functions.php';
?>
<!-- Basic parameters for HTML -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Bio</title>
        <!--------------------  Reference to custom CSS framework  -------------------->
        <link href="css/new_style.css" rel="stylesheet">         
        <!--------------------  Reference to Bootstrap Javascript framework  -------------------->
        <script src="js/bootstrap_bundle_min.js"></script>   
    </head>
    <body>    
        <!--------------------  Navigation Bar  -------------------->
        <?php
            //--------------------  Reference to 'not_signed_in_nav_bar' function on 'functions.php'  --------------------
            not_signed_in_nav_bar();
            //--------------------  Reference to 'rank_nav_bar' function on 'functions.php'  --------------------
            rank_nav_bar();
        ?>     
        <!--  Basic HTML  -->
        <h1>Taw and Torridge Camera Club</h1>        
        <div class="main">	
            <h3>Bio</h3>	       
            <br><br>        
                <img class="circular--square" src="cam.jpg" />
                <p style="text-align:center"><br>We are the Taw and Torridge Camera Club, a North Devon based, open to all members photography and camera club.<br> 
                Our friendly Camera Club hosts regular meets for all interested parties mambers and non-members alike. <br>We regularly host meets, events and friendly competitions.<br>
                New Members Welcome.<br></p>   
        </div>        
    </body>
</html>
