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

    // This assigns the value of the super gloabl session variable '$_SESSION['fld_member_id']' to the variable '$memId'
    $memId = $_SESSION['fld_member_id'];

    // This assigns the value of the super gloabl session variable '$_SESSION['fld_competition_id']' to the variable '$varCompId'
    $varCompId = $_SESSION['fld_competition_id'];

    // This assigns the resulting value of the PHP function '$random_int' to the variable '$varrand'
    $varrand = random_int(1, 9999999); 
                                
    // This declares the directory the image file is to be uploaded into
    $target_dir = "images/";

    // This assigns the value POSTED to this page using '$_POST' method to the variable '$image_name'.
    $image_name = $_POST['imageName'];

    // This concatenates all these values together to create one long string resulting in the file directory path which is then assigned to the variable '$target_file'.
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]); 

    // This assigns the value of the variable '$_FILES['fileToUpload']' to the variable '$file'.
    $file = $_FILES['fileToUpload'];

    // This declares the variable $upLoadOK and assigns the value of 1 to it.
    $upLoadOK = 1; 

    // This determines what format the file being uploaded is (jph, png, etc...) and converts the file directory path into all lower case and assigns the resulting value into the variable '$imageFileType'.
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); 

    // This 'IF' statement determines the the maximum file size able to be uploaded. If the file size is equal to or larger than 1000000 execute the code within the 'IF' statement.
    if($_FILES["fileToUpload"]["size"] >= 1000000) 
    {
        echo "File is too large. ";
        $upLoadOK = 0;
        header("location: upload.php?error=tobig");
    }
    //If the file size is not equal to or larger than 1000000 execute the code within the 'ELSE' statement.
    else
    {
         // This 'IF' statement declares that if move 'move_uploaded_file' function has been executed within the specified parameters in the parenthesis execute the code within the statement.
        if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
        {
            // This redirects the user to the 'image_man.php' page with the 'uploaded' text in the URL to be retreived using a GET method.
            header("location: upload.php?error=uploaded");        
        } 
    }

    //--------------------  Reference to 'imageUpload' function on 'functions.php'  --------------------
    imageUpload($conn, $image_name, $target_file, $varrand, $memId, $varCompId)