<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/icon-x" href="cruiseSchoolLogo.jpg">
    <title>Cruise School Attendance</title>
    <link rel="stylesheet" href="attendancemoduleStyle.css">
    <link rel="stylesheet" href="headerfooterStyle.css">

    <style>
        .pr {
            background-color: lightgreen;
            padding: 7px;
            
        }
        .ab {
            background-color: lightcoral;
            padding: 7px;
        }
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
            <h1>Attendance Management</h1>

            <!-- Add Attendance Form-->
            <div class="add-attendance-form">
                <h2>Mark Attendance</h2>
                <form id="add-attendances-form" action="addattendanceAction.php" name="addattendanceForm" method="post" target="_self" autocomplete="off">
                    <div class="form-group">
                        <label for="attendanceDate">Select Date:(e.g.04/16/1996)</label>
                        <input type="date" id="attendanceDate" name="attendanceDate" required>
                        <span id="attendanceDate-error" class="error-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="classId">Class ID</label>
                        <input type="text" id="classId" name="classId" placeholder="e.g. CLS/001" required>
                        <span id="classId-error" class="error-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="studentId">Student ID</label>
                        <input type="text" id="studentId" name="studentId" placeholder="e.g. ECS/440" required>
                        <span id="studentId-error" class="error-message"></span>
                    </div>
                    <div class="form-group">
                        <label>Status:</label>
                        <label for="studentStatusp">
                        <input type="radio" id="studentStatusp" name="studentStatus" value="present"><b class="pr">Present</b>
                        </label>
                        <br>
                        <label for="studentStatusa">
                        <input type="radio" id="studentStatusa" name="studentStatus" value="absent"><b class="ab">Absent</b><br>
                        </label>
                        <!--<select id="studentStatus" name="studentStatus" size="2">
                            <option value="Present" id="allp">Present</option>
                            <option value="Absent" id="allab">Absent</option>
                            <option value="Abel Aschalew">Abel Aschalew</option>
                            <option value="Mikiyas Sintayehu">Mikiyas Sintayehu</option>
                            <option value="Hana Chaka">Hana Chaka</option>
                        </select>-->
                        <span id="studentStatus-error" class="error-message"></span>
                    </div>
                    <button type="submit" id="addAttendancebtn">Add Attendance</button>
                </form>
            </div>
            
            <!-- Attendance Records Table-->
            <div class="attendance-records">
                <h2>Attendance Records</h2>
                <!--<div class="date-selector">
                    <form>
                        <h3>Select Date & Class</h3>
                        <label>
                            Select Date:
                            <input type="date" id="attdate" name="attdate">
                            <!--<datalist id="dates">
                                <option value="04/16/1996">
                                <option value="01/01/2024">
                                <option value="12/12/2000">
                            </datalist>
                        </label>
                        <label>
                            Enter Class ID:
                            <input type="text" id="classId" name="classId">
                            <!--<datalist id="class">
                                <option value="Class 01" selected>
                            </datalist>
                        </label>
                    </form>
                </div>
                <button type="button" onclick="fetchAttend()">Fetch Attendance</button>-->
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Class ID</th>
                            <th>Students ID</th>
                            <th>Student Name</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="attendanceRecordsTable">
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

                            $sql = "SELECT A.attenDate,A.attenStatus,A.classId,A.studentId,S.Fname,S.Mname,S.Lname FROM tblattendance AS A INNER JOIN tblstudents AS S ON A.studentId = S.studentId";
                            $results = $conn->query($sql);

                            if ($results->num_rows > 0) {
                                while ($row = $results->fetch_assoc()) {
                                    echo "<tr>";
                                        echo "<td>".$row['attenDate']."</td>";
                                        echo "<td>".$row['classId']."</td>";
                                        echo "<td>".$row['studentId']."</td>";
                                        echo "<td>".$row['Fname']." ".$row['Mname']." ".$row['Lname']."</td>";
                                        echo "<td>".$row['attenStatus']."</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td style='text-align:center;' colspan='5'>No Records Found</td></tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div id="successMessage1" class="message">
                Attendance Marked Successfully!
            </div>
            <div id="successMessage2" class="message">
                Class Id doesn't Exist!
            </div>
            <div id="successMessage3" class="message">
                Student Id doesn't Exist!
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

    <script src="attendancemoduleValidationScriptx.js"></script>


    <?php
        if (!isset($_SESSION['allow'])) {
            echo "<script>";
            echo "var all = document.getElementById('allCont');";
            echo "all.style.display='none';";
            echo "var msg = document.getElementById('perMessage');";
            echo "msg.style.display='block';";
            echo "</script>";
        }

        if (isset($_SESSION['validationat'])) {
            //$sucMessage = $_SESSION['successMessage'];
            if ($_SESSION['validationat'] == "OK") {
                echo "<script>";
                    echo "var successMessage = document.getElementById('successMessage1');";
                    
                    echo "successMessage.style.display = 'block';";
                    // echo "var sucMsg1 = document.getElementById('sucMsg1');";
                    // echo "sucMsg1.display='inline';";
                    echo "setTimeout(hideMessage, 10000);";
                    echo "function hideMessage () {successMessage.style.display = 'none';};";
                echo "</script>";
                
            } else if ($_SESSION['validationat'] == "NOC") {
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
            $_SESSION['validationat'] = null;
        }
    ?>
</body>
</html>