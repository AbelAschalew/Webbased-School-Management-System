<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/icon-x" href="cruiseSchoolLogo.jpg">
    <title>Cruise School Teachers</title>
    <link rel="stylesheet" href="teachersmoduleStyle.css"> 
    <link rel="stylesheet" href="headerfooterStyle.css">

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
        <div class="headercontainer">
            <img src="cruiseSchoolLogo.jpg" alt="Cruise School Logo">
            <h1>Cruise School</h1>
            <button type="button" onclick="logOut()"><a href="logout.php">Logout</a></button>
        </div>
    </header>

    <div class="container">
        <!-- Sidebar/Navigation Menu-->
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
                <!--<li><a href="messagesmodulehtml.php">Messages</a></li>
                <li><a href="profilesettingspagehtml.php">Profile Settings</a></li>-->
            </ul>
        </aside>

        <!-- Main Content Area-->   
        <main class="main-content">
            <h1>Manage Teachers</h1>

            <!-- Add Teacher Form-->
            <div class="add-teacher-form">
                <h2>Add New Teacher</h2>
                <form id="add-teachers-form" action="addteacherForm.php" name="addteacherForm" method="post" target="_self" autocomplete="off">
                    <div class="form-group">
                        <label for="teacher-name">Full Name:</label>
                        <input type="text" id="teacher-name" name="teacher-name" placeholder="i.e. Tewedaj Getahun Yemane" required>
                        <span id="teacherName-error" class="error-message"></span>
                    </div>
                    
                    <div class="form-group">
                        <label for="qualification">Qualification:</label>
                        <input type="text" id="qualification" name="qualification" placeholder="i.e. CS Degree" required>
                        <span id="qualification-error" class="error-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="experience">Years of Experience:</label>
                        <input type="number" id="experience" name="experience" placeholder="i.e. 5" required>
                        <span id="experience-error" class="error-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="department">Department:</label>
                        <select id="department" name="department"   >
                            <option value="dept001">Mathematics</option>
                            <option value="dept002" selected>Science</option>
                            <option value="dept003">Language Arts</option>
                            <option value="dept004">Social Studies</option>
                            <option value="dept005">Arts</option>
                            <option value="dept006">Physical Education</option>
                            <option value="dept007">Technology</option>
                            <option value="dept008">Special Education</option>
                            <option value="dept009">Vocational Training</option>
                        </select>
                        <span id="department-error" class="error-message"></span>
                        <div class="form-group">
                            <label for="user-id">User ID:</label>
                            <input type="text" id="user-id" name="user-id" placeholder="i.e. usr0002" required>
                            <span id="userId-error" class="error-message"></span>
                        </div>
                    </div>
                    <button id="addTeacherbtn" type="submit">Add Teacher</button>
                </form>
            </div>

            <!-- Teacher Records Table -->
            <div class="teacher-records">
                <h2>Teacher Records</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <!-- Add more columns as needed -->
                            <th>ID</th>
                            <th>Qualification</th>
                            <th>Experience (Years)</th>
                            <th>Department</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            // Establishing connection to database
                            $server = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "dbcruiseschool";
                            $conn = new mysqli($server, $username, $password, $dbname);

                            if ($conn->connect_error) {
                                echo "Connection Error!<br>";
                                $conn->close();
                                exit();
                            }

                            $sql = "SELECT Fname,Mname,Lname,teacherId,qualification,experience,deptId FROM tblteachers";
                            $results = $conn->query($sql);

                            if ($results->num_rows > 0) {
                                while ($row = $results->fetch_assoc()) {
                                    echo "<tr>";
                                        echo "<td>".$row['Fname']." ".$row['Mname']." ".$row['Lname']."</td>";
                                        echo "<td>".$row['teacherId']."</td>";
                                        echo "<td>".$row['qualification']."</td>";
                                        echo "<td>".$row['experience']."</td>";
                                        echo "<td>".$row['deptId']."</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr>";
                                    echo "<td style='text-align:center;' colspan='5'>No Record Found!</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div id="successMessag1" class="message">
                Student Added Successfully!
            </div>
            <div id="successMessag2" class="message">
                User Id doesn't Exist!
            </div>
        </main>
    </div>
    <!-- Footer Section -->
    <footer>
        <div class="container">
            
            <p>&copy; 2024 Cruise School. All rights reserved.</p>
        </div>
    </footer>
</div>
    <div id="perMessage" class="permissionMessage">
        NO PERMISSION!
    </div>

    <script src="teachersmoduleValidationScriptz.js"></script>

    <?php
        if (!isset($_SESSION["allow"])) {
            echo "<script>";
            echo "var all = document.getElementById('allCont');";
            echo "all.style.display='none';";
            echo "var msg = document.getElementById('perMessage');";
            echo "msg.style.display='block';";
            echo "</script>";
        }
        
        if (isset($_SESSION['validationt'])) {
            if ($_SESSION['validationt'] == "OK") {
                echo "<script>";
                    echo "var successMessage = document.getElementById('successMessag1');";
                    
                    echo "successMessage.style.display = 'block';";
                    // echo "var sucMsg1 = document.getElementById('sucMsg1');";
                    // echo "sucMsg1.display='inline';";
                    echo "setTimeout(hideMessage, 10000);";
                    echo "function hideMessage () {successMessage.style.display = 'none';};";
                echo "</script>";
                
            } else {
                echo "<script>";
                    echo "var successMessage = document.getElementById('successMessag2');";
                    
                    echo "successMessage.style.display = 'block';";
                    echo "successMessage.style.color='red';";
                    // echo "var sucMsg1 = document.getElementById('sucMsg1');";
                    // echo "sucMsg1.display='inline';";
                    echo "setTimeout(hideMessage, 10000);";
                    echo "function hideMessage () {successMessage.style.display = 'none';};";
                echo "</script>";
            }
            $_SESSION['validationt'] = null;
        }
    ?>
</body>
</html>