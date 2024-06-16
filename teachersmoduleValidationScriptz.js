


var addteacherForm = document.getElementById("add-teachers-form");

addteacherForm.addEventListener("submit", validateAddTeacherForm);

function validateAddTeacherForm (event) {
    event.preventDefault();

    var myForm = document.forms['addteacherForm'];
    var teacherName = myForm[0].value;
    var qualification = myForm[1].value;
    var experience = myForm[2].value;
    var department = myForm["department"].value;
    var userId = myForm["user-id"].value;

    var teacherNameError = document.getElementById("teacherName-error");
    var qualificationError = document.getElementById("qualification-error");
    var experienceError = document.getElementById("experience-error");
    var departmentError = document.getElementById("department-error");
    var userIdError = document.getElementById("userId-error");

    // Checking the teacherName
    if (teacherName == "") {
        teacherNameError.innerHTML = "fullname is empty!";
        return;
    }
    var words = teacherName.split(" ");
    if (words.length != 3) {
        teacherNameError.innerHTML = "fullname must contain 3 words!";
        return;
    }
    for (let i=0; i<words.length; i++) {
        if (!/^[A-Z]/.test(words[i])) {
            teacherNameError.innerHTML = "all 3 words must start with a capital letter!";
            return;
        }
    }
    teacherNameError.style.color = "blue";
    teacherNameError.innerHTML = "correct!";

    // Checking the qualification
    if (qualification == "") {
        qualificationError.innerHTML = "qualification is empty!";
        return;
    }
    qualificationError.style.color = "blue";
    qualificationError.innerHTML = "correct!";

    // Checking the experience
    if (experience == "") {
        experienceError.innerHTML = "experience is empty!";
        return;
    }
    if (isNaN(experience)) {
        experienceError.innerHTML = "experience must be a number!";
        return;
    }
    experienceError.style.color = "blue";
    experienceError.innerHTML = "correct!";

    // Checking the department
    departmentError.style.color = "blue";
    departmentError.innerHTML = "correct!"; 

    // Checking the userId
    if (userId == "") {
        console.log("hi");
        userIdError.innerHTML = "user id is empty!";
        return;
    }
    if (userId.length != 7) {
        userIdError.innerHTML = "user id must be 7 characters long!";
        return;
    }
    if (userId.indexOf(' ') != -1) {
        userIdError.innerHTML = "user id must not contain space!";
        return;
    }
    if (userId.substring(0,3) != "usr") {
        userIdError.innerHTML = "user id must start with \"usr\"";
        return;
    }
    userIdError.style.color = "blue";
    userIdError.innerHTML = "correct!";

    addteacherForm.submit();

    //displaySuccessMessage();
}

var addTeacherbtn = document.getElementById("addTeacherbtn");
addTeacherbtn.addEventListener("click", validateAddTeacherForm);

// function displaySuccessMessage () {
//     var successMessage = document.getElementById("successMessage");
//     function showMessage () {
//         successMessage.style.display = "block";
//         setTimeout(hideMessage, 10000);
//     }
//     function hideMessage () {
//         successMessage.style.display = "none";
//     }
//     showMessage();
// }   