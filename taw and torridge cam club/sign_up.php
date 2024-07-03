<!-- Basic parameters for HTML -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Sign Up</title>
        <!--------------------  Reference to custom CSS framework  -------------------->
        <link href="css/new_style.css" rel="stylesheet">         
        <!--------------------  Reference to Bootstrap Javascript framework  -------------------->
        <script src="js/bootstrap_bundle_min.js"></script>
    </head>
    <body>
        <!--------------------  Navigation Bar  -------------------->
        <?php
        // This includes the 'user_nav.php' file.
        include 'user_nav.php';
        ?>
        <div class="wrapper">   
          <h1>Taw and Torridge Camera Club</h1>
        <!--------------------  Sign Up Form Box, POSTS values to 'sign_up_process.php'  -------------------->
                    <div class="sign_up_form-box">		
                          <h2>Sign Up</h2>
                          <form action="sign_up_process.php" method="post">
                            <input placeholder="First Name" type="text" name="fName"> 
                            <input placeholder="Last Name" type="text" name="lName">
                            <input placeholder="Phone Number" type="text" name="pNum"> 
                            <input placeholder="Address" type="text" name="Address">  
                            <input placeholder="Email" type="text" name="Email"> 
                            <input placeholder="Password" type="password" name="Password"> 
                            <input placeholder="Repeat Password" type="password" name="RepeatPassword"> 
                            <button type="submit" name="submit">Sign Up</button>
                          </form><br>
                          <a style="color: white" href="login.php">Login</a?>
        <!---------------  This is the login feed back Div which uses the 'GET' method to retreive error messages from the URL sent from the functions page  --------------->
                          <div class="feedback">    
                              <?php
                                  if (isset($_GET["error"])) {
                                    if ($_GET["error"] == "emptyinput") {
                                      echo "<h2>Please fill in all fields</h2>";
                                    }
                                    else if ($_GET["error"] == "invalidemail") {
                                      echo "<h2>Invalid email</h2>";
                                    }
                                    else if ($_GET["error"] == "passwordsdontmatch") {
                                      echo "<h2>Passwords dont match</h2>";
                                    }
                                    else if ($_GET["error"] == "accountExists") {
                                      echo "<h2>Account already exists</h2>";
                                    }
                                    else if ($_GET["error"] == "none") {                                        
                                      echo "<h2>You have signed up!</h2>";
                                      sleep(3);
                                    }
                                  }
                                ?> 
                          </div>                                     
                  </div>                    
          </div>            
     </body>
</html>
