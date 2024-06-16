<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/icon-x" href="cruiseSchoolLogo.jpg">
    <title>Cruise School Subjects</title>
    <link rel="stylesheet" href="subjectsmoduleStyle.css">
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
                <!--<li><a href="messagesmodulehtml.php">Messages</a></li>
                <li><a href="profilesettingspagehtml.php">Profile Settings</a></li>-->
            </ul>
        </aside>

        <!-- Main Content Area -->
        <main class="main-content">
            <h1>Manage Subjects</h1>

            <!-- Add Subject Form -->
            <div class="add-subject-form">
                <h2>Add New Subject</h2>
                <form id="add-subjects-form" action="addsubjectAction.php" name="addsubjectForm" method="post" target="_self" autocomplete="off">
                    <div class="form-group">
                        <label for="subjectName">Subject Name:</label>
                        <input type="text" id="subjectName" name="subjectName" placeholder="i.e. Physics" required>
                        <span id="subjectName-error" class="error-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="teacherName">Subject Teacher:</label>
                        <input type="text" id="teacherName" name="teacherName" placeholder="i.e. Natol Degefu Woyessa" required>
                        <span id="teacherName-error" class="error-message"></span>
                    </div>
                    
                    <button id="addSubjectbtn" type="submit">Add Subject</button>
                </form>
            </div>

            <!-- Subject Records Table -->
            <div class="subject-records">
                <h2>Subject Records</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Subject Name</th>
                            <th>Subject Teacher</th>
                            
                            <th>Subject ID</th>
                            <th>Teacher ID</th>
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

                            $sql = "SELECT S.subjectId,S.subjectName,S.teacherId,T.Fname,T.Mname,T.Lname FROM tblsubjects AS S INNER JOIN tblteachers AS T ON S.teacherId = T.teacherId";
                            $results = $conn->query($sql);

                            if ($results->num_rows > 0) {
                                while ($row = $results->fetch_assoc()) {
                                    echo "<tr>";
                                        echo "<td>".$row['subjectName']."</td>";
                                        echo "<td>".$row['Fname']." ".$row['Mname']." ".$row['Lname']."</td>";
                                        echo "<td>".$row['subjectId']."</td>";
                                        echo "<td>".$row['teacherId']."</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td style='text-align:center;' colspan='4'>No Record Found</td></tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div id="successMessage1" class="message">
                Subject Added Successfully!
            </div>
            <div id="successMessage2" class="message">
                Teacher doesn't Exist!
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

    <script src="subjectsmoduleValidationScriptx.js"></script>


    <?php
        if (!isset($_SESSION['allow'])) {
            echo "<script>";
            echo "var all = document.getElementById('allCont');";
            echo "all.style.display='none';";
            echo "var msg = document.getElementById('perMessage');";
            echo "msg.style.display='block';";
            echo "</script>";
        }

        if (isset($_SESSION['validationsb'])) {
            //$sucMessage = $_SESSION['successMessage'];
            if ($_SESSION['validationsb'] == "OK") {
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
            $_SESSION['validationsb'] = null;
        }
    ?>
</body>
</html>