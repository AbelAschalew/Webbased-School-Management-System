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





    $attendancedate = $_POST['attendanceDate'];
    $classid = $_POST['classId'];
    $studentid = $_POST['studentId'];
    $studentstatus = $_POST['studentStatus'];
    $attendanceid;

    // Generating the attendanceid automatically
    $dbattidmax = $conn->prepare("SELECT MAX(attenId) AS maxId FROM tblattendance");
    $dbattidmax->execute();
    $dbattidmaxget = $dbattidmax->get_result();
    $dbattidmaxfetch = $dbattidmaxget->fetch_assoc();
    $dbattidmaxresult = $dbattidmaxfetch['maxId'];

    if ($dbattidmaxresult == null) {
        $attendanceid = "AT/0001";
    } else {
        $parts = explode("/", $dbattidmaxresult);
        $postfix = $parts[1];
        $postfix++;
        if ($postfix < 10) {
            $prefix = "AT/000";
        } else if ($postfix < 100) {
            $prefix = "AT/00";
        } else if ($postfix < 1000) {
            $prefix = "AT/0";
        } else {
            $prefix = "AT/";
        }
        $attendanceid = $prefix.$postfix;
    }

    // Checking if classId exists
    $chkclsid = $conn->prepare("SELECT classId FROM tblclasses WHERE classId=?");
    $chkclsid->bind_param("s", $classid);
    $chkclsid->execute();
    $chkclsidget = $chkclsid->get_result();
    $chkclsidfetch = $chkclsidget->fetch_assoc();
    $chkclsidresult = $chkclsidfetch['classId'];

    // Checking if studentId exists
    $chkstdid = $conn->prepare("SELECT studentId FROM tblstudents WHERE studentId=?");
    $chkstdid->bind_param("s", $studentid);
    $chkstdid->execute();
    $chkstdidget = $chkstdid->get_result();
    $chkstdidfetch = $chkstdidget->fetch_assoc();
    $chkstdidresult = $chkstdidfetch['studentId'];

    echo "<br><br><br>";
    echo "Attendance Date = $attendancedate <br>";
    echo "Class ID = $classid <br>";
    echo "Present Students = $studentstatus <br>";
    echo "Attendance ID = $attendanceid <br>";

    if ($chkclsidresult == null) {
        echo "<br><h2>Class ID Not Found!</h2><br><br>";
        $_SESSION['validationat'] = "NOC";
        $conn->close();
        header("location: attendancemodulehtml.php");
        exit();
        
    } else {
        echo "<br><h2>Class ID Found</h2><br><br>";
    }

    if ($chkstdidresult == null) {
        echo "<br><h2>Student ID Not Found!</h2><br><br>";
        $_SESSION['validationat'] = "NOS";
        $conn->close();
        header ("location: attendancemodulehtml.php");
        exit();
    } else {
        echo "<br><h2>Student ID Found!</h2><br><br>";
    }


    if ($classid == $chkclsidresult && $studentid == $chkstdidresult) {
        $insstmt = $conn->prepare("INSERT INTO tblattendance (attenId, attenDate, attenStatus, classId, studentId) VALUES (?,?,?,?,?)");
        $insstmt->bind_param("sssss", $attendanceid, $attendancedate, $studentstatus, $classid, $studentid);
        $insstmt->execute();
        $_SESSION['validationat'] = "OK";
        header("location: attendancemodulehtml.php");
    }
    





    $conn->close();
?>