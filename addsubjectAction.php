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

    

    $subjectname = $_POST['subjectName'];
    $subjectteacher = $_POST['teacherName'];

    // Breaking the fullname
    $names = explode(" ", $subjectteacher);
    $Fname = $names[0];
    $Mname = $names[1];
    $Lname = $names[2];

    // Connecting teachername with teacherid in database
    $dbtechid = $conn->prepare("SELECT teacherId FROM tblteachers WHERE Fname=? AND Mname=? AND Lname=?");
    $dbtechid->bind_param("sss", $Fname, $Mname, $Lname);
    $dbtechid->execute();
    $dbtechidget = $dbtechid->get_result();
    $dbtechidfetch = $dbtechidget->fetch_assoc();
    $dbtechidresult = $dbtechidfetch['teacherId'];
    $teacherid = $dbtechidresult;

    // Working to generate the subjectid automatically
    $chksubid = $conn->prepare("SELECT MAX(subjectId) AS maxId FROM tblsubjects");
    $chksubid->execute();
    $chksubidget = $chksubid->get_result();
    $chksubidfetch = $chksubidget->fetch_assoc();
    $chksubidresult = $chksubidfetch['maxId'];
    $subjectid;
    if ($chksubidresult == null) {
        $subjectid = "SUBJ/01";
    } else {
        //$prefix = "SUBJ/";
        $parts = explode("/", $chksubidresult);
        $postfix = $parts[1];
        $postfix++;
        if ($postfix < 10) {
            $prefix = "SUBJ/0";
        } else {
            $prefix = "SUBJ/";
        }
        $subjectid = $prefix.$postfix;
        // if ($postfix < 10) {
        //     $subjectid = $prefix."0".$postfix;
        // } else {
        //     $subjectid = $prefix.$postfix;
        // }
    }


    echo "<br><br><br>";
    echo "Subject Name = $subjectname <br>";
    echo "Subject Teacher = $subjectteacher <br>";
    echo "First Name = $Fname <br>";
    echo "Middle Name = $Mname <br>";
    echo "Last Name = $Lname <br>";
    echo "Teacher ID = $teacherid <br>";
    echo "Subject ID = $subjectid <br>";



    if ($teacherid == null) {
        $_SESSION['validationsb'] = "No";
        //echo "<h1>Teacher Not Found</h1>";
        header("location: subjectsmodulehtml.php");
    } else {
        // Inserting data into database
        $insstmt = $conn->prepare("INSERT INTO tblsubjects (subjectId, subjectName, teacherId) VALUES (?,?,?)");
        $insstmt->bind_param("sss", $subjectid, $subjectname, $teacherid);
        $insstmt->execute();
        $insstmt->close();
        $_SESSION['validationsb'] = "OK";
        // echo "<h1>Subject Added Successfully</h1>";
        header("location: subjectsmodulehtml.php");
    }




    $conn->close();
?>