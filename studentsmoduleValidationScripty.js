
//alert("Hello");

var addStudentForm = document.getElementById("add-students-form");

addStudentForm.addEventListener("submit", validateAddStudentForm);

function validateAddStudentForm(event) {
    event.preventDefault();

    var myForm = document.forms['addstudentForm'];
    var studentName = myForm[0].value;
    var addmissionNum = myForm[1].value;
    var DoB = myForm[2].value;
    var gender = myForm["gender"].value;
    var addresss = myForm["addresss"].value;
    var guardianName = myForm["guardianName"].value;
    var guardianPhone = myForm["guardianPhone"].value;
    //var studentId = myForm["student-id"].value;
    var userId = myForm["user-id"].value;

    var studentNameError = document.getElementById("studentName-error");
    var addmissionNumError = document.getElementById("addmissionNum-error");
    var DoBError = document.getElementById("DoB-error");
    var genderError = document.getElementById("gender-error");
    var addressError = document.getElementById("address-error");
    var guardianNameError = document.getElementById("guardianName-error");
    var guardianPhoneError = document.getElementById("guardianPhone-error");
    //var studentIdError = document.getElementById("studentId-error");
    var userIdError = document.getElementById("userId-error");

    // Checking the studentName
    if (studentName == "") {
        studentNameError.innerHTML = "fullname is empty!";
        return;
    }
    var words = studentName.split(" ");
    if (words.length != 3) {
        studentNameError.innerHTML = "fullname must contain 3 words!";
        return;
    }
    for (let i=0; i<words.length; i++) {
        if (!/^[A-Z]/.test(words[i])) {
            studentNameError.innerHTML = "all 3 words must start with a capital letter!";
            return;
        }
    }
    studentNameError.style.color = "blue";
    studentNameError.innerHTML = "correct!";


    // Checking the addmissionNum
    if (addmissionNum == "") {
        addmissionNumError.innerHTML = "addmission number is empty!";
        return;
    }
    if (addmissionNum.length != 10) {
        addmissionNumError.innerHTML = "addmission number must be 10 characters long!";
        return;
    }
    if (addmissionNum.substring(0,6) != 'AdmNum') {
        addmissionNumError.innerHTML = "addmission number must start with \"AdmNum\"!";
        return;
    }
    var last4Chars = addmissionNum.substring(6);
    if (!/^\d{4}$/.test(last4Chars)) {
        addmissionNumError.innerHTML = "the last 4 digits of the addmission numbers must be numbers!";
        return;
    }
    addmissionNumError.style.color = "blue";
    addmissionNumError.innerHTML = "correct!";


    // Checking the DoB
    var dobDate = new Date(DoB);
    var currentDate = new Date();
    var age = currentDate.getFullYear() - dobDate.getFullYear();
    if (currentDate.getMonth()<dobDate.getMonth() || (currentDate.getMonth()===dobDate.getMonth() && currentDate.getDate()<dobDate.getDate())) {
        age --;
    }

    if (DoB == ""){
        DoBError.innerHTML = "date is empty!";
        return;
    }
    if (dobDate.getTime() > currentDate.getTime()) {
        DoBError.innerHTML = "date passes the current date!";
        return;
    }
    if (age > 20) {
        DoBError.innerHTML = "age can not be greater than 20!";
        return;
    }
    if (age < 3) {
        DoBError.innerHTML = "age can not be less than 3!";
        return;
    }
    DoBError.style.color = "blue";
    DoBError.innerHTML = "correct!";


    // Checking the gender
    if (gender == "") {
        genderError.innerHTML = "gender is empty!";
        return;
    }
    genderError.style.color = "blue";
    genderError.innerHTML = "correct!";


    // Checking the address
    console.log("Address", addresss);
    if (addresss == "") {
        addressError.innerHTML = "address is empty!";
        console.log("hi");
        return;
    }
    addressError.style.color = "blue";
    addressError.innerHTML = "correct!";

    // Checking the guardianName
    if (guardianName == "") {
        guardianNameError.innerHTML = "guardian name is empty!";
        return;
    }
    var gwords = guardianName.split(" ");
    if (gwords.length != 2) {
        guardianNameError.innerHTML = "guardian name must contain 2 words!";
        return;
    }
    for (let k=0; k<gwords.length; k++) {
        if (!/^[A-Z]/.test(gwords[k])) {
            guardianNameError.innerHTML = "both 2 words must start with a capital letter!";
            return;
        }
    }
    guardianNameError.style.color = "blue";
    guardianNameError.innerHTML = "correct!";


    // Checking the guardianPhone
    if (guardianPhone == "") {
        guardianPhoneError.innerHTML = "guardian phone is empty!";
        return;
    }
    var regEx = /^(0)(9|7)\d{8}$/;
    if (!regEx.test(guardianPhone)) {
        guardianPhoneError.innerHTML = "the phone number format is incorrect!";
        return;
    }
    guardianPhoneError.style.color = "blue";
    guardianPhoneError.innerHTML = "correct!";

    // Checking the userId
    if (userId == ""){
        userIdError.innerHTML = "user id is empty!";
        return;
    }
    if (userId.length != 7){
        userIdError.innerHTML = "user id must be 7 characters long!";
        return;
    }
    if (userId.indexOf(' ') != -1) {
        userIdError.innerHTML = "user id must not contain space!";
        return;
    }
    if (userId.substring(0,3) != "usr") {
        userIdError.innerHTML = "user id must start with \"usr\"!";
        return;
    }
    userIdError.style.color="blue";
    userIdError.innerHTML="correct!";

    addStudentForm.submit();

    //displaySuccessMessage();
}

var addStudentbtn = document.getElementById("addStudentbtn");
addStudentbtn.addEventListener("click", validateAddStudentForm);

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