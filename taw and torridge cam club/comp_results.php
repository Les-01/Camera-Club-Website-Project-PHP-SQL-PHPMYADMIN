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
        <title>Competition Results</title>
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
                <h3>Competition Results</h3>
        <!--------------------  HTML Table Column Headings  -------------------->
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>Competition ID</th>
                            <th>Category</th>
                            <th>Date</th>                           
                        </tr>
                    </thead>
        <!--------------------  HTML Table Body  -------------------->
                    <tBody>
                        <?php
                            // SQL SELECT statement to select all from the database 'taw_and_torridge_cam_club_db' table 'tbl_competitions' in ascending order by competition ID.
                            $sql = "SELECT * FROM `taw_and_torridge_cam_club_db`.`tbl_competitions`
                            ORDER BY fld_competition_id ASC";
                            // This passes the variables $conn and $sql to the the function 'mysqli_query' and assigns the result of the query to the variable '$result'.
                            $result = mysqli_query($conn, $sql);
                            // This 'IF' statement declares that if the value of the variable '$result' and the number of rows is greater than zero execute the code within the statement. 
                            if ($result && mysqli_num_rows($result) > 0) 
                            {
                                // This 'While' loop fetches the associative array for the value of the variable '$result' and assigns its value to the variable '$rows'.
                                while ($row = mysqli_fetch_assoc($result)) 
                                {     
                                    // This echoes the HTML table containing the varaibles '$row["fld_competition_id"]', '$row["fld_category"]' and '$row["fld_date"]'on each row.
                                    echo "<tr>
                                            <td>" . $row["fld_competition_id"] . "</td>
                                            <td>" . $row["fld_category"] . "</td>
                                            <td>" . $row["fld_date"] . "</td>
                                        </tr>";
                                }
                            }
                        ?>
                    </tbody>
                </table>  
        <!--------------------  Search Competitions by Competition ID Entry Box to View Competiton Results -------------------->
                <h3>Search Competitions</h3>
                <br>
                <!--  This POSTS the value entered into the text entry box  -->
                <form action="" method="POST">
                    <input type="text" name="id" placeholder="Enter Competition ID"/>
                    <input type="submit" name="search" value="Search Competiton Results">
                </form>
            <?php
                // This 'IF' statement declares that if the user has used the 'search' button then execute the code within the if statement.
                if(isset($_POST['search']))
                {
                    // This assigns the value POSTED from text entry box to the variable '$id'.
                    $id = $_POST['id'];?>

        <!--------------------  HTML Table Column Headings  -------------------->
                <table class="styled-table">
                <thead>
                    <tr>                                          
                        <th>First Name</th>   
                        <th>Last Name</th>      
                        <th>Image Title</th>
                        <th>Category</th>  
                        <th>Votes</th>      
                        <th>Place</th>                    
                    </tr>
                </thead>                
        <!--------------------  HTML Table Body  -------------------->
                    <tBody>
                        <?php
                            // SQL SELECT statement to select fld_image_title and fld_image_votes from the images table, fld_category from the competitions table, fld_first_name and fld_last_name from the members table 
                            // and fld_place from the competition results table where field competition ID matches the value of the variable '$id', in descending order by image votes limited to 3 results.
                            $sql = "SELECT tbl_images.fld_image_title , `fld_image_votes` , tbl_competitions.fld_category, tbl_members.fld_first_name , `fld_last_name` , tbl_competition_results.fld_place
                            FROM `taw_and_torridge_cam_club_db`.`tbl_competitions` , `tbl_images` , `tbl_members` , `tbl_competition_results`
                            WHERE tbl_images.fld_competition_id = tbl_competitions.fld_competition_id
                            AND tbl_images.fld_member_id = tbl_members.fld_member_id       
                            AND tbl_images.fld_image_id = tbl_competition_results.fld_image_id
                            AND tbl_competitions.fld_competition_id LIKE '".$id."'                                 
                            ORDER BY fld_image_votes DESC
                            LIMIT 3";
                            // This passes the variables $conn and $sql to the the function 'mysqli_query' and assigns the result of the query to the variable '$result'.             
                            $result = mysqli_query($conn, $sql);
                            // This 'IF' statement declares that if the value of the variable '$result' and the number of rows is greater than zero execute the code within the statement.
                            if ($result && mysqli_num_rows($result) > 0) 
                            {
                                // This 'While' loop fetches the associative array for the value of the variable '$result' and assigns its value to the variable '$rows'.
                                while ($row = mysqli_fetch_assoc($result)) 
                                {     
                                    // This echoes the HTML table containing the varaibles '$row["fld_first_name"]', '$row["fld_last_name"]', '$row["fld_image_title"]', '$row["fld_category"]', '$row["fld_image_votes"]' and '$row["fld_place"]' on each row.
                                    echo "<tr>
                                            <td>" . $row["fld_first_name"] . "</td>
                                            <td>" . $row["fld_last_name"] . "</td>
                                            <td>" . $row["fld_image_title"] . "</td>
                                            <td>" . $row["fld_category"] . "</td>       
                                            <td>" . $row["fld_image_votes"] . "</td> 
                                            <td>" . $row["fld_place"] . "</td>                                                                          
                                        </tr>";
                                }
                            }
                        ?>
                    </tbody>
                </table>                                                    
                <?php
                    }                                            
                ?>   
            </div>
        </div>        
    </body>
</html>
