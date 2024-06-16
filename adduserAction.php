<?php
    session_start();

    // Establishing server & database connection
    $server = "localhost";
    $userName = "root";
    $password = "";
    $dbname = "dbcruiseschool";

    $conn = new mysqli($server, $userName, $password, $dbname);
    if($conn->connect_error){
        echo "Connection Failed!<br>";
    }else{
        echo "Connection Sucessful!<br>";
    }

    $fullname = $_POST['user-name'];
    $username = $_POST['username'];
    $userpassword = $_POST['password'];
    $email = $_POST['email'];
    $phonenum = $_POST['phoneNum'];
    $roleid = $_POST['roleId'];
    $userid;

    $names = explode(" ",$fullname);
    $fname = $names[0];
    $mname = $names[1];
    $lname = $names[2];

    // Generating the userid automatically
    $useridmax = $conn->prepare("SELECT MAX(userId) AS maxId FROM tblusers");
    $useridmax->execute();
    $useridmaxget = $useridmax->get_result();
    $useridmaxfetch = $useridmaxget->fetch_assoc();
    $useridmaxresult = $useridmaxfetch['maxId'];

    if($useridmaxresult==null){
        $userid = "usr0001";
    }else{
        $parts = explode("r",$useridmaxresult);
        $postfix = $parts[1];
        $postfix++;
        if ($postfix <10){
            $prefix = "usr000";
        }else if($postfix < 100){
            $prefix = "usr00";
        }else if($postfix <1000){
            $prefix = "usr0";
        }else{
            $prefix = "usr";
        }
        $userid = $prefix.$postfix;
    }



    echo "<br><br><br>";
    echo "Full Name = $fullname <br>";
    echo "Username = $username <br>";
    echo "User Password = $userpassword <br>";
    echo "Email = $email <br>";
    echo "Phone Number = $phonenum <br>";
    echo "Role ID = $roleid <br>";
    echo "User ID = $userid <br>";

    // Checking if userid matches database userid
    $chkrlid = $conn->prepare("SELECT roleId FROM tblroles WHERE roleId=?");
    $chkrlid->bind_param("s",$roleid);
    $chkrlid->execute();
    $chkrlidget = $chkrlid->get_result();
    $chkrlidfetch = $chkrlidget->fetch_assoc();
    $chkrlidresult = $chkrlidfetch['roleId'];

    if($chkrlidresult == null){
        echo "Role Id Not Found!";
        $_SESSION['validationur'] = "NO";
        $conn->close();
        header("location: adduserhtml.php");
        exit();
    } else{
        // Inserting into database
        $insstmt = $conn->prepare("INSERT INTO tblusers (userId,userName,userPassword,email,phoneNum,roleId,Fname,Mname,Lname) VALUES(?,?,?,?,?,?,?,?,?)");
        $insstmt->bind_param("sssssssss", $userid, $username, $userpassword, $email, $phonenum, $roleid, $fname, $mname, $lname);
        $insstmt->execute();
        $_SESSION['validationur'] = "OK";
        $conn->close();
        header("location: adduserhtml.php");
    }

?>