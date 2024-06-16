<?php
    session_start();
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/icon-x" href="cruiseSchoolLogo.jpg">
        <title>Cruise School Students</title>
        <link rel="stylesheet" href="studentsmoduleStyle.css">
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
                <button type="button"><a href="logout.php">Logout</a></button>
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

            <!-- Main Content Area -->
            <main class="main-content">
                <h1>Manage Students</h1>
                <!-- Add Student Form -->
                <div class="add-student-form">
                    <h2>Add New Student</h2>
                    <form id="add-students-form" action="studentsmoduleForm.php" name="addstudentForm" method="post" target="_self" autocomplete="off">
                        
                        <div class="form-group">
                            <label for="student-name">Full Name:</label>
                            <input type="text" id="student-name" name="student-name" placeholder="i.e. Mikiyas Sintayehu Sanford" required>
                            <span id="studentName-error" class="error-message"></span>
                        </div>
                        
                        <div class="form-group">
                            <label for="addmissionNum">Addmission Number:</label>
                            <input type="text" id="addmissionNum" name="addmissionNum" placeholder="i.e. AdmNum0002" required>
                            <span id="addmissionNum-error" class="error-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="DoB">Date Of Birth:</label>
                            <input type="date" id="DoB" name="DoB" required>
                            <br>
                            <span id="DoB-error" class="error-message"></span>
                        </div>
                        <div class="form-group">
                            <label>Gender:</label>
                            <label>
                                <input type="radio" name="gender" value="M" required>Male
                            </label>
                            <label>
                                <input type="radio" name="gender" value="F" required>Female
                            </label>
                            <span id="gender-error" class="error-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="addresss">Address:</label>
                            <input type="text" id="addresss" name="addresss" placeholder="i.e. Debrezeit" required>
                            <span id="address-error" class="error-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="guardianName">Guardian Name:</label>
                            <input type="text" id="guardianName" name="guardianName" placeholder="i.e. Sintayehu Sanford">
                            <span id="guardianName-error" class="error-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="guardianPhone">Guardian Phone Number:</label>
                            <input type="tel" id="guardianPhone" name="guardianPhone" placeholder="i.e. 0912967929">
                            <br>
                            <span id="guardianPhone-error" class="error-message"></span>
                        </div>
                        <!--<div class="form-group">
                            <label for="student-id">Student ID:</label>
                            <input type="text" id="student-id" name="student-id" placeholder="i.e. ECS/440" required>
                            <span id="studentId-error" class="error-message"></span>
                        </div>-->
                        <div class="form-group">
                            <label for="user-id">User ID:</label>
                            <input type="text" id="user-id" name="user-id" placeholder="i.e. usr0002" required>
                            <span id="userId-error" class="error-message"></span>
                        </div>
                        <button id="addStudentbtn" type="submit">Add Student</button>
                    </form>
                </div>

                <!-- Student Records Table -->
                <div class="student-records">
                    <h2>Student Records</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <!-- Add more columns as needed -->
                                <th>Student ID</th>
                                <th>Addmission Number</th>
                                <th>Birthdate</th>
                                <th>Gender</th>
                                <th>Address</th>
                                <th>Guardian</th>
                                <th>Guardian Phone No.</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Displaying student records here -->
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

                                $sql = "SELECT Fname,Mname,Lname,studentId,addmissionNum,DoB,gender,addresss,guardianName,guardianPhone FROM tblstudents";
                                $results = $conn->query($sql);

                                if ($results->num_rows > 0) {
                                    while ($row = $results->fetch_assoc()) {
                                        echo "<tr>";
                                            echo "<td>".$row['Fname']." ".$row['Mname']." ".$row['Lname']."</td>";
                                            echo "<td>".$row['studentId']."</td>";
                                            echo "<td>".$row['addmissionNum']."</td>";
                                            echo "<td>".$row['DoB']."</td>";
                                            echo "<td>".$row['gender']."</td>";
                                            echo "<td>".$row['addresss']."</td>";
                                            echo "<td>".$row['guardianName']."</td>";
                                            echo "<td>".$row['guardianPhone']."</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr>";
                                        echo "<td style='text-align:center;' colspan='3'>No Record Found</td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div id="successMessage1" class="message">
                    Student Added Successfully!
                </div>
                <div id="successMessage2" class="message">
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

        <script src="studentsmoduleValidationScripty.js"></script>

        <?php
            if (!isset($_SESSION['allow'])) {
                echo "<script>";
                echo "var all = document.getElementById('allCont');";
                echo "all.style.display='none';";
                echo "var msg = document.getElementById('perMessage');";
                echo "msg.style.display='block';";
                echo "</script>";
            }

            if (isset($_SESSION['validation'])) {
                //$sucMessage = $_SESSION['successMessage'];
                if ($_SESSION['validation'] == "OK") {
                    echo "<script>";
                        echo "var successMessage = document.getElementById('successMessage1');";
                        
                        echo "successMessage.style.display = 'block';";
                        // echo "var sucMsg1 = document.getElementById('sucMsg1');";
                        // echo "sucMsg1.display='inline';";
                        echo "setTimeout(hideMessage, 10000);";
                        echo "function hideMessage () {successMessage.style.display = 'none';};";
                    echo "</script>";
                    
                } else {
                    echo "<script>";
                        echo "var successMessage = document.getElementById('successMessage2');";
                        
                        echo "successMessage.style.display = 'block';";
                        echo "successMessage.style.color='red';";
                        // echo "var sucMsg1 = document.getElementById('sucMsg1');";
                        // echo "sucMsg1.display='inline';";
                        echo "setTimeout(hideMessage, 10000);";
                        echo "function hideMessage () {successMessage.style.display = 'none';};";
                    echo "</script>";
                }
                $_SESSION['validation'] = null;
            }
        ?>
    </body>
</html>