<html>
    <head> 
    </head>
    <body>
            <!---This is a basic nav bar ----->
            <div class="icon">
                <a href="main.php" ><img src="ttcc_logo.png" alt="TTCC Logo"></a>
            </div>
        <section class="top-nav">        
            <input id="menu-toggle" type="checkbox" />
            <label class='menu-button-container' for="menu-toggle">
                <div class='menu-button'></div>
            </label>
            <ul class="menu">
                <li class="dropdown">
                        <a href="javascript:void(0)" class="dropbtn" style="color: red">Secretary Functions</a>
                        <div class="dropdown-content">
                        <a href="image_man.php" style="color: red">Image Management</style></a>
                        <a href="event_man.php" style="color: red">Event Management</style></a>
                        <a href="event_att.php" style="color: red">Event Attendance</style></a>
                        </div>
                </li>          
                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropbtn" style="color: white">Member Portfolios</a>
                    <div class="dropdown-content">
                    <a href="a_alderson_port.php" style="color: white">Alan Alderson</a>
                    <a href="b_banner_port.php" style="color: white">Bruce Banner</a>
                    <a href="c_chaplin_port.php" style="color: white">Charlie Chaplin</a>
                    </div>
                </li>
                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropbtn" style="color: white">Competitions</a>
                    <div class="dropdown-content">
                    <a href="comp_1.php" style="color: white">Sea Scape</a>
                    <a href="comp_2.php" style="color: white">Night Sky</a>
                    <a href="comp_3.php" style="color: white">Wildlife</a>
                    <a href="comp_4.php" style="color: white">Landscape</a>
                    </div>
                </li>
                <li><a href="comp_results.php" style="color: white">Competition Results</style></a></li>
                <li><a href="events.php" style="color: white">Event Schedule</style></a></li>
                <li><a href="league.php" style="color: white">League</style></a></li>
                <li><a href="gallery.php" style="color: white">Full Gallery</style></a></li>
                <li><a href="bio.php" style="color: white">Bio</style></a></li>
            </ul>
        </section>
        <div class="in-out">
        <?php
            // Link to 'functions.php' containing all the application functions.
            // 'require_once' is used instead of 'include' as the require function is designed for when the file is required by your application
            // such as an important file containing configuration variables, without which the application would break. Whereas include is used to 
            // include files that the application flow would continue when not found, such as templates. 
            require_once 'functions.php';
            //--------------------  Reference to 'sign_log_but' function on 'functions.php'  --------------------
            sign_log_but();
            ?>     
        </div>
    </body>
 </html>