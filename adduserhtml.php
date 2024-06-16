<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/icon-x" href="cruiseSchoolLogo.jpg">
        <title>Cruise School Add User</title> <!-- Shouldn't this be user specific like 'Abel's Dashboard'-->
        <!--<link rel="stylesheet" href="dashboardStyle.css">-->
        <link rel="stylesheet" href="headerfooterStyle.css">
        <link rel="stylesheet" href="adduserStylex.css">

        <style>
            .error-message {
                color: red;
            }
            .permissionMessage {
                display: none;
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background-color: #4CAF50;
                color: red;
                padding: 20px;
                border-radius: 5px;
                z-index: 1000;
            }
            button a {
                color: #007bff;
                text-decoration: none;
            }
            button a:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
    <div id="allCont">
    <header>
        <!-- Header content such as logo & navigation links-->
        <div class="headercontainer">
            <img src="cruiseSchoolLogo.jpg" alt="Cruise School Logo">
            <h1>Cruise School</h1>
            <button type="button" ><a href="logout.php">Logout</a></button>
        </div>
    </header>
        <div class="container">
            <!-- Sidebar/Navigation Menu -->
            <aside class="sidebar">
                <h2>Navigation</h2>
                <ul>
                    <li><a href="dashboardhtml.php">Dashboard</a></li>
                    <li><a href="studentsmodulehtml.php">Students</a></li>
                    <li><a href="teachersmodulehtml.php">Teachers</a></li>
                    <li><a href="classesmodulehtml.php">Classes</a></li>
                    <li><a href="subjectsmodulehtml.php">Subjects</a></li>
                    <li><a href="attendancemodulehtml.php">Attendance</a></li>
                    <li><a href="gradesmodulehtml.php">Grades</a></li>
                    <li><a href="messagesmodulehtml.php">Messages</a></li>
                    <li><a href="profilesettingspagehtml.php">Profile Settings</a></li>
                </ul>
            </aside>

            <!-- Main Content Area-->
            <main class="main-content">
                <h1>Manage Users</h1>
                <div class="add-user-form">
                        <h2>Add New User</h2>
                        <form id="add-users-form" action="adduserAction.php" name="adduserForm" method="post" target="_self" autocomplete="off">
                            
                            <div class="form-group">
                                <label for="user-name">Full Name:</label>
                                <input type="text" id="user-name" name="user-name" placeholder="i.e. Yohannes Seifu Zeberga" required>
                                <span id="userName-error" class="error-message"></span>
                            </div>
                            
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" id="username" name="username" placeholder="i.e. usryohannes" required>
                                <span id="username-error" class="error-message"></span>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" id="password" name="password" placeholder="i.e. 0112135990a@" required>
                                <br>
                                <span id="password-error" class="error-message"></span>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" placeholder="i.e. yohanneszeberga@gmail.com" required>
                                <br>
                                <span id="email-error" class="error-message"></span>
                            </div>
                            <div class="form-group">
                                <label for="phoneNum">Phone Number:</label>
                                <input type="tel" id="phoneNum" name="phoneNum" placeholder="i.e. 0902173910" required>
                                <span id="phoneNum-error" class="error-message"></span>
                            </div>
                            <div class="form-group">
                                <label for="roleId">Role Id:</label>
                                <input type="text" id="roleId" name="roleId" placeholder="i.e. stu0001">
                                <span id="roleId-error" class="error-message"></span>
                            </div>
                            <button id="adduserbtn" type="submit">Add User</button>
                        </form>
                    </div>
                    <div id="successMessagee1" class="message">
                        User Added Successfully!
                    </div>
                    <div id="successMessagee2" class="message">
                        Role ID Not Found!
                    </div>
            </main>
        </div>
        
        <!-- Footer Section -->
        <footer>
            <div class="container">
                <!-- Add footer content here -->
                <p>&copy; 2024 Cruise School. All rights reserved.</p>
            </div>
        </footer>
        </div>

        <div id="perMessage" class="permissionMessage">
            NO PERMISSION!
        </div>

        <script src="adduserValidationScriptx.js"></script>


        <?php
        if (!isset($_SESSION['allow'])) {
            echo "<script>";
            echo "var all = document.getElementById('allCont');";
            echo "all.style.display='none';";
            echo "var msg = document.getElementById('perMessage');";
            echo "msg.style.display='block';";
            echo "</script>";
        }

        if (isset($_SESSION['validationur'])) {
            //echo "<h1>Hello</h1>";
            //$sucMessage = $_SESSION['successMessage'];
            if ($_SESSION['validationur'] == "OK") {
                echo "<script>";
                    echo "var successMessage = document.getElementById('successMessagee1');";
                    
                    echo "successMessage.style.display = 'block';";
                    // echo "var sucMsg1 = document.getElementById('sucMsg1');";
                    // echo "sucMsg1.display='inline';";
                    echo "setTimeout(hideMessage, 10000);";
                    echo "function hideMessage () {successMessage.style.display = 'none';};";
                echo "</script>";
                
            } else {
                echo "<script>";
                    echo "var successMessage = document.getElementById('successMessagee2');";
                    
                    echo "successMessage.style.display = 'block';";
                    echo "successMessage.style.color='red';";
                    // echo "var sucMsg1 = document.getElementById('sucMsg1');";
                    // echo "sucMsg1.display='inline';";
                    echo "setTimeout(hideMessage, 10000);";
                    echo "function hideMessage () {successMessage.style.display = 'none';};";
                echo "</script>";
            }
            $_SESSION['validationur'] = null;
        }
    ?>
    </body>
</html>

        
    