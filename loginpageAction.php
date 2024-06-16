<?php
    session_start();
    // Establishing connection with servre & database
    $servername  = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dbcruiseschool";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        echo "Connection failed: ".$conn->connect_error;
    } else {
        echo "Connected Successfully!";
    }



    $myuserName = $_POST['username'];
    $password = $_POST['password'];

    //echo "<h1>Successful Login!</h1><br><br><br>";
    echo "<h3>Username = $myuserName <br> Password = $password</h3>";


    // Checking the username
    $dbusername = $conn->prepare("SELECT userName FROM tblusers WHERE userName = ?");
    $dbusername->bind_param("s", $myuserName);
    $dbusername->execute();
    $result = $dbusername->get_result();

    // Checking the password
    $dbpassword = $conn->prepare("SELECT userPassword FROM tblusers WHERE userPassword = ?");
    $dbpassword->bind_param("s", $password);
    $dbpassword->execute();
    $dbpasswordget = $dbpassword->get_result();
    $dbpasswordfetch = $dbpasswordget->fetch_assoc();
    $dbpasswordresult = $dbpasswordfetch['userPassword'];

    echo $dbpasswordresult;


    if($result->num_rows > 0 && $dbpasswordresult==$password) {
        $row = $result->fetch_assoc();
        $dbusernameresult = $row['userName'];
        echo "<br><br><br>Username from database: ".$dbusernameresult;

        $userId = $conn->prepare("SELECT userId FROM tblusers WHERE userName = ?");
        $userId->bind_param("s", $myuserName);
        $userId->execute();
        $userIdget = $userId->get_result();
        $userIdfetch = $userIdget->fetch_assoc();
        $userIdresult = $userIdfetch['userId'];

        $role = $conn->prepare("SELECT tblroles.roleName FROM tblusers JOIN tblroles ON tblusers.roleId = tblroles.roleId WHERE tblusers.userId = ?");
        $role->bind_param("s", $userIdresult);
        $role->execute();
        $roleget = $role->get_result();
        $rolefetch = $roleget->fetch_assoc();
        $roleresult = $rolefetch['roleName'];

        $_SESSION['RoleName'] = $roleresult;

        $Fname = $conn->prepare("SELECT Fname FROM tblusers WHERE userName = ?");
        $Fname->bind_param("s", $myuserName);
        $Fname->execute();
        $Fnameget = $Fname->get_result();
        $Fnamefetch = $Fnameget->fetch_assoc();
        $Fnameresult = $Fnamefetch['Fname'];

        $_SESSION['userFname'] = $Fnameresult;

        //echo "<br>".$_SESSION['userFname'];
        
        // echo "<script>";
        //     echo "window.location.href = 'dashboard.html';";
        // echo "</script>";
        if ($_SERVER['REQUEST_METHOD'] == "POST" || $_SERVER['REQUEST_METHOD'] == "get") {
            $_SESSION['allow'] = "YES";
            header ("location: dashboardhtml.php");
        }

    } else {
        //echo "<br><br><br>No user found with this username!";
        $_SESSION["permission"] = "NO";
        $_SESSION['flag'] = 1;
        header ("location: loginpagehtml.php");
    }

    //echo "<br><br><br>". $dbusername;

    $conn->close();
    

?>