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



    $classname = $_POST['className'];
    $teachername = $_POST['teacherName'];
    $starttime = $_POST['startTime'];
    $endtime = $_POST['endTime'];

    

    // Generating the classid automatically
    $dbmaxclsid = $conn->prepare("SELECT MAX(classId) AS maxId FROM tblclasses");
    $dbmaxclsid->execute();
    $dbmaxclsidget = $dbmaxclsid->get_result();
    $dbmaxclsidfetch = $dbmaxclsidget->fetch_assoc();
    $dbmaxclsidresult = $dbmaxclsidfetch['maxId'];
    $classid;
    if ($dbmaxclsidresult == null) {
        $classid = "CLS/001";
    } else {
        $parts = explode("/", $dbmaxclsidresult);
        $postfix = $parts[1];
        //$prefix = "CLS/";
        $postfix++;
        if ($postfix < 10) {
            $prefix = "CLS/00";
        } else if ($postfix < 100) {
            $prefix = "CLS/0";
        } else {
            $prefix = "CLS/";
        }
        $classid = $prefix.$postfix;
    }

    $names = explode(" ", $teachername);
    $Fname = $names[0];
    $Mname = $names[1];
    $Lname = $names[2];

    // Conerting the teachername to teacherid from database
    $dbteacherid = $conn->prepare("SELECT teacherId FROM tblteachers WHERE Fname=? AND Mname=? AND Lname=?");
    $dbteacherid->bind_param("sss", $Fname, $Mname, $Lname);
    $dbteacherid->execute();
    $dbteacheridget = $dbteacherid->get_result();
    $dbteacheridfetch = $dbteacheridget->fetch_assoc();
    $dbteacheridresult = $dbteacheridfetch['teacherId'];
    $teacherid = $dbteacheridresult;

    echo "<br><br><br>";
    echo "Class Name = $classname <br>";
    echo "Teacher Name = $teachername <br>";
    echo "First Name = $Fname <br>";
    echo "Middle Name = $Mname <br>";
    echo "Last Name = $Lname <br>";
    echo "Start Time = $starttime <br>";
    echo "End Time = $endtime <br>";
    echo "Class ID = $classid <br>";
    echo "Teacher ID = $teacherid <br>";

    if ($teacherid != null) {
        // Adding class to database
        $insstmt = $conn->prepare("INSERT INTO tblclasses (classId, className, startTime, endTime, teacherId) VALUES(?,?,?,?,?)");
        $insstmt->bind_param("sssss", $classid, $classname, $starttime, $endtime, $teacherid);
        $insstmt->execute();
        $insstmt->close();

        $_SESSION['validationc'] = "OK";
        header("location: classesmodulehtml.php");
    } else {
        $_SESSION['validationc'] = "No";
        header("location: classesmodulehtml.php");
    }




    $conn->close();
?>