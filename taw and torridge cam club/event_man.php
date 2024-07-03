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
        <title>Event Management</title>
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
                <h3>Event Management</h3>
        <!--------------------  Create New Event Form Box, POSTS values to 'event_man_process.php'  -------------------->
                <div class="admin_form-box">		
                            </br></br>
                            <form action="event_man_process.php" method="post">
                            <p>Enter New Event Details</p><br>
                                <input placeholder="Date" type="text" name="date">
                                <input placeholder="Location" type="text" name="location"> 
                                <input placeholder="Season" type="text" name="season">                              
                                <button type="submit" name="submit">Create Event</button>
                            </form>     
                            <div class="feedback">    
                                <?php
                                    if (isset($_GET["error"])) {
                                      if ($_GET["error"] == "none") {
                                        echo "<h3>New Event Created</h3>";
                                      }                                      
                                    }
                                  ?> 
                            </div>                               
                </div>        
        <!--------------------  HTML Table Column Headings  -------------------->
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>Event ID</th>
                            <th>Date</th>
                            <th>Location</th>
                            <th>Season</th>                            
                        </tr>
                    </thead>
        <!--------------------  HTML Table Body  -------------------->
                    <tBody>
                        <?php
                            // SQL SELECT statement to select all from the database 'taw_and_torridge_cam_club_db' table 'tbl_events' in ascending order by the field 'fld_event_id'.
                            $sql = "SELECT * FROM `taw_and_torridge_cam_club_db`.`tbl_events`
                            ORDER BY fld_event_id ASC";
                            // This passes the variables $conn and $sql to the the function 'mysqli_query' and assigns the result of the query to the variable '$result'.
                            $result = mysqli_query($conn, $sql);
                            // This 'IF' statement declares that if the value of the variable '$result' and the number of rows is greater than zero execute the code within the statement. 
                            if ($result && mysqli_num_rows($result) > 0) 
                            {
                                // This 'While' loop fetches the associative array for the value of the variable '$result' and assigns its value to the variable '$rows'.
                                while ($row = mysqli_fetch_assoc($result)) 
                                {     
                                    // This echoes the HTML table containing the varaibles '$row["fld_event_id"]', '$row["fld_date"]', '$row["fld_location"]' and '$row["fld_season"]'on each row.
                                    echo "<tr>
                                            <td>" . $row["fld_event_id"] . "</td>
                                            <td>" . $row["fld_date"] . "</td>
                                            <td>" . $row["fld_location"] . "</td>
                                            <td>" . $row["fld_season"] . "</td>                              
                                          </tr>";
                                }
                            }
                        ?>
                    </tbody>
                </table>
        <!--------------------  Search Events by Event ID Entry Box to Update -------------------->
                <h3>Search By Event ID</h3>
                <br><br>
                <!--  This POSTS the value entered into the text entry box  -->
                <form action="" method="POST">
                    <input type="text" name="id" placeholder="Enter Event ID"/>
                    <input type="submit" name="search" value="Search Events">
                </form>
            <?php
                // This 'IF' statement declares that if the user has used the 'search' button then execute the code within the if statement.
                if(isset($_POST['search']))
                {
                    // This assigns the value POSTED from text entry box to the variable '$id'.
                    $id = $_POST['id'];
                    // SQL SELECT statement to select all from the database 'taw_and_torridge_cam_club_db' table 'tbl_events' where the field 'fld_event_id' matches the value of the variable '$id'.
                    $sql = "SELECT * FROM `taw_and_torridge_cam_club_db`.`tbl_events` WHERE `fld_event_id` LIKE '".$id."'";
                    // This passes the variables $conn and $sql to the the function 'mysqli_query' and assigns the result of the query to the variable '$result'.
                    $result = mysqli_query($conn, $sql);
                    // This 'While' loop fetches the associative array for the value of the variable '$result' and assigns its value to the variable '$rows'.
                    while ($row = mysqli_fetch_assoc($result)) 
                    {
            ?>
                            <br><br>
                            <h3>Update Event Details</h3>
                            <br><br>
                            <!--  This POSTS the value entered into the text entry box to 'event_update.php'  -->
                            <form action="event_update.php" method="post">
                                <!--  This echoes the varaibles '$row["fld_event_id"]', '$row["fld_date"]', '$row["fld_location"]' and '$row["fld_season"]' into the form text boxes ready to be submitted or deleted.  -->
                                <input value="<?php echo $row ['fld_event_id']; ?>"type="text" name="eveId"> 
                                <input value="<?php echo $row ['fld_date']; ?>"type="text" name="date"> 
                                <input value="<?php echo $row ['fld_location']; ?>"type="text" name="location"> 
                                <input value="<?php echo $row ['fld_season']; ?>"type="text" name="season">    
                                <!--  This is the Update button named 'submit' -->                                                     
                                <button type="submit" name="submit">Update Event Details</button>
                                <!--  This is the Delete button named 'del'  -->
                                <button type="submit" name="del">Delete Event</button>
                            </form>      
            <?php
                    }
                }
            ?>
        </div>        
</html>