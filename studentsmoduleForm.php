<?php
    session_start();

    // Establishing connection with server & database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dbcruiseschool";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        echo "Connection failed: ".$conn->connect_error;
    } else {
        echo "Connection Successfull!";
    }


    $fullname = $_POST['student-name'];
    $addmissionNum = $_POST['addmissionNum'];
    $DoB = $_POST['DoB'];
    $gender = $_POST['gender'];
    $address = $_POST['addresss'];
    $guardianName = $_POST['guardianName'];
    $guardianPhone = $_POST['guardianPhone'];
    $userId = $_POST['user-id'];

    $names = explode(" ", $fullname);
    $Fname = $names[0];
    $Mname = $names[1];
    $Lname = $names[2];

    // Working to generate the studentId automatically
    $dbmaxstuid = $conn->prepare("SELECT MAX(studentId) AS maxId FROM tblstudents");
    $dbmaxstuid->execute();
    $dbmaxstuidget = $dbmaxstuid->get_result();
    $dbmaxstuidfetch = $dbmaxstuidget->fetch_assoc();
    $dbmaxstuidresult = $dbmaxstuidfetch['maxId'];
    $studentId;
    if ($dbmaxstuidresult == null) {
        $studentId = "ECS/440";
    } else {
        $parts = explode("/", $dbmaxstuidresult);
        $postfix = $parts[1];
        //$prefix = "ECS/";
        $postfix++;
        if ($postfix < 10) {
            $prefix = "ECS/00";
        } else if ($postfix < 100) {
            $prefix = "ECS/0";
        } else {
            $prefix = "ECS/";
        }
        $studentId = $prefix.$postfix;
    }

    //echo $postfix;

    echo "<br>";
    echo "Full Name: $fullname <br>";
    echo "First Name: $Fname <br>";
    echo "Middle Name: $Mname <br>";
    echo "Last Name: $Lname <br>";
    echo "Addmission Number $addmissionNum <br>";
    echo "Date of Birth: $DoB <br>";
    echo "Gender: $gender <br>";
    echo "Address: $address <br>";
    echo "Guardian Name: $guardianName <br>";
    echo "Guardian Phone: $guardianPhone <br>";
    echo "User ID: $userId <br>";
    echo "Student ID: $studentId <br>";

    // Checking if userId exists
    $chkusrid = $conn->prepare("SELECT userId FROM tblusers WHERE userId=?");
    $chkusrid->bind_param("s", $userId);
    $chkusrid->execute();
    $chkusridget = $chkusrid->get_result();
    $chkusridfetch = $chkusridget->fetch_assoc();
    $chkusridresult = $chkusridfetch['userId'];

    // echo $chkusridresult."<br>";

    // Checking if database userId matchs input userId
    if ($chkusridresult == $userId) {
        // Inserting the data into database
        $insstmt = $conn->prepare("INSERT INTO tblstudents (studentId, addmissionNum, DoB, gender, addresss, Fname, Mname, Lname, guardianName, guardianPhone, userId) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
        $insstmt->bind_param("sssssssssss", $studentId, $addmissionNum, $DoB, $gender, $address, $Fname, $Mname, $Lname, $guardianName, $guardianPhone, $userId);
        $insstmt->execute();
        $insstmt->close();

        $_SESSION['validation'] = "OK";
        //$_SESSION['successMessage'] = "Student Added Successfully!";
        header("location: studentsmodulehtml.php");
    } else {
        $_SESSION['validation'] = "NO";
        //  $_SESSION['successMessage'] = "User ID Doesn't Exist!";
        header("location: studentsmodulehtml.php");
    }

    // Inserting the data into database

    /*$insstmt = $conn->prepare("INSERT INTO tblstudents (studentId, addmissionNum, DoB, gender, addresss, Fname, Mname, Lname, guardianName, guardianPhone, userId) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
    $insstmt->bind_param("sssssssssss", $studentId, $addmissionNum, $DoB, $gender, $address, $Fname, $Mname, $Lname, $guardianName, $guardianPhone, $userId);
    $insstmt->execute();
    $insstmt->close();*/

    echo "Successfully Inserted!";

    /*if ($_SERVER['REQUEST_METHOD'] == "POST") {
        
    }*/



    $conn->close();

?>