<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/icon-x" href="cruiseSchoolLogo.jpg">
    <title>Cruise School Grades</title>
    <link rel="stylesheet" href="gradesmoduleStyle.css">
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
            <h1>Grades</h1>

            <!-- List of Subjects -->
            <!--<section class="subject-list">
                <h2>Subjects</h2>
                <ul>
                    <li>Mathematics</li>
                    <li>Biology</li>
                    <li>Chemistry</li>
                    <li>English</li>
                    <li>Civics</li>
                    <li>Physics</li>
                    <li.
                    
                </ul>
            </section>-->

            <!-- Grade Entry Form -->
            <section class="grade-entry-form">
                <h2>Enter Grades</h2>
                <form id="add-grades-form" action="addgradeAction.php" name="addgradeForm" method="post" target="_blank" autocomplete="off">
                    <div class="form-group">
                        <label for="studentId">Student ID:</label>
                        <input type="text" id="studentId" name="studentId" placeholder="i.e. ECS/440" required>
                        <span id="studentId-error" class="error-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="subjectId">Subject ID:</label>
                        <input type="text" id="subjectId" name="subjectId" placeholder="i.e. SUBJ/01" required>
                        <span id="subjectId-error" class="error-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="grade">Grade:</label>
                        <input type="number" id="grade" name="grade" placeholder="i.e. 50" required>
                        <span id="grade-error" class="error-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="examType">Exam Type:</label>
                        <select id="examType" name="examType" required>
                            <option value="test1">Test 1</option>
                            <option value="test2">Test 2</option>
                            <option value="mid">Mid Exam</option>
                            <option value="final">Final Exam</option>
                        </select>
                        <span id="examType-error" class="error-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="examDate">Exam Date:</label>
                        <input type="date" id="examDate" name="examDate" required>
                        <span id="examDate-error" class="error-message"></span>
                    </div>
                    <button id="addGradebtn" type="submit">Add Grade</button>
                </form>
            </section>

            <!-- List of Students & Grades -->
            <section class="student-grades">
                <h2>Student Grades</h2>
                <form id="student-filter-form">
                    <label for="studentId">Enter Student ID:</label>
                    <input type="text" id="studentId" name="studentId" required>
                    <button type="submit">Filter</button>
                </form>
                <table id="grade-table">
                    <thead>
                        <tr>
                            <th>Grade ID</th>
                            <th>Student Name</th>
                            <th>Student ID</th>
                            <th>Subject Name</th>
                            <th>Grade</th>
                            <th>Exam Type</th>
                            <th>Date</th>
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

                            $sql = "SELECT G.gradeId,S.Fname,S.Mname,S.Lname,G.studentId,SB.subjectName,G.grade,G.examDate,G.examType FROM tblgrades AS G INNER JOIN tblstudents AS S ON G.studentId=S.studentId INNER JOIN tblsubjects AS SB ON G.subjectId=SB.subjectId";
                            $results = $conn->query($sql);
                            if ($results->num_rows > 0 ){
                                while ($row = $results->fetch_assoc()) {
                                    echo "<tr>";
                                        echo "<td>".$row['gradeId']."</td>";
                                        echo "<td>".$row['Fname']." ".$row['Mname']." ".$row['Lname']."</td>";
                                        echo "<td>".$row['studentId']."</td>";
                                        echo "<td>".$row['subjectName']."</td>";
                                        echo "<td>".$row['grade']."</td>";
                                        echo "<td>".$row['examType']."</td>";
                                        echo "<td>".$row['examDate']."</td>";
                                    echo "</tr>";
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </section>
            <div id="successMessage1" class="message">
                Grade Added Successfully!
            </div>
            <div id="successMessage2" class="message">
                Student Not Found!
            </div>
            <div id="successMessage3" class="message">
                Subject Not Found!
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

    <script src="gradesmoduleValidationScriptx.js"></script>

    <?php
        if (!isset($_SESSION['allow'])) {
            echo "<script>";
            echo "var all = document.getElementById('allCont');";
            echo "all.style.display='none';";
            echo "var msg = document.getElementById('perMessage');";
            echo "msg.style.display='block';";
            echo "</script>";
        }

        if (isset($_SESSION['validationgr'])) {
            //$sucMessage = $_SESSION['successMessage'];
            if ($_SESSION['validationgr'] == "OK") {
                echo "<script>";
                    echo "var successMessage = document.getElementById('successMessage1');";
                    
                    echo "successMessage.style.display = 'block';";
                    // echo "var sucMsg1 = document.getElementById('sucMsg1');";
                    // echo "sucMsg1.display='inline';";
                    echo "setTimeout(hideMessage, 10000);";
                    echo "function hideMessage () {successMessage.style.display = 'none';};";
                echo "</script>";
                
            } else if ($_SESSION['validationgr'] == "NST") {
                echo "<script>";
                    echo "var successMessage = document.getElementById('successMessage2');";
                    
                    echo "successMessage.style.display = 'block';";
                    echo "successMessage.style.color='red';";
                    // echo "var sucMsg1 = document.getElementById('sucMsg1');";
                    // echo "sucMsg1.display='inline';";
                    echo "setTimeout(hideMessage, 10000);";
                    echo "function hideMessage () {successMessage.style.display = 'none';};";
                echo "</script>";
            } else {
                echo "<script>";
                    echo "var successMessage = document.getElementById('successMessage3');";
                    
                    echo "successMessage.style.display = 'block';";
                    echo "successMessage.style.color='red';";
                    // echo "var sucMsg1 = document.getElementById('sucMsg1');";
                    // echo "sucMsg1.display='inline';";
                    echo "setTimeout(hideMessage, 10000);";
                    echo "function hideMessage () {successMessage.style.display = 'none';};";
                echo "</script>";
            }
            $_SESSION['validationgr'] = null;
        }
    ?>
</body>
</html>