<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/icon-x" href="cruiseSchoolLogo.jpg">
    <title>Cruise School Profile Settings</title>
    <link rel="stylesheet" href="profilesettingspageStyle.css">
    <link rel="stylesheet" href="headerfooterStyle.css">
</head>
<body>
    <header>
        <div class="headercontainer">
            <img src="cruiseSchoolLogo.jpg" alt="Cruise School Logo">
            <h1>Cruise School</h1>
            <button type="button" onclick="logOut()">Logout</button>
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

        <!-- Main Content Area -->
        <main class="main-content">
            <h1>Profile Settings</h1>

            <!-- User Profile Information -->
            <section class="profile-info">
                <h2>User Profile Information</h2>
                <form>
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" value="abelaschalew" disabled>
                    </div>
                    <div class="form-group">
                        <label for="roleName">Role:</label>
                        <input type="text" id="roleName" name="roleName" value="Student" disabled>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="abelaschalew@gmail.com">
                    </div>
                    <div class="form-group">
                        <label for="phoneNum">Phone Number:</label>
                        <input type="tel" id="phoneNum" name="phoneNum" value="09-20-12-64-20">
                    </div>
                    <button type="submit">Update Profile</button>
                </form>
            </section>

            <!-- Change Password Section -->
            <section class="change-password">
                <h2>Change Password</h2>
                <form>
                    <div class="form-group">
                        <label for="current-password">Current Password:</label>
                        <input type="password" id="current-password" name="current-password" required>
                    </div>
                    <div class="form-group">
                        <label for="new-password">New Password:</label>
                        <input type="password" id="new-password" name="new-password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirm New Password:</label>
                        <input type="password" id="confirm-password" name="confirm-password" required>
                    </div>
                    <button type="submit">Change Password</button>
                </form>
            </section>
        </main>
    </div>

    <!-- Footer Section -->
    <footer>
        <div class="container">
            <!-- Add footer content here -->
            <p>&copy; 2024 Cruise School. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>