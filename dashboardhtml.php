<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/icon-x" href="cruiseSchoolLogo.jpg">
    <title>Cruise School Dashboard</title> <!-- Shouldn't this be user specific like 'Abel's Dashboard'-->
    <link rel="stylesheet" href="dashboardStyle.css">
    <link rel="stylesheet" href="headerfooterStyle.css">

    <style>
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
                <!--<li><a href="messagesmodulehtml.php">Messages</a></li>
                <li><a href="profilesettingspagehtml.php">Profile Settings</a></li>-->
            </ul>
        </aside>

        <!-- Main Content Area-->
        <main class="main-content">
            <h2>Welcome to Cruise School Dashboard <?php echo "<span style='color:green;'>".$_SESSION['userFname']." (".$_SESSION['RoleName'].")"."</span></h1>"; ?>
            <div class="overview">
                <!-- Overview of key statistics & notifications can go here -->
                <p>Total number of students: 500</p>
                <p>Total number of teachers: 50</p>
                <p>Upcoming exams: 3</p>
                <!-- Add more statistics as needed -->
            </div>
            <div class="quick-links">
                <h2>Quick Links</h2>
                <ul>
                    <li><a href="studentsmodulehtml.php">Add New Student</a></li>
                    <li><a href="teachersmodulehtml.php">Add New Teacher</a></li>
                    <li><a href="classesmodulehtml.php">Schedule Class</a></li>
                    <li><a href="adduserhtml.php">Add New User</a></li>
                </ul>
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

    <?php
        if (!isset($_SESSION['allow'])) {
            echo "<script>";
            echo "var all = document.getElementById('allCont');";
            echo "all.style.display='none';";
            echo "var msg = document.getElementById('perMessage');";
            echo "msg.style.display='block';";
            echo "</script>";
        }

        echo "<script>";
            echo "document.title='".$_SESSION['userFname']."\'s Dashboard';";
        echo "</script>";
    ?>


</body>
</html>