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
        <title>Event Attendance</title>
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
           
                <h3>Event Attendance</h3>
        <!--------------------  Create New Event Form Box, POSTS values to 'event_att_process.php'  -------------------->
                <div class="admin_form-box">		
                            </br></br>
                            <form action="event_att_process.php" method="post">
                            <p>Enter Member Attendance Details</p><br>
                                <input placeholder="Member ID" type="text" name="memId">
                                <input placeholder="Event ID" type="text" name="eveId"> 
                                <input placeholder="Attended?" type="text" name="att">                              
                                <button type="submit" name="submit">Register Attendance</button>
                            </form>     
                            <div class="feedback">    
                                <?php
                                    if (isset($_GET["error"])) {
                                      if ($_GET["error"] == "none") {
                                        echo "<h3>Attendance Registered</h3>";
                                      }                                      
                                    }
                                  ?> 
                            </div>                               
                </div>      
        <!--------------------  HTML Table Column Headings  -------------------->
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>Attendance ID</th>
                            <th>Member ID</th>
                            <th>Event ID</th>
                            <th>Attended</th>                            
                        </tr>
                    </thead>
        <!--------------------  HTML Table Body  -------------------->
                    <tBody>
                        <?php
                            // SQL SELECT statement to select all from the database 'taw_and_torridge_cam_club_db' table 'tbl_event_attendance' in ascending order by attendance ID.
                            $sql = "SELECT * FROM `taw_and_torridge_cam_club_db`.`tbl_event_attendance`
                            ORDER BY fld_attendance_id ASC";
                            // This passes the variables $conn and $sql to the the function 'mysqli_query' and assigns the result of the query to the variable '$result'.
                            $result = mysqli_query($conn, $sql);
                            // This 'IF' statement declares that if the value of the variable '$result' and the number of rows is greater than zero execute the code within the statement. 
                            if ($result && mysqli_num_rows($result) > 0) 
                            {
                                // This 'While' loop fetches the associative array for the value of the variable '$result' and assigns its value to the variable '$rows'.
                                while ($row = mysqli_fetch_assoc($result)) 
                                {     
                                    // This echoes the HTML table containing the varaibles '$row["fld_attendance_id"]', '$row["fld_member_id"]', '$row["fld_event_id"]' and '$row["fld_attended"]' on each row.
                                    echo "<tr>
                                            <td>" . $row["fld_attendance_id"] . "</td>
                                            <td>" . $row["fld_member_id"] . "</td>
                                            <td>" . $row["fld_event_id"] . "</td>
                                            <td>" . $row["fld_attended"] . "</td>                              
                                          </tr>";
                                }
                            }
                        ?>
                    </tbody>
                </table> 
        <!--------------------  Search Event Attendance Records by Event Attendance ID in Entry Box to Update -------------------->
                <h3>Search By Attendance ID</h3>
                <!--  This POSTS the value entered into the text entry box  -->
                <form action="" method="POST">
                    <input type="text" name="id" placeholder="Enter Attendance ID"/>
                    <input type="submit" name="search" value="Search Attendance Record">
                </form>
            <?php
                    // This 'IF' statement declares that if the user has used the 'search' button then execute the code within the if statement.
                    if(isset($_POST['search']))
                    {
                        // This assigns the value POSTED from text entry box to the variable '$id'.
                        $id = $_POST['id'];
                        // SQL SELECT statement to select all from the database 'taw_and_torridge_cam_club_db' table 'tbl_competitions' where the field attendance ID matches the value of the variable '$id'.
                        $sql = "SELECT * FROM `taw_and_torridge_cam_club_db`.`tbl_event_attendance` WHERE `fld_attendance_id` LIKE '".$id."'";
                        // This passes the variables $conn and $sql to the the function 'mysqli_query' and assigns the result of the query to the variable '$result'.
                        $result = mysqli_query($conn, $sql);                        
                        // This 'While' loop fetches the associative array for the value of the variable '$result' and assigns its value to the variable '$rows'.
                        while ($row = mysqli_fetch_assoc($result)) 
                        {
            ?>                                            
                                <br><br>
                                <!--  This POSTS the value entered into the text entry box to 'event_att_update.php'  -->
                                <form action="event_att_update.php" method="post">
                                    <p>Update Attendance Details</p><br>
                                    <!--  This echoes the varaibles '$row["fld_attendance_id"]', '$row["fld_member_id"]', '$row["fld_event_id"]' and '$row["fld_attended"]' into the form text boxes ready to be submitted or deleted.  -->
                                    <input value="<?php echo $row ['fld_attendance_id']; ?>"type="text" name="attId"> 
                                    <input value="<?php echo $row ['fld_member_id']; ?>"type="text" name="memId"> 
                                    <input value="<?php echo $row ['fld_event_id']; ?>"type="text" name="eveId"> 
                                    <input value="<?php echo $row ['fld_attended']; ?>"type="text" name="att">    
                                    <!--  This is the Update button named 'submit' -->                                                  
                                    <button type="submit" name="submit">Update Attendance Details</button>
                                    <!--  This is the Delete button named 'del'  -->
                                    <button type="submit" name="del">Delete Attendance Record</button>
                                </form>                                            
            <?php
                    }

                }
            ?>                                   
                <!--------------------  HTML Table Column Headings  -------------------->
                <br><br><br>
                <h3>Full Attendance Register</h3><br>
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>Event ID</th>
                            <th>Location</th>
                            <th>Date</th>
                            <th>Season</th>   
                            <th>First Name</th>   
                            <th>Last Name</th>      
                            <th>Attended</th>
                            <th>Attendance ID</th>                            
                        </tr>
                    </thead>
                <!--------------------  HTML Table Body  -------------------->
                    <tBody>
                        <?php
                            // SQL SELECT statement to select fld_event_id, fld_location, fld_date and fld_season from the events table, fld_attended and fld_attendance_id from the event attendance table and fld_first_name and fld_last_name from the members table
                            // in ascending order by event ID
                            $sql = "SELECT tbl_events.fld_event_id , `fld_location`, `fld_date` , `fld_season` , tbl_event_attendance.fld_attended, `fld_attendance_id`, tbl_members.fld_first_name , `fld_last_name` 
                            FROM `taw_and_torridge_cam_club_db`.`tbl_event_attendance` , `tbl_events` , `tbl_members` 
                            WHERE tbl_event_attendance.fld_event_id = tbl_events.fld_event_id
                            AND tbl_event_attendance.fld_member_id = tbl_members.fld_member_id                                        
                            ORDER BY fld_event_id, fld_last_name ASC";
        	                // This passes the variables $conn and $sql to the the function 'mysqli_query' and assigns the result of the query to the variable '$result'.
                            $result = mysqli_query($conn, $sql);
                            if ($result && mysqli_num_rows($result) > 0) 
                            {
                                // This 'While' loop fetches the associative array for the value of the variable '$result' and assigns its value to the variable '$rows'.
                                while ($row = mysqli_fetch_assoc($result)) 
                                {     
                                    // This echoes the HTML table containing the varaibles '$row["fld_event_id"]', '$row["fld_location"]', '$row["fld_date"]', '$row["fld_season"]', '$row["fld_first_name"]', '$row["fld_last_name"]', '$row["fld_attended"]' and '$row["fld_attendance_id"]' on each row.
                                    echo "<tr>
                                            <td>" . $row["fld_event_id"] . "</td>
                                            <td>" . $row["fld_location"] . "</td>
                                            <td>" . $row["fld_date"] . "</td>
                                            <td>" . $row["fld_season"] . "</td>
                                            <td>" . $row["fld_first_name"] . "</td>    
                                            <td>" . $row["fld_last_name"] . "</td>         
                                            <td>" . $row["fld_attended"] . "</td>   
                                            <td>" . $row["fld_attendance_id"] . "</td>                            
                                        </tr>";
                                }
                            }
                        ?>
                    </tbody>
                </table>
        </div>        
</html>