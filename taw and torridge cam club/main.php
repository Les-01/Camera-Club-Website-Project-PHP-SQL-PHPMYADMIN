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
<html lang="en">
    <head> 
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Main</title>
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
            <div class="wrapper">  
                <h3>Welcome to the Friendly Camera Club in North Devon</h3><br><br>
                    <p>Here at the Taw and Torrdge Camera Club our members have developed a real sense of community where all our members 
                    aim to contribute and share their creativity. We hold various meets and events throughout the year where any member can speak up and share their thought and ideas. 
                    We reguarly host 'in house' friendly competitions, we even have a our own league! New members are always welcome here at the Camera Club, feel free to sign up to 
                    get full access this site such as the competitions page or the league.</p><br><br>
                <h3>TOP 10</h3>
                <br><br>
                <?php
                    // SQL SELECT statement to select all from the database 'taw_and_torridge_cam_club_db' table 'tbl_images' in ascending order by fld_image_points, limit to 10 results.
                    $sql = "SELECT * FROM `taw_and_torridge_cam_club_db`.`tbl_images`
                    ORDER BY fld_image_points ASC
                    LIMIT 10";
                    // This passes the variables $conn and $sql to the the function 'mysqli_query' and assigns the result of the query to the variable '$result'.
                    $result = mysqli_query($conn, $sql);
                    // This 'IF' statement declares that if the value of the variable '$result' and the number of rows is greater than zero execute the code within the statement. 
                    if ($result && mysqli_num_rows($result) > 0) {
                        // This 'While' loop fetches the associative array for the value of the variable '$result' and assigns its value to the variable '$rows'.
                        while ($rows = $result->fetch_assoc()) { ?>
                            <!--  Basic HTML gallery  --> 
                            <div class="gallery">
                                <div class="gallery">
                                    <div class="card" style="width: 440px; height: 340px;">
                                        <!--  Here the image source is supplied by echoing the varaible '$rows' which contains the array element 'fld_image_path'  -->
                                        <img src="<?php echo $rows['fld_image_path']; ?>" alt="" width="600" height="40">
                                            <div class="card-body">
                                                <!--  Here the image description is supplied by echoing the varaible '$rows' which contains the array element 'fld_image_title'  -->
                                                <div class="desc"><?php echo $rows['fld_image_title'];?>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div> 
                <?php
                            }
                        }
                ?>
            </div>
        </div>        
    </body>
</html>
