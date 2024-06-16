
var addclassForm = document.getElementById("add-classes-form");

addclassForm.addEventListener("submit", validateAddClassForm);

function validateAddClassForm (event) {
    event.preventDefault();

    var myForm = document.forms['addclassForm'];
    var className = myForm[0].value;
    var teacherName = myForm[1].value;
    var startTime = myForm[2].value;
    var endTime = myForm[3].value;

    var classNameError = document.getElementById("className-error");
    var teacherNameError = document.getElementById("teacherName-error");
    var startTimeError = document.getElementById("startTime-error");
    var endTimeError = document.getElementById("endTime-error");

    // Checking the className
    if (className == "") {
        classNameError.innerHTML = "class name is empty!";
        return;
    }
    if (className.length != 7) {
        classNameError.innerHTML = "class name must be 7 characters long!";
        return;
    }
    if (className.substring(0,5) != "Class") {
        classNameError.innerHTML = "class name must start with \"Class\"!";
        return;
    }
    if (className.indexOf(' ') != -1) {
        classNameError.innerHTML = "class name must not contain space!";
        return;
    }
    /*if (isNaN(className.split(-3))) {
        classNameError.innerHTML = "the last 3 characters of class name must be numbers!";
        return;
    }*/
    classNameError.style.color = "blue";
    classNameError.innerHTML = "correct!";

    // Checking the teacherName
    if (teacherName == "") {
        teacherNameError.innerHTML = "teacher name is empty!";
        return;
    }
    var words  = teacherName.split(" ");
    if (words.length != 3) {
        teacherNameError.innerHTML = "teacher name must contain 3 words!";
        return;
    }
    for (let i=0; i<words.length; i++) {
        if (!/^[A-Z]/.test(words[i])) {
            teacherNameError.innerHTML = "all 3 words must start with capital letter!";
            return;
        }
    }
    teacherNameError.style.color = "blue";
    teacherNameError.innerHTML = "correct!";

    // Checking the startTime
    if (startTime == "") {
        startTimeError.innerHTML = "start time is empty!";
        return;
    }
    startTimeError.style.color = "blue";
    startTimeError.innerHTML = "correct!";

    // Checking the endTime
    if (endTime == "") {
        endTimeError.innerHTML = "end time is empty!";
        return;
    }
    /*if (endTime.get < startTime) {
        endTimeError.innerHTML = "end time must not be before start time!";
        return;
    }*/
    endTimeError.style.color = "blue";
    endTimeError.innerHTML = "correct!";

    addclassForm.submit();

    displaySuccessMessage();
}

var addClassbtn = document.getElementById("addClassbtn");
addClassbtn.addEventListener("click", validateAddClassForm);

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