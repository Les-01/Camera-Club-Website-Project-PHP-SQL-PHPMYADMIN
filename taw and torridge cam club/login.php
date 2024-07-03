<!-- Basic parameters for HTML -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
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
        <!--------------------  Login Form Box, POSTS values to 'login_process.php'  -------------------->
            <div class="login_form-box">		                    
                    <h2>Login</h2>
                    <form action="login_process.php" method="post">
                    <input placeholder="Email" type="text" name="Email"> 
                    <input placeholder="Password" type="password" name="Password"> 
                    <button type="submit" name="submit">Login</button>
                    </form><br>
                    <a style="color: white" href="sign_up.php">Sign Up</a?>
        <!---------------  This is the login validation feed back Div which uses the 'GET' method to retreive error messages from the URL sent from the functions page  --------------->
                    <div class="feedback">    
                        <?php
                            if (isset($_GET["error"])) {
                              if ($_GET["error"] == "emptyinput") {
                                echo "<h2>Please fill in all fields</h2>";
                              }                               
                              else if ($_GET["error"] == "norecordfound") {
                                echo "<h2>Incorrect email or Password</h2>";
                              }       
                            }
                          ?> 
                      </div>                    
                </div>  
          </div>      
      </body>
</html>