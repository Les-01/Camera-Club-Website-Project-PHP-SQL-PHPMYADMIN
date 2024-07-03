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
    // This assigns the compeition ID of this peticular competition to the variable '$varCompId'. 
    $varCompId = "2";
    //--------------------  Reference to 'set_comp_session' function on 'functions.php'  --------------------
    set_comp_session($conn, $varCompId);
?>
<!-- Basic parameters for HTML -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Sea Scape Competition</title>
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
        <!--  Basic HTML  -->
        <h1>Taw and Torridge Camera Club</h1>
        <div class="main">	
            <h3>Sea Scape Competition</h3>
                <!----------  This is the 'Upload Image' button present on every competition page, it will enter the image into the current pages competition  ---------->  
                <a href="upload.php" class="comppage_upload_button">Upload Image</a>   
                <!----------  This is the HTML select form which enables the user to choose which image to vote for by name. The choice is posted to 'vote_process.php'  ---------->  
                <form action="vote_process.php" method="POST">
                    <label for="comp_vote">Select Image:</label>
                        <select id="comp_vote" name="comp_vote">
                            <!--  SQL SELECT statement to select all images from the database 'taw_and_torridge_cam_club_db' table 'tbl_images' where the field competition ID is equal to the value of the variable '$varCompId'.  -->
                            <?php $sql = "SELECT * FROM `taw_and_torridge_cam_club_db`.`tbl_images` WHERE `fld_competition_id` LIKE '".$varCompId."'";
                            // This passes the variables $conn and $sql to the the function 'mysqli_query' and assigns the result of the query to the variable '$result'
                            $result = mysqli_query($conn, $sql);
                            // This 'IF' statement declares that if the value of the variable '$result' and the number of rows is greater than zero execute the code within the 'IF' statement. 
                            if ($result && mysqli_num_rows($result) > 0) 
                            {
                                // This 'While' loop fetches the associative array for the value of the variable '$result' and assigns its value to the variable '$rows' 
                                while ($rows = $result->fetch_assoc()) 
                                { ?>
                                <!--  Here the value is supplied by echoing the varaible '$rows' which contains the array element 'fld_image_id' and the varaible '$rows' which contains the array element 'fld_image_title'.  -->
                                    <option value="<?php echo $rows['fld_image_id'];?>"><?php echo $rows['fld_image_title'];?></option>  
                            <?php
                                }
                            }
                            ?>      
                        </select>
                        <!--  This is the button that sub,its the value of the HTML select form  -->
                    <input type="submit" name="submit" value="Place Your Vote">
                </form>      

                <?php
                    //  SQL SELECT statement to select all images from the database 'taw_and_torridge_cam_club_db' table 'tbl_images' where the field competition ID is equal to the value of the variable '$varCompId'.
                    $sql = "SELECT * FROM `taw_and_torridge_cam_club_db`.`tbl_images` WHERE `fld_competition_id` LIKE '".$varCompId."'";
                    // This passes the variables $conn and $sql to the the function 'mysqli_query' and assigns the result of the query to the variable '$result'
                    $result = mysqli_query($conn, $sql);
                    // This 'IF' statement declares that if the value of the variable '$result' and the number of rows is greater than zero execute the code within the 'IF' statement. 
                    if ($result && mysqli_num_rows($result) > 0) {
                        // This 'While' loop fetches the associative array for the value of the variable '$result' and assigns its value to the variable '$rows' 
                        while ($rows = $result->fetch_assoc()) { ?>
                        <!--  Basic HTML gallery  -->   
                            <div class="gallery">
                                <div class="gallery">
                                    <div class="card" style="width: 280px; height: 240px;">
                                        <!--  Here the image source is supplied by echoing the varaible '$rows' which contains the array element 'fld_image_path'  -->
                                        <img src="<?php echo $rows['fld_image_path']; ?>" alt="" width="600" height="600">
                                        <div class="card-body">
                                            <div class="desc"><?php 
                                                // This echoes the text 'Image Title - '.
                                                echo "Image Title - ";
                                                // This echoes the varaible '$rows' which contains the array element 'fld_image_title'.
                                                echo $rows['fld_image_title'];
                                                // This echoes a line break.
                                                echo "<br>";
                                                // This echoes the text 'Entry ID - '.
                                                echo "Entry ID - ";
                                                // This echoes the varaible '$rows' which contains the array element 'fld_entry_id'.
                                                echo $rows['fld_entry_id']; ?>
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
    </body>
</html>
