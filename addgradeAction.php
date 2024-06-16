<?php
    session_start();

    // Establishing connection
    $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dbcruiseschool";

    $conn = new mysqli($server, $username, $password, $dbname);
    if ($conn->connect_error) {
        echo "<h3>Connection Failed!</h3><br>";
    }

    // Reading input
    $studentid = $_POST['studentId'];
    $subjectid = $_POST['subjectId'];
    $grade = $_POST['grade'];
    $examtype = $_POST['examType'];
    $examdate = $_POST['examDate'];
    $gradeid;

    // Generating gradeid
    $chkgrdid = $conn->prepare("SELECT MAX(gradeId) AS maxId FROM tblgrades");
    $chkgrdid->execute();
    $chkgrdidget = $chkgrdid->get_result();
    $chkgrdidfetch = $chkgrdidget->fetch_assoc();
    $chkgrdidresult = $chkgrdidfetch['maxId'];

    if ($chkgrdidresult == null) {
        $gradeid = "GRD/001";
    } else {
        $parts = explode("/",$chkgrdidresult);
        $postfix = $parts[1];
        $postfix++;
        if ($postfix < 10) {
            $prefix = "GRD/00";
        } elseif ($postfix < 100) {
            $prefix = "GRD/0";
        }else {
            $prefix = "GRD/";
        }
        $gradeid = $prefix.$postfix;
    }



    echo "<br><br><br>";
    echo "Student ID = $studentid <br>";
    echo "Subject ID = $subjectid <br>";
    echo "Grade = $grade <br>";
    echo "Exam Type = $examtype <br>";
    echo "Exam Date = $examdate <br>";
    echo "Grade ID = $gradeid <br>";

    // Checking studentid
    $chkstdid = $conn->prepare("SELECT studentId FROM tblstudents WHERE studentId=?");
    $chkstdid->bind_param("s",$studentid);
    $chkstdid->execute();
    $chkstdidget = $chkstdid->get_result();
    $chkstdidfetch = $chkstdidget->fetch_assoc();
    $chkstdidresult = $chkstdidfetch['studentId'];
    $dbstudentId = $chkstdidresult;

    // Checking subjectid
    $chksbjid = $conn->prepare("SELECT subjectId FROM tblsubjects WHERE subjectId=?");
    $chksbjid->bind_param("s",$subjectid);
    $chksbjid->execute();
    $chksbjidget = $chksbjid->get_result();
    $chksbjidfetch = $chksbjidget->fetch_assoc();
    $chksbjidresult = $chksbjidfetch['subjectId'];
    $dbsubjectid = $chksbjidresult;

    if ($dbstudentId == null){
        $_SESSION['validationgr'] = "NST";
        echo "<h2>Studentid not found</h2><br>";
        $conn->close();
        header("location: gradesmodulehtml.php");
        exit();
        
    }

    if ($dbsubjectid == null) {
        $_SESSION['validationgr'] = "NSJ";
        echo "<h2>Subjectid not found</h2><br>";
        $conn->close();
        header("location: gradesmodulehtml.php");
        exit();
    }

    if ($dbstudentId != null && $dbsubjectid != null) {
        
        // inserting to database
        $insstmt = $conn->prepare("INSERT INTO tblgrades VALUES(?,?,?,?,?,?)");
        $insstmt->bind_param("ssssss",$gradeid,$grade,$examtype,$examdate,$studentid,$subjectid);
        $insstmt->execute();
        echo "<h2>Successfull</h2>";
        $_SESSION['validationgr'] = "OK";
        header("location: gradesmodulehtml.php");
    }

    $conn->close();
?>