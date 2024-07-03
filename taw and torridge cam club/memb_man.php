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
    //--------------------  Reference to 'admin_rank_check' function on 'functions.php'  --------------------
    admin_rank_check();
?>
<!-- Basic parameters for HTML -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Member Management</title>
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
                <h3>Member Management</h3>
        <!--------------------  Admin Create New Member Form Box, POSTS values to 'admin_create.php'  -------------------->
        <div class="admin_form-box">		
                    </br></br>
                    <form action="admin_create.php" method="post">
                        <p>Enter New Member Details</p><br>
                        <input placeholder="First Name" type="text" name="fName"> 
                        <input placeholder="Last Name" type="text" name="lName">
                        <input placeholder="Phone Number" type="text" name="pNum"> 
                        <input placeholder="Address" type="text" name="Address">  
                        <input placeholder="Email" type="text" name="Email"> 
                        <input placeholder="Password" type="password" name="Password"> 
                        <input placeholder="Rank" type="text" name="Rank"> 
                        <button type="submit" name="submit">Create New Member</button>
                    </form>                     
                </div>      
        <!--------------------  HTML Table Column Headings  -------------------->
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>Member ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Rank</th>
                        </tr>
                    </thead>
        <!--------------------  HTML Table Body  -------------------->
                    <tBody>
                        <?php
                           // SQL SELECT statement to select all from the database 'taw_and_torridge_cam_club_db' table 'tbl_members' in ascending order by fld_first_name.
                            $sql = "SELECT * FROM `taw_and_torridge_cam_club_db`.`tbl_members`
                            ORDER BY fld_first_name ASC";
                            // This passes the variables $conn and $sql to the the function 'mysqli_query' and assigns the result of the query to the variable '$result'.
                            $result = mysqli_query($conn, $sql);
                            // This 'IF' statement declares that if the value of the variable '$result' and the number of rows is greater than zero execute the code within the statement. 
                            if ($result && mysqli_num_rows($result) > 0) 
                            {
                                // This 'While' loop fetches the associative array for the value of the variable '$result' and assigns its value to the variable '$rows'.
                                while ($row = mysqli_fetch_assoc($result)) 
                                {     
                                    // This echoes the HTML table containing the varaibles '$row["fld_member_id"]', '$row["fld_first_name"]', '$row["fld_last_name"]', '$row["fld_phone_number"]', '$row["fld_address"]', '$row["fld_email"]', '$row["fld_password"]' and '$row["fld_rank"]'on each row.
                                    echo "<tr>
                                            <td>" . $row["fld_member_id"] . "</td>
                                            <td>" . $row["fld_first_name"] . "</td>
                                            <td>" . $row["fld_last_name"] . "</td>
                                            <td>" . $row["fld_phone_number"] . "</td>
                                            <td>" . $row["fld_address"] . "</td>
                                            <td>" . $row["fld_email"] . "</td>
                                            <td>" . $row["fld_password"] . "</td>
                                            <td>" . $row["fld_rank"] . "</td>                                                                     
                                        </tr>";
                                }
                            }
                        ?>
                    </tbody>
                </table>        

        <!--------------------  Search Members by Member ID Entry Box to Update -------------------->
                <h3>Update Search</h3>
                <!--  This POSTS the value entered into the text entry box  -->
                <form action="" method="POST">
                    <input type="text" name="id" placeholder="Enter Member ID to Search"/>
                    <input type="submit" name="search" value="Search Data">
                </form>
            <?php
                // This 'IF' statement declares that if the user has used the 'search' button then execute the code within the if statement.
                if(isset($_POST['search']))
                {
                    // This assigns the value POSTED from text entry box to the variable '$id'.
                    $id = $_POST['id'];
                    // SQL SELECT statement to select all from the database 'taw_and_torridge_cam_club_db' table 'tbl_members' where the field 'fld_member_id' matches the value of the variable '$id'.
                    $sql = "SELECT * FROM `taw_and_torridge_cam_club_db`.`tbl_members` WHERE `fld_member_id` LIKE '".$id."'";
                    // This passes the variables $conn and $sql to the the function 'mysqli_query' and assigns the result of the query to the variable '$result'.
                    $result = mysqli_query($conn, $sql);
                    // This 'While' loop fetches the associative array for the value of the variable '$result' and assigns its value to the variable '$rows'.
                    while ($row = mysqli_fetch_assoc($result)) 
                    {
            ?>                                            
                            <h3>Update Member Details</h3>
                            <!--  This POSTS the value entered into the text entry box to 'admin_update.php'  -->
                            <form action="admin_update.php" method="POST">
                                <!--  This echoes the varaibles '$row["fld_member_id"]', '$row["fld_first_name"]' '$row["fld_last_name"]', '$row["fld_phone_number"]', '$row["fld_address"]', '$row["fld_email"]', '$row["fld_password"]', and '$row["fld_rank"]' into the form text boxes ready to be submitted or deleted.  -->
                                <input value="<?php echo $row ['fld_member_id']; ?>"type="text" name="memId"> 
                                <input value="<?php echo $row ['fld_first_name']; ?>"type="text" name="fName"> 
                                <input value="<?php echo $row ['fld_last_name']; ?>"type="text" name="lName"> 
                                <input value="<?php echo $row ['fld_phone_number']; ?>"type="text" name="pNum"> 
                                <input value="<?php echo $row ['fld_address']; ?>"type="text" name="Address"> 
                                <input value="<?php echo $row ['fld_email']; ?>"type="text" name="Email"> 
                                <input value="<?php echo $row ['fld_password']; ?>"type="text" name="Password"> 
                                <input value="<?php echo $row ['fld_rank']; ?>"type="text" name="Rank"> 
                                <!--  This is the Update button named 'submit' -->   
                                <button type="submit" name="submit">Update Member Details</button>
                                <!--  This is the Delete button named 'del'  -->
                                <button type="submit" name="del">Delete Member Details</button>
                            </form>                    
            <?php
                    }
                }
            ?>   
        </div>        
</html>