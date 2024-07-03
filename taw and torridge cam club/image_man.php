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
?>
<!-- Basic parameters for HTML -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Image Management</title>
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
                <h3>Image Management</h3><br>
        <!--------------------  Upload New Image Form Box, POSTS values to 'image_man_process.php'  -------------------->        
                <div class="admin_form-box">		                         
                            <form action="image_man_process.php" method="post" enctype="multipart/form-data"> 
                                <p>Select Image to Upload</p><br>
                                <input type="file" name="fileToUpload" id="fileToUpload">
                                Enter Image Name: <input type="text" name="imageName">
                                <input type="submit" value="Upload Image" name="submit">
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
        <!--------------------  HTML Table Column Headings  -------------------->
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>Image ID</th>
                            <th>Title</th>
                            <th>Directory Path</th>
                            <th>Points</th>
                            <th>Entry ID</th>
                            <th>Member ID</th>
                            <th>Competition ID</th>                            
                        </tr>
                    </thead>
        <!--------------------  HTML Table Body  -------------------->
                    <tBody>
                        <?php
                            // SQL SELECT statement to select all from the database 'taw_and_torridge_cam_club_db' table 'tbl_images' in ascending order by the field 'fld_image_id'.
                            $sql = "SELECT * FROM `taw_and_torridge_cam_club_db`.`tbl_images`
                            ORDER BY fld_image_id ASC";
                            // This passes the variables $conn and $sql to the the function 'mysqli_query' and assigns the result of the query to the variable '$result'.
                            $result = mysqli_query($conn, $sql);
                            // This 'IF' statement declares that if the value of the variable '$result' and the number of rows is greater than zero execute the code within the statement. 
                            if ($result && mysqli_num_rows($result) > 0) 
                            {
                                // This 'While' loop fetches the associative array for the value of the variable '$result' and assigns its value to the variable '$rows'.
                                while ($row = mysqli_fetch_assoc($result)) 
                                {     
                                    // This echoes the HTML table containing the varaibles '$row["fld_image_id"]', '$row["fld_image_title"]', '$row["fld_image_path"]', '$row["fld_image_points"]',  '$row["fld_entry_id"]', '$row["fld_member_id"]' and '$row["fld_competition_id"]'on each row.
                                    echo "<tr>
                                            <td>" . $row["fld_image_id"] . "</td>
                                            <td>" . $row["fld_image_title"] . "</td>
                                            <td>" . $row["fld_image_path"] . "</td>
                                            <td>" . $row["fld_image_points"] . "</td>
                                            <td>" . $row["fld_entry_id"] . "</td>
                                            <td>" . $row["fld_member_id"] . "</td>
                                            <td>" . $row["fld_competition_id"] . "</td>                               
                                          </tr>";
                                }
                            }
                        ?>
                    </tbody>
                </table>
        <!--------------------  Search Images by Image ID Entry Box to Update -------------------->
                 <h3>Search By Image ID</h3>
                 <!--  This POSTS the value entered into the text entry box  -->
                <form action="" method="POST">
                    <input type="text" name="id" placeholder="Enter Image ID"/>
                    <input type="submit" name="search" value="Search Images">
                </form>
            <?php
                // This 'IF' statement declares that if the user has used the 'search' button then execute the code within the if statement.
                if(isset($_POST['search']))
                {
                    // This assigns the value POSTED from text entry box to the variable '$id'.
                    $id = $_POST['id'];
                    // SQL SELECT statement to select all from the database 'taw_and_torridge_cam_club_db' table 'tbl_images' where the field 'fld_image_id' matches the value of the variable '$id'.
                    $sql = "SELECT * FROM `taw_and_torridge_cam_club_db`.`tbl_images` WHERE `fld_image_id` LIKE '".$id."'";
                    // This passes the variables $conn and $sql to the the function 'mysqli_query' and assigns the result of the query to the variable '$result'.
                    $result = mysqli_query($conn, $sql);
                    // This 'While' loop fetches the associative array for the value of the variable '$result' and assigns its value to the variable '$rows'.
                    while ($row = mysqli_fetch_assoc($result)) 
                    {
            ?>                                            
                            <h3>Update Image Details</h3>
                            <!--  This POSTS the value entered into the text entry box to 'image_update.php'  -->
                            <form action="image_update.php" method="post">
                                <!--  This echoes the varaibles '$row["fld_image_id"]', '$row["fld_image_title"]', '$row["fld_image_path"]', '$row["fld_image_points"]', '$row["fld_entry_id"]', '$row["fld_member_id"]' and '$row["fld_competition_id"]' into the form text boxes ready to be submitted or deleted.  -->
                                <input value="<?php echo $row ['fld_image_id']; ?>"type="text" name="imgId"> 
                                <input value="<?php echo $row ['fld_image_title']; ?>"type="text" name="iTitle"> 
                                <input value="<?php echo $row ['fld_image_path']; ?>"type="text" name="iPath"> 
                                <input value="<?php echo $row ['fld_image_points']; ?>"type="text" name="iPoints">    
                                <input value="<?php echo $row ['fld_entry_id']; ?>"type="text" name="entId"> 
                                <input value="<?php echo $row ['fld_member_id']; ?>"type="text" name="memId"> 
                                <input value="<?php echo $row ['fld_competition_id']; ?>"type="text" name="compId"> 
                                <!--  This is the Update button named 'submit' -->                                                 
                                <button type="submit" name="submit">Update Image Details</button>
                                <!--  This is the Delete button named 'del'  -->
                                <button type="submit" name="del">Delete Image</button>
                            </form>                                                
            <?php
                    }
                }
            ?>           
        </div>        
</html>