
var addattendanceForm = document.getElementById("add-attendances-form");

addattendanceForm.addEventListener("submit", validateAddAttendanceForm);

function validateAddAttendanceForm (event) {
    event.preventDefault();

    var myForm = document.forms['addattendanceForm'];
    var attendanceDate = myForm['attendanceDate'].value;
    var classId = myForm['classId'].value;
    var studentStatus = myForm['studentStatus'].value;

    var attendanceDateError =document.getElementById("attendanceDate-error");
    var classIdError = document.getElementById("classId-error");
    var studentStatusError = document.getElementById("studentStatus-error");

    // Checking the attendanceDate
    if (attendanceDate == "") {
        attendanceDateError.innerHTML = "attendance date is empty!";
        return;
    }
    var attDate = new Date(attendanceDate);
    var currentDate = new Date();
    if (attDate.getTime() > currentDate.getTime()) {
        attendanceDateError.innerHTML = "attendance date passes the current date!";
        return;
    }
    attendanceDateError.style.color = "blue";
    attendanceDateError.innerHTML = "correct!";

    // Checking the classId
    if (classId == "") {
        classIdError.innerHTML = "class ID is empty!";
        return;
    }
    if (classId.length != 7) {
        classIdError.innerHTML = "class ID must be 7 characters long!";
        return;
    }
    if (classId.indexOf(' ') != -1) {
        classIdError.innerHTML = "class ID must not contain space!";
        return;
    }
    if (classId.substring(0,4) != "CLS/") {
        classIdError.innerHTML = "class ID must start with \"CLS/\"!";
        return;
    }
    classIdError.style.color = "blue";
    classIdError.innerHTML = "correct!";

    // Checking the studentStatus
    if (studentStatus == "") {
        studentStatusError.innerHTML = "student status is empty!";
        return;
    }
    studentStatusError.style.color = "blue";
    studentStatusError.innerHTML = "correct!";

    addattendanceForm.submit();

    //displaySuccessMessage();
}

var addAttendancebtn = document.getElementById("addAttendancebtn");
addAttendancebtn.addEventListener("click", validateAddAttendanceForm);

/*function displaySuccessMessage () {
    var successMessage = document.getElementById("successMessage");
    function showMessage () {
        successMessage.style.display = "block";
        setTimeout(hideMessage, 10000);
    }
    function hideMessage () {
        successMessage.style.display = "none";
    }
    showMessage();
}*/