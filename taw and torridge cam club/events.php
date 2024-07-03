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
        <title>Events Schedule</title>
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
                <h3>Events Schedule</h3>
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
                            // SQL SELECT statement to select all from the database 'taw_and_torridge_cam_club_db' table 'tbl_events'.
                            $sql = "SELECT * FROM `taw_and_torridge_cam_club_db`.`tbl_events`";
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
            </div>
        </div>        
    </body>
</html>
