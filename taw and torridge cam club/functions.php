<?php
    //--------------------  This is the function 'emptyInputSignUp'  --------------------
    // The variables in the parenthesis are passed to the function
    function emptyInputSignUp($varfName, $varlName, $varaddress, $varphoneNum, $varemail, $varpassword, $varrepeatPassword) 
    {
        // This declares the variable '$result' which will hold of the result of the function.
        $result;
        // This 'IF' statement has the pre built PHP function 'empty' within its parenthesis, which determines if data is stored within an element, in this case variable.
        // The 2 pipe symbols '||' are used as an 'OR' statement, meaning if this variable, OR this variable are empty the value is true. 
        // These variables all must be NOT empty to get a return value of false.
        if (empty($varfName) || empty($varlName) || empty($varaddress) || empty($varphoneNum) || empty($varemail) || empty($varpassword) || empty($varrepeatPassword)) 
        { 
            // If there are empty values stored in any of the above variables the value of 'true' is assigned to the variable '$result'.
            $result = true;
        }
        else
        {
            // If there are no empty values stored in any of the above variables the value of 'false' is assigned to the variable '$result'.
            $result= false;
        }
        // This returns the value of the variable $result. 
        return $result;
    }

    //--------------------  This is the function 'invalidEmail'  --------------------
    // The variable in the parenthesis is passed to the function
    function invalidEmail($varemail) 
    {
        // This declares the variable '$result' which will hold of the result of the function.
        $result;
        // This 'IF' statement has the pre built PHP functions 'filter_var' and 'FILTER_VALIDATE_EMAIL' within its parenthesis, which determine if an email is in the correct
        // format, if the email is in the correct format execute the code within the 'IF' statement. 
        // Here this is reversed by using the '!' symbol meaning in this case if the email is NOT in the correct format execute the code in the 'IF statement' reversing the outcome.
        if (!filter_var ($varemail, FILTER_VALIDATE_EMAIL)) 
        {
            // If the email is NOT in the correct format the value of 'true' is assigned to the variable '$result'.
            $result = true;
        }
        else 
        {
            // If the email is in the correct format the value of 'false' is assigned to the variable '$result'.
            $result= false;
        }
        // This returns the value of the variable $result. 
        return $result;
    }

    //--------------------  This is the function 'passwordMatch'  --------------------
    // The variables in the parenthesis are passed to the function
    function passwordMatch($varpassword, $varrepeatPassword) 
    {
        // This declares the variable '$result' which will hold of the result of the function.
        $result;
        // This 'IF' statement declares that if the variable '$varpassword' is not equal to the variable '$varrepeatPassword' execute the code within 
        // the statement.
        if ($varpassword !== $varrepeatPassword) 
        {
            // If the variable '$varpassword' is not equal to the variable '$varrepeatPassword' the value of 'true' is assigned to the variable '$result'.
            $result = true;
        }
        else 
        {
            // If the variable '$varpassword' is equal to the variable '$varrepeatPassword' the value of 'false' is assigned to the variable '$result'.
            $result= false;
        }
        // This returns the value of the variable $result.
        return $result; 
    }

    //--------------------  This is the function 'accountExists'  --------------------
    // The variables in the parenthesis are passed to the function
    function accountExists($conn, $varemail) 
    {
        // This declares the variable '$result' which will hold of the result of the function.
        $result;
        // SQL SELECT statement to select all from the database 'taw_and_torridge_cam_club_db' table 'tbl_members' where the field 'fld_email' is equal to the variable '$varemail'.
        $sql = "SELECT * FROM `tbl_members` WHERE `fld_email` LIKE '".$varemail."'";
        // This passes the variables $conn and $sql to the the function 'mysqli_query' and assigns the result of the query to the variable '$selectResult'
        $selectResult = mysqli_query ($conn, $sql);
        // This 'IF' statement declares that if a result is found execute the code within the 'IF' statement. 
        if ($row = mysqli_fetch_assoc($selectResult))
        {
            // This returns the value of the variable '$row'.
            return $row;                                     
        }
        // This 'ELSE' statement declares that if a result is not found execute the code within the 'ELSE' statement. 
        else 
        {
            // This assigns the value of the variable '$result' to false.
            $result = false;
            // This returns the value of the variable '$result'.
            return $result;
        }
    }

    //--------------------  This is the function 'createUserAccount'  --------------------
    // The variables in the parenthesis are passed to the function
    function createUserAccount($conn, $varfName, $varlName, $varphoneNum, $varaddress, $varemail, $varpassword) 
    { 
        // SQL INSERT INTO statement to insert the values stored in the variables into the 'taw_and_torridge_cam_club_db' database table 'tbl_members' into the specified fields.
        $sql = "INSERT INTO `taw_and_torridge_cam_club_db`.`tbl_members` (`fld_member_id`, `fld_first_name`, `fld_last_name`, `fld_phone_number`, `fld_address`, `fld_email`, `fld_password`, `fld_rank`) 
        VALUES (NULL, '".$varfName."' , '".$varlName."', '".$varphoneNum."' ,  '".$varaddress."' , '".$varemail."' , '".$varpassword."' , 'user')";     
        // This passes the variables $conn and $sql to the the function 'mysqli_query'.
        mysqli_query ($conn, $sql);
        // This places an 'error=none' message in the URL to be retreived with a 'GET' function and redirects to the 'sign_up.php' to display a message.
        header("location: sign_up.php?error=none");
        // This ends the process stopping the script from running.    
        exit();
    }

    //--------------------  This is the function 'adminCreateUserAccount'  --------------------
    // The variables in the parenthesis are passed to the function
    function adminCreateUserAccount($conn, $varfName, $varlName, $varaddress, $varphoneNum, $varemail, $varpassword, $varrank)
    {
        // SQL INSERT INTO statement to insert the values stored in the variables into the 'taw_and_torridge_cam_club_db' database table 'tbl_members' into the specified fields.
        $sql = "INSERT INTO `taw_and_torridge_cam_club_db`.`tbl_members` (`fld_member_id`, `fld_first_name`, `fld_last_name`, `fld_phone_number`, `fld_address`, `fld_email`, `fld_password`, `fld_rank`) 
        VALUES (NULL, '".$varfName."' , '".$varlName."' , '".$varphoneNum."' , '".$varaddress."' , '".$varemail."' , '".$varpassword."' , '".$varrank."')";
        // This passes the variables $conn and $sql to the the function 'mysqli_query'.
        mysqli_query ($conn, $sql);    
        // This places an 'error=none' message in the URL to be retreived with a 'GET' function and redirects to 'memb_man.php' page to display a message.
        header("location: memb_man.php?error=none");
    }

    //--------------------  This is the function 'adminUpdateUserAccount'  --------------------
    // The variables in the parenthesis are passed to the function
    function adminUpdateUserAccount($conn, $varmemId, $varfName, $varlName, $varaddress, $varphoneNum, $varemail, $varpassword, $varrank)
    {
        // SQL UPDATE statement to update the values stored in the specified fields in the 'taw_and_torridge_cam_club_db' database table with the values stored in the variables passed to it.
        $sql = " UPDATE `taw_and_torridge_cam_club_db`.`tbl_members` SET `fld_first_name` = '".$varfName."' , `fld_last_name` = '".$varlName."' , `fld_phone_number` = '".$varphoneNum."' , 
        `fld_address` = '".$varaddress."' , `fld_email` = '".$varemail."' , `fld_password` = '".$varpassword."' , `fld_rank` = '".$varrank."' WHERE `fld_member_id` LIKE '".$varmemId."'";
        // This passes the variables $conn and $sql to the the function 'mysqli_query'.
        mysqli_query ($conn, $sql);
        // This places an 'error=none' message in the URL to be retreived with a 'GET' function and redirects to 'memb_man.php' page to display a message.
        header("location: memb_man.php?error=none");    
    }

    //--------------------  This is the function 'adminDeleteUserAccount'  --------------------
    // The variables in the parenthesis are passed to the function
    function adminDeleteUserAccount($conn, $varmemId)
    {
        // SQL DELETE statement to delete entire row from the 'taw_and_torridge_cam_club_db' database table 'tbl_members' where the field 'fld_member_id' is equal to the variable '$varmemId'.
        $sql = "DELETE FROM `taw_and_torridge_cam_club_db`.`tbl_members` WHERE `fld_member_id` LIKE '" . $varmemId . "'";
        // This passes the variables $conn and $sql to the the function 'mysqli_query'.
        mysqli_query ($conn, $sql);
        // This places an 'error=none' message in the URL to be retreived with a 'GET' function and redirects to 'memb_man.php' page to display a message.
        header("location: memb_man.php?error=none");
    }

    //--------------------  This is the function 'createNewEvent'  --------------------
    // The variables in the parenthesis are passed to the function
    function createNewEvent($conn, $vardate, $varlocation, $varseason) 
    {    
        // SQL INSERT INTO statement to insert the values stored in the variables into the 'taw_and_torridge_cam_club_db' database table 'tbl_events' into the specified fields.
        $sql = "INSERT INTO `taw_and_torridge_cam_club_db`.`tbl_events` (`fld_event_id`, `fld_date`, `fld_location`, `fld_season`) 
        VALUES (NULL, '".$vardate."' , '".$varlocation."', '".$varseason."')";     
        // This passes the variables $conn and $sql to the the function 'mysqli_query'.
        mysqli_query ($conn, $sql);
        // This places an 'error=none' message in the URL to be retreived with a 'GET' function and redirects to 'event_man.php' page to display a message.
        header("location: event_man.php?error=none");
        // This ends the process stopping the script from running.    
        exit();
    }

    //--------------------  This is the function 'registerEventAttendance'  --------------------
    // The variables in the parenthesis are passed to the function
    function registerEventAttendance($conn, $varmemId, $vareveId, $varatt)
    {    
        // SQL INSERT INTO statement to insert the values stored in the variables into the 'taw_and_torridge_cam_club_db' database table 'tbl_event_attendance' into the specified fields.
        $sql = "INSERT INTO `taw_and_torridge_cam_club_db`.`tbl_event_attendance` (`fld_attendance_id`, `fld_attended`, `fld_member_id`, `fld_event_id`) 
        VALUES (NULL, '".$varatt."' , '".$varmemId."', '".$vareveId."')";     
        // This passes the variables $conn and $sql to the the function 'mysqli_query'.
        mysqli_query ($conn, $sql);
        // This places an 'error=none' message in the URL to be retreived with a 'GET' function and redirects to 'event_att.php' page to display a message.
        header("location: event_att.php?error=none");
        // This ends the process stopping the script from running.    
        exit();
    }

    //--------------------  This is the function 'adminUpdateEvent'  --------------------
    // The variables in the parenthesis are passed to the function
    function adminUpdateEvent($conn, $vareveId, $vardate, $varlocation, $varseason)
    {
        // SQL UPDATE statement to update the values stored in the specified fields in the 'taw_and_torridge_cam_club_db' database table with the values stored in the variables passed to it.
        $sql = " UPDATE `taw_and_torridge_cam_club_db`.`tbl_events` SET `fld_date` = '".$vardate."' , `fld_location` = '".$varlocation."' , `fld_season` = '".$varseason."' 
        WHERE `fld_event_id` LIKE '".$vareveId."'";
        // This passes the variables $conn and $sql to the the function 'mysqli_query'.
        mysqli_query ($conn, $sql);
        // This places an 'error=updated' message in the URL to be retreived with a 'GET' function and redirects to 'event_man.php' page to display a message.
        header("location: event_man.php?error=updated");  
    }

    //--------------------  This is the function 'adminUpdateEventAttendance'  --------------------
    // The variables in the parenthesis are passed to the function
    function adminUpdateEventAttendance($conn, $varattId, $varmemId, $vareveId, $varatt)
    {
        // SQL UPDATE statement to update the values stored in the specified fields in the 'taw_and_torridge_cam_club_db' database table with the values stored in the variables passed to it.
        $sql = " UPDATE `taw_and_torridge_cam_club_db`.`tbl_event_attendance` SET `fld_attended` = '".$varatt."' , `fld_member_id` = '".$varmemId."' , `fld_event_id` = '".$vareveId."' 
        WHERE `fld_attendance_id` LIKE '".$varattId."'";
        // This passes the variables $conn and $sql to the the function 'mysqli_query'.
        mysqli_query ($conn, $sql);
        // This places an 'error=updated' message in the URL to be retreived with a 'GET' function and redirects to 'event_att.php' page to display a message.
        header("location: event_att.php?error=updated");  
    }

    //--------------------  This is the function 'adminDeleteEvent'  --------------------
    // The variables in the parenthesis are passed to the function
    function adminDeleteEvent($conn, $vareveId)
    {
        // SQL DELETE statement to delete entire row from the 'taw_and_torridge_cam_club_db' database table 'tbl_events' where the field 'fld_event_id' is equal to the variable '$vareveId'.
        $sql = "DELETE FROM `taw_and_torridge_cam_club_db`.`tbl_events` WHERE `fld_event_id` LIKE '".$vareveId."'";
        // This passes the variables $conn and $sql to the the function 'mysqli_query'.
        mysqli_query($conn, $sql);
        // This places an 'error=deleted' message in the URL to be retreived with a 'GET' function and redirects to 'event_man.php' page to display a message.
        header("location: event_man.php?error=deleted");
    }

    //--------------------  This is the function 'adminDeleteAttendanceRecord'  --------------------
    // The variables in the parenthesis are passed to the function
    function adminDeleteAttendanceRecord($conn, $varattId)
    {
        // SQL DELETE statement to delete entire row from the 'taw_and_torridge_cam_club_db' database table 'tbl_event_attendance' where the field 'fld_attendance_id' is equal to the variable '$varattId'.
        $sql = "DELETE FROM `taw_and_torridge_cam_club_db`.`tbl_event_attendance` WHERE `fld_attendance_id` LIKE '".$varattId."'";
        // This passes the variables $conn and $sql to the the function 'mysqli_query'.
        mysqli_query($conn, $sql);
        // This places an 'error=deleted' message in the URL to be retreived with a 'GET' function and redirects to 'event_att.php' page to display a message.
        header("location: event_att.php?error=deleted");
    }

    //--------------------  This is the function 'createNewComp'  --------------------
    // The variables in the parenthesis are passed to the function
    function createNewComp($conn, $vardate, $varcat)
    {   
        // SQL INSERT INTO statement to insert the values stored in the variables into the 'taw_and_torridge_cam_club_db' database table 'tbl_competitions' into the specified fields.
        $sql = "INSERT INTO `taw_and_torridge_cam_club_db`.`tbl_competitions` (`fld_competition_id`, `fld_date`, `fld_category`) 
        VALUES (NULL, '".$vardate."' , '".$varcat."')";   
        // This passes the variables $conn and $sql to the the function 'mysqli_query'. 
        mysqli_query ($conn, $sql);
        // This places an 'error=none' message in the URL to be retreived with a 'GET' function and redirects to 'comp_man.php' page to display a message.
        header("location: comp_man.php?error=none");
        // This places a 3 second pause on the website so the user can view the message.
        exit();
    }

    //--------------------  This is the function 'adminUpdateComp'  --------------------
    // The variables in the parenthesis are passed to the function
    function adminUpdateComp($conn, $varcompId, $vardate, $varcat)
    {
        // SQL UPDATE statement to update the values stored in the specified fields in the 'taw_and_torridge_cam_club_db' database table with the values stored in the variables passed to it.
        $sql = " UPDATE `taw_and_torridge_cam_club_db`.`tbl_competitions` SET `fld_date` = '".$vardate."' , `fld_category` = '".$varcat."' 
        WHERE `fld_competition_id` LIKE '".$varcompId."'";
        // This passes the variables $conn and $sql to the the function 'mysqli_query'.
        mysqli_query ($conn, $sql);
        // This places an 'error=updated' message in the URL to be retreived with a 'GET' function and redirects to 'comp_man.php' page to display a message.
        header("location: comp_man.php?error=updated");  
    }

    //--------------------  This is the function 'adminDeleteComp'  --------------------
    // The variables in the parenthesis are passed to the function
    function adminDeleteComp($conn, $varcompId)
    {
        // SQL DELETE statement to delete entire row from the 'taw_and_torridge_cam_club_db' database table 'tbl_competitions' where the field 'fld_competition_id' is equal to the variable '$varcompId'.
        $sql = "DELETE FROM `taw_and_torridge_cam_club_db`.`tbl_competitions` WHERE `fld_competition_id` LIKE '".$varcompId."'";
        // This passes the variables $conn and $sql to the the function 'mysqli_query'.
        mysqli_query($conn, $sql);
        // This places an 'error=deleted' message in the URL to be retreived with a 'GET' function and redirects to 'comp_man.php' page to display a message.
        header("location: comp_man.php?error=deleted");
    }

    //--------------------  This is the function 'adminSetCompPlace'  --------------------
    // The variables in the parenthesis are passed to the function
    function adminSetCompPlace($conn, $varresId, $varimgId, $varplace)
    {
        // SQL INSERT INTO statement to insert the values stored in the variables into the 'taw_and_torridge_cam_club_db' database table 'tbl_competition_results' into the specified fields.
        $sql = "INSERT INTO `taw_and_torridge_cam_club_db`.`tbl_competition_results` (`fld_result_id`, `fld_place`, `fld_image_id`) 
        VALUES (NULL, '".$varplace."' , '".$varimgId."')";     
        // This passes the variables $conn and $sql to the the function 'mysqli_query'.
        mysqli_query ($conn, $sql);
        // This places an 'error=placeset' message in the URL to be retreived with a 'GET' function and redirects to 'comp_man.php' page to display a message.
        header("location: comp_man.php?error=placeset");
    }

    //--------------------  This is the function 'adminSetImagePoints'  --------------------
    // The variables in the parenthesis are passed to the function
    function adminSetImagePoints($conn, $varimgId, $varplace)
    {
        // This 'IF' statement declares that if the value of the variable '$varplace' is "1st" execute the code within the 'IF statement'.
        if ($varplace === "1st")
            {
                // SQL UPDATE statement to update the values stored in the specified fields in the 'taw_and_torridge_cam_club_db' database table with the values stored in the variables passed to it.
                $sql = " UPDATE `taw_and_torridge_cam_club_db`.`tbl_images` SET `fld_image_points` = '20' 
                WHERE `fld_image_id` LIKE '".$varimgId."'";
                // This passes the variables $conn and $sql to the the function 'mysqli_query'.
                mysqli_query ($conn, $sql);
                // This places an 'error=updated' message in the URL to be retreived with a 'GET' function and redirects to 'comp_man.php' page to display a message.
                header("location: comp_man.php?error=updated");  
            }
            // This 'ELSEIF' statement declares that if the value of the variable '$varplace' is "2nd" execute the code within the 'ELSEIF statement'.
            elseif ($varplace === "2nd")
            {
                // SQL UPDATE statement to update the values stored in the specified fields in the 'taw_and_torridge_cam_club_db' database table with the values stored in the variables passed to it.
                $sql = " UPDATE `taw_and_torridge_cam_club_db`.`tbl_images` SET `fld_image_points` = '15' 
                WHERE `fld_image_id` LIKE '".$varimgId."'";
                // This passes the variables $conn and $sql to the the function 'mysqli_query'.
                mysqli_query ($conn, $sql);
                // This places an 'error=updated' message in the URL to be retreived with a 'GET' function and redirects to 'comp_man.php' page to display a message.
                header("location: comp_man.php?error=updated");  
            }
            // This 'ELSE' statement declares that if the value of the variable '$varplace' is NOT either "1st" or "2nd" execute the code within the 'ELSE statement'.
            else
            {
                // SQL UPDATE statement to update the values stored in the specified fields in the 'taw_and_torridge_cam_club_db' database table with the values stored in the variables passed to it.
                $sql = " UPDATE `taw_and_torridge_cam_club_db`.`tbl_images` SET `fld_image_points` = '10' 
                WHERE `fld_image_id` LIKE '".$varimgId."'";
                // This passes the variables $conn and $sql to the the function 'mysqli_query'.
                mysqli_query ($conn, $sql);
                // This places an 'error=updated' message in the URL to be retreived with a 'GET' function and redirects to 'comp_man.php' page to display a message.
                header("location: comp_man.php?error=updated");  
            }     
    }

    //--------------------  This is the function 'imageUpload'  --------------------
    // The variables in the parenthesis are passed to the function
    function imageUpload($conn, $image_name, $target_file, $varrand, $memId, $varCompId)
    {
        // SQL INSERT INTO statement to insert the values stored in the variables into the 'taw_and_torridge_cam_club_db' database table 'tbl_images' into the specified fields.
        $sql = "INSERT INTO `taw_and_torridge_cam_club_db`.`tbl_images` (`fld_image_id`, `fld_image_title`, `fld_image_path`, `fld_image_points`, `fld_entry_id`, `fld_member_id`, `fld_competition_id`) 
        VALUES (NULL, '".$image_name."' , '".$target_file."' , '5', '".$varrand."' ,'".$memId."' ,'".$varCompId."')";
        // This passes the variables $conn and $sql to the the function 'mysqli_query'.
        mysqli_query($conn, $sql);
        // This places an 'error=uploaded' message in the URL to be retreived with a 'GET' function and redirects to 'upload.php' page to display a message.
        header("location: upload.php?error=uploaded");    
    }

    //--------------------  This is the function 'adminimageUpload'  --------------------
    // The variables in the parenthesis are passed to the function
    function adminimageUpload($conn, $image_name, $target_file, $varrand, $memId)
    {
        // SQL INSERT INTO statement to insert the values stored in the variables into the 'taw_and_torridge_cam_club_db' database table 'tbl_images' into the specified fields.
        $sql = "INSERT INTO `taw_and_torridge_cam_club_db`.`tbl_images` (`fld_image_id`, `fld_image_title`, `fld_image_path`, `fld_image_points`, `fld_entry_id`, `fld_member_id`, `fld_competition_id`) 
        VALUES (NULL, '".$image_name."' , '".$target_file."' , '5', '".$varrand."' ,'".$memId."' ,'0')";
        // This passes the variables $conn and $sql to the the function 'mysqli_query'.
        mysqli_query($conn, $sql);
        // This places an 'error=uploaded' message in the URL to be retreived with a 'GET' function and redirects to 'image_man.php' page to display a message.
        header("location: image_man.php?error=uploaded");
    }

    //--------------------  This is the function 'adminUpdateImage'  --------------------
    // The variables in the parenthesis are passed to the function
    function adminUpdateImage($conn, $varimgId, $variTitle, $variPath, $variPoints, $varentId, $varmemId, $varcompId)
    {
        // SQL UPDATE statement to update the values stored in the specified fields in the 'taw_and_torridge_cam_club_db' database table with the values stored in the variables passed to it.
        $sql = " UPDATE `taw_and_torridge_cam_club_db`.`tbl_images` SET `fld_image_id` = '".$varimgId."' , `fld_image_title` = '".$variTitle."' , `fld_image_path` = '".$variPath."' , `fld_image_points` = '".$variPoints."' , `fld_entry_id` = '".$varentId."' , `fld_member_id` = '".$varmemId."' , `fld_competition_id` = '".$varcompId."'
        WHERE `fld_image_id` LIKE '".$varimgId."'";
        // This passes the variables $conn and $sql to the the function 'mysqli_query'.
        mysqli_query ($conn, $sql);
        // This places an 'error=updated' message in the URL to be retreived with a 'GET' function and redirects to 'image_man.php' page to display a message.
        header("location: image_man.php?error=updated");
    }

    //--------------------  This is the function 'adminDeleteImage'  --------------------
    // The variables in the parenthesis are passed to the function
    function adminDeleteImage($conn, $varimgId)
    {
        // SQL DELETE statement to delete entire row from the 'taw_and_torridge_cam_club_db' database table 'tbl_images' where the field 'fld_image_id' is equal to the variable '$varimgId'.
        $sql = "DELETE FROM `taw_and_torridge_cam_club_db`.`tbl_images` WHERE `fld_image_id` LIKE '".$varimgId."'";
        // This passes the variables $conn and $sql to the the function 'mysqli_query'.
        mysqli_query($conn, $sql);
        // This places an 'error=deleted' message in the URL to be retreived with a 'GET' function and redirects to 'image_man.php' page to display a message.
        header("location: image_man.php?error=deleted");
    }

    //--------------------  This is the function 'emptyInputLogin'  --------------------
    // The variables in the parenthesis are passed to the function
    function emptyInputLogin($varemail, $varpassword) 
    {
        // This declares the variable '$result' which will hold of the result of the function.
        $result;
        // This 'IF' statement has the pre built PHP function 'empty' within its parenthesis, which determines if data is stored within an element, in this case a variable.
        // The 2 pipe symbols '||' are used as an 'OR' statement, meaning if this variable, OR this variable are empty the value is true. 
        // These variables all must be NOT empty to get a return value of false.
        if (empty($varemail) || empty($varpassword)) 
        {
            // If there are empty values stored in any of the above variables the value of 'true' is assigned to the variable '$result'.
            $result = true;
        } 
        else 
        {
            // If there are no empty values stored in any of the above variables the value of 'false' is assigned to the variable '$result'.
            $result= false;
        }
        // This returns the value of the variable '$result'.
        return $result;
    }

    //--------------------  This is the function 'loginUser'  --------------------
    // The variables in the parenthesis are passed to the function
    function loginUser($conn, $varemail, $varpassword) 
    {
        $result;
        // SQL SELECT statement to select all from the database 'taw_and_torridge_cam_club_db' table 'tbl_members' where the field 'fld_email' is equal to the variable '$varemail' and the field 'fld_password' is equal to the variable '$varpassword'.
        $sql = "SELECT * FROM `tbl_members` WHERE `fld_email` LIKE '".$varemail."' AND `fld_password` LIKE '".$varpassword."'";
        // This passes the variables $conn and $sql to the the function 'mysqli_query' and assigns the result of the query to the variable '$result'
        $result = mysqli_query ($conn, $sql);
        // This declares that the number of rows found in the variable '$result' will be assigned to the variable '$row)count'
        $row_count = mysqli_num_rows($result);
        if($row_count > 0)
        {
            // This places an 'error=success' message in the URL to be retreived with a 'GET' function and redirects to 'main.php' page to display a message.
            header("location: main.php?error=success");
            // This ends the process stopping the script from running.    
            exit(); 
        }
        else
        {
            // This places an 'error=norecordfound' message in the URL to be retreived with a 'GET' function and redirects to 'login.php' page to display a message.
            header("location: login.php?error=norecordfound");
            // This ends the process stopping the script from running.    
            exit();
        }
    }

    //--------------------  This is the function 'check_login'  --------------------
    // The variables in the parenthesis are passed to the function
    function check_login($conn)
    {
        // This 'IF' statement determines if SESSION is set and if there the value 'fld_first_name' is stored in it.
        if(isset($_SESSION['fld_first_name']))
        {
            // If SESSION is set with the value 'fld_first_name' stored in it, assign that value to the variable '$fName'.
            $name = $_SESSION['fld_first_name'];
            // SQL SELECT statement to select all from the database 'taw_and_torridge_cam_club_db' table 'tbl_members' where the field 'fld_first_name' is equal to the variable '$varname', limited to 1 result.
            $sql = "SELECT * FROM `tbl_members` WHERE `fld_first_name` LIKE '$name' limit 1";
            // This passes the variables $conn and $sql to the the function 'mysqli_query' and assigns the result of the query to the variable '$result'
            $result = mysqli_query($conn, $sql);
            // If the result and number of rows is greater than zero execute the code in the statement.
            if($result && mysqli_num_rows($result) > 0)
            {
                // This assigns the result of the query as an associative array to the variable '$user_data'.
                $user_data = mysqli_fetch_assoc($result);
                // This returns the value of the variable 'user_data'.
                return $user_data;
            }
        }
    
        // This places an 'error=nosessionfound' message in the URL to be retreived with a 'GET' function and redirects to 'login.php' page to display a message.
        header("location: login.php?error=nosessionfound");
        // This ends the process stopping the script from running.        
        exit;
    }

    //--------------------  This is the function 'set_session_variables'  --------------------
    // The variables in the parenthesis are passed to the function
    function set_session_variables($conn, $varemail, $varpassword)
    {
        // SQL SELECT statement to select all from the database 'taw_and_torridge_cam_club_db' table 'tbl_members' where the field 'fld_email' is equal to the variable '$varemail'.
        $sql = "SELECT * FROM  `tbl_members` WHERE `fld_email` LIKE '".$varemail."'";
        // This passes the variables $conn and $sql to the the function 'mysqli_query' and assigns the result of the query to the variable '$result'
        $result = mysqli_query($conn, $sql);
        if ($result) {
            // This 'IF' statement declares that if the value of the variable '$result' and the number of rows is greater than zero execute the code within the statement.
            if ($result && mysqli_num_rows($result) > 0) {
                // This assigns the result of the query as an associative array to the variable '$user_data'.
                $user_data = mysqli_fetch_assoc($result);
                // This 'IF' statement declares that if the value of the variable '$user_data['fld_password']' is equal to the value of the variable '$varpassword' execute the code within the statement.
                if ($user_data['fld_password'] === $varpassword) 
                {
                    //This sets various values from the query as 'Super Global' session variables to be used throughout the application.
                    $_SESSION['fld_member_id'] = $user_data['fld_member_id'];
                    $_SESSION['fld_first_name'] = $user_data['fld_first_name'];
                    $_SESSION['fld_rank'] = $user_data['fld_rank'];
                }
            }
        }
    }

    //--------------------  This is the function 'rank_nav_bar'  --------------------
    function rank_nav_bar()
    {
        // This 'IF' statement declares that if SESSION is set and there is a value stored in '$_SESSION[fld_rank]' execute the code within the statement.
        if(isset($_SESSION['fld_rank']))
        {
            // This declares the variable '$rank' and assigns the value of the variable '$_SESSION['fld_rank']' to it.
            $rank = $_SESSION['fld_rank'];
            
             // This 'IF' statement declares that if the value contained in the variable '$rank' is "admin" execute the code within the 'IF' statement.
            if ( $rank === "admin")
            {
                // This will include the Admins navigation bar.
                include_once 'admin_nav.php';
            }
            // This 'ELSEIF' statement declares that if the value contained in the variable '$rank' is "secretary" execute the code within the 'ELSEIF' statement.
            elseif ($rank === "secretary")
            {
                // This will include the Secretaries navigation bar.
                include_once 'secr_nav.php';
            }
            // This 'ELSE' statement declares that if the value contained in the variable '$rank' is not "admin or ""secretary" execute the code within the 'ELSE' statement.
            else
            {
                // This will include the Users or Members navigation bar.
                include_once 'user_nav.php';
            }
        } 
    }

    //--------------------  This is the function 'not_signed_in_nav_bar'  --------------------
    // The variables in the parenthesis are passed to the function
    function not_signed_in_nav_bar()
    {   
        // This 'IF' statement declares that if SESSION is NOT set and there is NOT a value stored in '$_SESSION[fld_rank]' execute the code within the statement.
        if (!isset($_SESSION['fld_rank']))
            {
                // This will include the Users or Members navigation bar.
                include_once 'user_nav.php';
            }
    }

    //--------------------  This is the function 'admin_rank_check'  --------------------
    function admin_rank_check()
    {
        // This 'IF' statement declares that if SESSION is set and there is a value stored in '$_SESSION[fld_rank]' execute the code within the statement.
        if(isset($_SESSION['fld_rank']))
        {
            // This declares the variable '$rank' and assigns the value of the variable '$_SESSION['fld_rank']' to it.
            $rank = $_SESSION['fld_rank'];
            
            // This 'IF' statement declares that if the value contained in the variable '$rank' is NOT "admin" execute the code within the statement.
            if ( $rank != "admin")

            {
                // This places an 'error=wronrank' message in the URL to be retreived with a 'GET' function and redirects to 'main.php' page to display a message.
                header("location: main.php?error=wrongrank");
            }               
        } 
    }

    //--------------------  This is the function 'secr_rank_check'  --------------------
    function secr_rank_check()
    {
        // This 'IF' statement declares that if SESSION is set and there is a value stored in '$_SESSION[fld_rank]' execute the code within the statement.
        if(isset($_SESSION['fld_rank']))
        {
            // This declares the variable '$rank' and assigns the value of the variable '$_SESSION['fld_rank']' to it.
            $rank = $_SESSION['fld_rank'];
            
            // This 'IF' statement declares that if the value contained in the variable '$rank' equals "user" execute the code within the statement.
            if ( $rank == "user")
            {
                // This places an 'error=wronrank' message in the URL to be retreived with a 'GET' function and redirects to 'main.php' page to display a message.
                header("location: main.php?error=wrongrank");
            }       
        } 
    }

    //--------------------  This is the function 'sign_log_but'  --------------------
    function sign_log_but()
    {        
        // This 'IF' statement declares that if SESSION is set execute the code within the statement.
        if(isset($_SESSION))
            {
                // This is the nav bar logout button.
                ?><li style="float:right"><a href="logout.php" style="color: white">Logout</style></a></li><?php
            }
            else
            {
                // This is the nav bar sign up button.
                ?><li style="float:right"><a href="sign_up.php" style="color: white">Sign Up</style></a></li><?php
            }                          
    }

    //--------------------  This is the function 'rand_num'  --------------------
    function rand_num()
    {
        // This is the PHP random number function.
        random_int(1, 9999999);
    }

    //--------------------  This is the function 'set_comp_session'  --------------------
    function set_comp_session($conn, $varCompId)
    {   
        // This assigns the value of the variable '$varCompId' to the 'Super Global' session variable '$_SESSION['fld_competition_id']'.
        $_SESSION['fld_competition_id'] = $varCompId;
    } 

    //--------------------  This is the function 'competitionvoting'  --------------------
    // The variables in the parenthesis are passed to the function
    function competitionvoting ($conn, $varimgId, $varmemId, $varcompId)
    {
        // This determines if the user has already voted in this competition //
        // SQL SELECT statement to select all from the database 'taw_and_torridge_cam_club_db' table 'tbl_vote_record' where the field 'fld_member_id' is equal to the variable '$varmemId' and the field 'fld_competition_id' is equal to the variable '$varcompId'.
        $sql = "SELECT * FROM  `tbl_vote_record` WHERE `fld_member_id` LIKE '".$varmemId."' AND  `fld_competition_id` LIKE '".$varcompId."' ";
        // This passes the variables $conn and $sql to the the function 'mysqli_query' and assigns the result of the query to the variable '$result'
        $result = mysqli_query($conn, $sql);
        if ($result) 
        {
            // This 'IF' statement declares that if the value of the variable '$result' and the number of rows is greater than zero execute the code within the 'IF' statement. 
            if ($result && mysqli_num_rows($result) > 0) 
            {
                // This places an 'error=alreadyvoted' message in the URL to be retreived with a 'GET' function and redirects to 'main.php' page to display a message.
                header("location: main.php?error=alreadyvoted");
            }            
            else
            {
                // SQL INSERT INTO statement to insert the values stored in the variables into the 'taw_and_torridge_cam_club_db' database table 'tbl_vote_record' into the specified fields preventing the user from voting in the same competition again.
                $sql = "INSERT INTO `taw_and_torridge_cam_club_db`.`tbl_vote_record` (`fld_vote_rec_id`, `fld_voted`, `fld_member_id`, `fld_competition_id`) 
                VALUES (NULL, 'Yes' , '".$varmemId."', '".$varcompId."')";    
                // This passes the variables $conn and $sql to the the function 'mysqli_query' and assigns the result of the query to the variable '$result' 
                $result = mysqli_query ($conn, $sql);                

                // This selects the image being voted for from the database //
                // SQL SELECT statement to select all from the database 'taw_and_torridge_cam_club_db' table 'tbl_images' where the field 'fld_competition_id' is equal to the variable '$varcompId' and the field 'fld_image_id' is equal to the variable '$varimgId'.
                $sql = "SELECT * FROM  `tbl_images` WHERE `fld_competition_id` LIKE '".$varcompId."' AND `fld_image_id` LIKE '".$varimgId."'";
                // This passes the variables $conn and $sql to the the function 'mysqli_query' and assigns the result of the query to the variable '$result'
                $result = mysqli_query($conn, $sql);
                // This retreives an associative array from the results of the query and assigns its value to the variable '$data'.
                $data = mysqli_fetch_assoc($result);
                // This retreives the value of the 'fld_image_votes' and assigns it to the variable '$votes' //
                $votes = $data['fld_image_votes'];
                // This adda 1 to the variable '$votes'                
                $votes += 1;

                // SQL UPDATE statement to update the values stored in the specified fields in the 'taw_and_torridge_cam_club_db' database table with the values stored in the variables passed to it.
                $sql = " UPDATE `taw_and_torridge_cam_club_db`.`tbl_images` SET `fld_image_votes` = '".$votes."' 
                WHERE `fld_competition_id` LIKE '".$varcompId."' AND `fld_image_id` LIKE '".$varimgId."'";
                // This passes the variables $conn and $sql to the the function 'mysqli_query'.
                mysqli_query ($conn, $sql);
                // This places an 'error=voteregistered' message in the URL to be retreived with a 'GET' function and redirects to 'main.php' page to display a message.
                header("location: main.php?error=voteregistered");
            }
        }  
    }