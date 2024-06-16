<?php
    // Establishing connection with server & database
    $servername = "localhost";
    $username = "AbelAschalew";
    $password = "0112135990AbeL";
    $dbname = "dbcruiseschool";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    

    $mydate = $conn->prepare("SELECT *FROM tblstudents;");
    $mydate->execute();
    $students = $mydate->get_result();

    // echo $students->num_rows;
    // header('Content-type : application/json');
    $students_arr = $students->fetch_array();

    echo json_encode($students_arr);

    // echo json_encode('[{"id":"ECS\/440","AdmNum0001","0000-00-00","M","Addis Ababa","Abel","Aschalew","Assefa","Aschalew","0912170917","usr0001"}]');

    $conn->close();
?>