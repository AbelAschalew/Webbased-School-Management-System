
var addsubjectForm = document.getElementById("add-subjects-form");

addsubjectForm.addEventListener("submit", validateAddSubjectForm);

function validateAddSubjectForm (event) {
    event.preventDefault();

    var myForm = document.forms['addsubjectForm'];
    var subjectName = myForm[0].value;
    var teacherName = myForm[1].value;

    var subjectNameError = document.getElementById("subjectName-error");
    var teacherNameError = document.getElementById("teacherName-error");

    // Checking the subjectName
    if (subjectName == "") {
        subjectNameError.innerHTML = "subject name is empty!";
        return;
    }
    var words = subjectName.split(" ");
    for (let i=0; i<words.length; i++) {
        if (!/^[A-Z]/.test(words[i])) {
            subjectNameError.innerHTML = "each word must start with capital letter!";
            return;
        }
    }
    subjectNameError.style.color = "blue";
    subjectNameError.innerHTML = "correct!";

    // Checking the teacherName
    if (teacherName == "") {
        teacherNameError.innerHTML = "teacher name is empty!";
        return;
    }
    var words2 = teacherName.split(" ");
    if (words2.length != 3) {
        teacherNameError.innerHTML = "subject teacher name must contain 3 words!";
        return;
    }
    for (let k=0; k<words2.length; k++) {
        if (!/^[A-Z]/.test(words2[k])) {
            teacherNameError.innerHTML = "all 3 words must start with a capital letter!";
            return;
        }
    }
    teacherNameError.style.color = "blue";
    teacherNameError.innerHTML = "correct!";

    addsubjectForm.submit();

    //displaySuccessMessage();
}

var addSubjectbtn = document.getElementById("addSubjectbtn");
addSubjectbtn.addEventListener("click", validateAddSubjectForm);

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