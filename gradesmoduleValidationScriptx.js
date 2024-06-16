
var addgradeForm = document.getElementById("add-grades-form");

addgradeForm.addEventListener("submit", validateAddGradeForm);

function validateAddGradeForm (event) {
    event.preventDefault();

    var myForm = document.forms['addgradeForm'];
    var studentId = myForm[0].value;
    var subjectId = myForm[1].value;
    var grade = myForm[2].value;
    var examType = myForm["examType"].value;
    var examDate = myForm[4].value;

    var studentIdError = document.getElementById("studentId-error");
    var subjectIdError = document.getElementById("subjectId-error");
    var gradeError = document.getElementById("grade-error");
    var examTypeError = document.getElementById("examType-error");
    var examDateError = document.getElementById("examDate-error");

    // Checking the studentId
    if (studentId == "") {
        studentIdError.innerHTML = "student ID is empty!";
        return;
    }
    if (studentId.length != 7) {
        studentIdError.innerHTML = "student ID must be 7 characters long!";
        return;
    }
    if (studentId.indexOf(' ') != -1) {
        studentIdError.innerHTML = "student ID must not contain space!";
        return;
    }
    if (studentId.substring(0,4) != "ECS/") {
        studentIdError.innerHTML = "student ID must start with \"ECS/\"!";
        return;
    }
    studentIdError.style.color = "blue";
    studentIdError.innerHTML = "correct!";

    // Checking the subjectId
    if (subjectId == "") {
        subjectIdError.innerHTML = "suject ID is empty!";
        return;
    }
    if (subjectId.length != 7) {
        subjectIdError.innerHTML = "subject ID must be 7 characters long!";
        return;
    }
    if (subjectId.indexOf(' ') != -1) {
        subjectIdError.innerHTML = "subject ID must not contain space!";
        return;
    }
    if (subjectId.substring(0,5) != "SUBJ/") {
        subjectIdError.innerHTML = "subject ID must start with \"SUBJ/\"!";
        return;
    }
    subjectIdError.style.color = "blue";
    subjectIdError.innerHTML = "correct!";

    // Checking the grade
    if (grade == "") {
        gradeError.innerHTML = "grade is empty!";
        return;
    }
    if (grade < 0) {
        gradeError.innerHTML = "grade cannot be less than 0!";
        return;
    }
    if (grade > 100) {
        gradeError.innerHTML = "grade cannot be greater than 100!";
        return;
    }
    gradeError.style.color = "blue";
    gradeError.innerHTML = "correct!";

    // Checking the examType
    /*if (examType == "") {
        examTypeError.innerHTML = "exam type is empty!";
        return;
    }*/
    examTypeError.style.color = "blue";
    examTypeError.innerHTML = "correct!";

    // Checking the examDate
    if (examDate == "") {
        examDateError.innerHTML = "exam date is empty!";
        return;
    }
    var currentDate = new Date();
    var exDate = new Date(examDate);
    if (exDate.getTime() > currentDate.getTime()) {
        examDateError.innerHTML = "exam date passes current date!";
        return;
    }
    examDateError.style.color = "blue";
    examDateError.innerHTML = "correct!";

    addgradeForm.submit();
    
    //displaySuccessMessage();
}

var addGradebtn = document.getElementById("addGradebtn");
addGradebtn.addEventListener("click", validateAddGradeForm);

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