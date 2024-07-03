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
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>League</title>
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
            <div class="wrapper">           
                <h3>League</h3>          
        <!--------------------  HTML Table Column Headings  -------------------->
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>Member ID</th>                                                         
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Points</th>                                                         
                        </tr>
                    </thead>
        <!--------------------  HTML Table Body  -------------------->
                    <tBody>
                        <?php
                            // SQL SELECT statement to select fld_member_id, fld_first_name, and fld_last_name from the members table, fld_image_points and 'SUM(fld_image_points)' from the images table, 
                            // in descending order by  SUM(fld_image_points), grouping the results by member ID.
                            $sql = "SELECT tbl_members.fld_member_id , `fld_first_name`, `fld_last_name` , tbl_images.fld_image_points , SUM(fld_image_points)
                            FROM `taw_and_torridge_cam_club_db`.`tbl_members` , `tbl_images` 
                            WHERE tbl_members.fld_member_id = tbl_images.fld_member_id
                            GROUP BY fld_member_id
                            ORDER BY SUM(fld_image_points) DESC";
        	                // This passes the variables $conn and $sql to the the function 'mysqli_query' and assigns the result of the query to the variable '$result'.
                            $result = mysqli_query($conn, $sql);
                            // This 'IF' statement declares that if the value of the variable '$result' and the number of rows is greater than zero execute the code within the statement. 
                            if ($result && mysqli_num_rows($result) > 0) 
                            {
                                // This 'While' loop fetches the associative array for the value of the variable '$result' and assigns its value to the variable '$rows'.
                                while ($row = mysqli_fetch_assoc($result)) 
                                {     
                                    // This echoes the HTML table containing the varaibles '$row["fld_member_id"]', '$row["fld_first_name"]', '$row["fld_last_name"]' and '$row["SUM(fld_image_points)"]'on each row.
                                    echo "<tr>
                                            <td>" . $row["fld_member_id"] . "</td>
                                            <td>" . $row["fld_first_name"] . "</td>
                                            <td>" . $row["fld_last_name"] . "</td>                                                        
                                            <td>" . $row["SUM(fld_image_points)"] . "</td>                                                                       
                                        </tr>";
                                }
                            }
                        ?>
                    </tbody>
                </table>        
            </div>
        </div>        
    </body>
</html>
