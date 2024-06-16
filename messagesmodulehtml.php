<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image" href="cruiseSchoolLogo.jpg">
    <title>Cruise School Messages</title>
    <link rel="stylesheet" href="messagesmoduleStyle.css">
    <link rel="stylesheet" href="headerfooterStyle.css">

    <style>
        .error-message {
            color: red;
        }
    </style>
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
            <h1>Messages</h1>

            <!-- Inbox Section -->
            <section class="inbox">
                <h2>Inbox</h2>
                <ul>
                    <li>
                        <span class="sender">Natol Degefu</span>
                        <span class="subject">Regarding Exam Schedule</span>
                        <span class="date">May 1, 2024</span>
                    </li>
                    <!-- More messages can be added -->
                </ul>
            </section>

            <!-- Compose Message Form -->
            <section class="compose-message">
                <h2>Compose Message</h2>
                <form id="send-messages-form" action="sendmessageAction.php" name="sendmessageForm" method="post" target="_blank" autocomplete="off">
                    <div class="form-group">
                        <label for="recipient">To:</label>
                        <input type="email" id="recipient" name="recipient" placeholder="Enter recipient's email" required>
                        <span id="recipient-error" class="error-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject:</label>
                        <input type="text" id="subject" name="subject" placeholder="Enter subject of message.." required>
                        <span id="subject-error" class="error-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="messageBody">Message:</label>
                        <textarea id="messageBody" name="messageBody" rows="5" placeholder="Enter message..." required></textarea>
                        <span id="messageBody-error" class="error-message"></span>
                    </div>
                    <button type="button">SEND</button>
                </form>
            </section>

            <!-- View Message Details -->
            <section class="view-message">
                <h2>Message Details</h2>
                <div class="message-details">
                    <div class="sender">From: John Doe</div>
                    <div class="subject">Subject: Regarding Exam Schedule</div>
                    <div class="date">Date: May 15, 2024</div>
                    <div class="message-body">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec arcu vitae urna tristique vestibulum. Proin eget sollicitudin neque. Sed tincidunt sapien quis tincidunt condimentum. Aliquam quis lectus in ligula fringilla convallis. Duis ut pharetra odio.
                    </div>
                    <button class="reply-button">Reply</button>
                </div>
            </section>
        </main>
    </div>

    <!-- Footer Section -->
    <footer>
        <div class="container">
        
            <p>&copy; 2024 Cruise School. All rights reserved.</p>
        </div>
    </footer>

    <script src="messagesmoduleValidationScript.js"></script>
</body>
</html>