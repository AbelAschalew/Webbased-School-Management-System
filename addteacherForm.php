<?php
    session_start();
    // Establishing connection with server & database
    $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dbcruiseschool";

    $conn = new mysqli($server, $username, $password, $dbname);
    if ($conn->connect_error) {
        echo "Connection failed: ".$conn->connect_error;
    } else {
        echo "Connected Successfully!";
    }



    $fullname = $_POST['teacher-name'];
    $qualification = $_POST['qualification'];
    $experience = $_POST['experience'];
    $department = $_POST['department'];
    $userid = $_POST['user-id'];

    $names = explode(" ", $fullname);
    $fname = $names[0];
    $mname = $names[1];
    $lname = $names[2];


    // Working to generate teacherId automatically
    $maxteachid = $conn->prepare("SELECT MAX(teacherId) AS maxId FROM tblteachers");
    $maxteachid->execute();
    $maxteachidget = $maxteachid->get_result();
    $maxteachidfetch = $maxteachidget->fetch_assoc();
    $maxteachidresult = $maxteachidfetch['maxId'];
    $teacherId;
    if ($maxteachidresult == null) {
        $teacherId = "TCH/001";
    } else {
        $parts = explode("/", $maxteachidresult);
        $postfix = $parts[1];
        //$prefix = "TCH/";
        $postfix++;
        if ($postfix < 10) {
            $prefix = "TCH/00";
        } else if ($postfix < 100) {
            $prefix = "TCH/0";
        } else {
            $prefix = "TCH/";
        }
        $teacherId = $prefix.$postfix;
    }


    //echo "<br> $maxteachidresult <br>";

    echo "<br><br><br>";
    echo "First Name = $fname <br>";
    echo "Middle Name = $mname <br>";
    echo "Last Name = $lname <br>";
    echo "Qualification = $qualification <br>";
    echo "Years of Experience = $experience <br>";
    echo "Department = $department <br>";
    echo "User ID = $userid <br>";
    echo "Teacher ID = $teacherId <br>";

    // Checking if userId exists
    $chkusrid = $conn->prepare("SELECT userId FROM tblusers WHERE userId=?");
    $chkusrid->bind_param("s", $userid);
    $chkusrid->execute();
    $chkusridget = $chkusrid->get_result();
    $chkusridfetch = $chkusridget->fetch_assoc();
    $chkusridresult = $chkusridfetch['userId'];

    if ($chkusridresult == $userid) {
        // Inserting data into database
        $insstmt = $conn->prepare("INSERT INTO tblteachers (teacherId, Fname, Mname, Lname, qualification, experience, userId, deptId) VALUES(?,?,?,?,?,?,?,?)");
        $insstmt->bind_param("ssssssss", $teacherId, $fname, $mname, $lname, $qualification, $experience, $userid, $department);
        $insstmt->execute();
        $insstmt->close();

        $_SESSION['validationt'] = "OK";
        header("location: teachersmodulehtml.php");
        
    } else {
        $_SESSION['validationt'] = "NO";
        header("location: teachersmodulehtml.php");
        
    }





    $conn->close();
?>