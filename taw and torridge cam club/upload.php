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
?>
<!-- Basic parameters for HTML -->
<html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Upload</title>
        <!--------------------  Reference to custom CSS framework  -------------------->
        <link href="css/new_style.css" rel="stylesheet">         
        <!--------------------  Reference to Bootstrap Javascript framework  -------------------->
        <script src="js/bootstrap_bundle_min.js"></script>        
    </head>
    <body>
        <!--------------------  Navigation Bar  -------------------->
        <?php
        //--------------------  Reference to 'rank_nav_bar' function on 'functions.php'  --------------------
        rank_nav_bar();
        ?>
        <!--------------------  Image Upload Form Box, POSTS values to 'upload_process.php'  -------------------->
            <div class="upload_form-box">
                <form action="upload_process.php" method="post" enctype="multipart/form-data"> 
                    <h1>Select Image to Upload</h1>
                    <input type="file" name="fileToUpload" id="fileToUpload"></br></br>
                    Image name: <input type="text" name="imageName"><br></br>
                    <input type="submit" value="Upload Image" name="submit"></br></br>
                </form>
        <!---------------  This is the login validation feed back Div which uses the 'GET' method to retreive error messages from the URL sent from the functions page  --------------->
                <div class="feedback">    
                    <?php
                        if (isset($_GET["error"])) 
                            {
                                if ($_GET["error"] == "tobig") 
                                {
                                    echo "<h2>File to large to upload</h2>";
                                }
                                else if ($_GET["error"] == "uploaded") 
                                {
                                    echo "<h2>File uploaded</h2>";
                                }                                      
                            }
                    ?> 
                </div>                  
            </div>
    </body>