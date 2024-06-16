<?php
    session_start();
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/icon-x" href="cruiseSchoolLogo.jpg">
    <title>Cruise School Login</title>
    <link rel="stylesheet" href="loginpageStyle.css">

    <style>
        .error-message {
            color: red;
        }
        .permessage {
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
    </style>
</head>
<body>
    <div class="login-container">
        <h2>
            Login to Cruise School
        </h2>
        <form id="login-form" action="loginpageAction.php" name="loginpageForm" method="post" target="_self" autocomplete="off">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Enter username..." required>
                <span id="username-error" class="error-message"></span>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter password..." required>
                <span id="password-error" class="error-message"></span>
            </div>
            <button id="loginbtn" type="submit">Login</button>
            <a href="">Forgot Password?</a>
        </form>
    </div>

    <div id="permissionMessage" class="permessage">
        Invalid Credentials!
    </div>

    <script src="loginpageValidationScript.js"></script>

    <?php
        
        // echo "<script>";
        //     echo "var loginbtn = document.getElementById('loginbtn');";
        //     echo "loginbtn.addEventListener('click', function () {".$flag = 1."};";
        // echo "</script>";
        if (isset($_SESSION['permission'])) {
            if ($_SESSION['permission']==="NO" && $_SESSION['flag']==1) {
                echo "<script>";
                    echo "var successMessage = document.getElementById('permissionMessage');";
                    echo "successMessage.style.display = 'block';";
                    echo "setTimeout(hideMessage, 5000);";
                    echo "function hideMessage () {
                        successMessage.style.display = 'none';
                    }";
                echo "</script>";
            }
        }
        $_SESSION['flag'] = 0;
    ?>
</body>
</html>