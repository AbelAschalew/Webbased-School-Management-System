
var addUserForm = document.getElementById("add-users-form");

addUserForm.addEventListener("submit", validateAddUserForm);

function validateAddUserForm (event) {
    event.preventDefault();

    var myForm = document.forms['adduserForm'];

    var fullname = myForm[0].value;
    var username = myForm[1].value;
    var password = myForm[2].value;
    var email = myForm[3].value;
    var phonenum = myForm[4].value;
    var roleId = myForm[5].value;

    var fullnameError = document.getElementById("userName-error");
    var usernameError = document.getElementById("username-error");
    var passwordError = document.getElementById("password-error");
    var emailError = document.getElementById("email-error");
    var phonenumError = document.getElementById("phoneNum-error");
    var roleIdError = document.getElementById("roleId-error");

    // Checking the fullname
    if (fullname == "") {
        fullnameError.innerHTML = "full name is empty!";
        return;
    }
    var names  = fullname.split(" ");
    if (names.length != 3) {
        fullnameError.innerHTML = "full name must contain 3 words!";
        return;
    }
    for (var i=0; i<names.length; i++) {
        if (!/^[A-Z]/.test(names[i])){
            fullnameError.innerHTML = "all 3 words must start with a capital letter!";
            return;
        }
    }
    fullnameError.style.color = "blue";
    fullnameError.innerHTML = "correct!";

    // Checking the username
    if (username == "") {
        usernameError.innerHTML = "username is empty!";
        return;
    }
    if (username.substring(0,3) != "usr") {
        usernameError.innerHTML = "username must start with \"usr\"!";
        return;
    }
    if (username.length > 20) {
        usernameError.innerHTML = "username is too long!";
        return;
    }
    if (username != username.toLowerCase()) {
        usernameError.innerHTML = "username must not contain uppercase letters!";
        return;
    }
    usernameError.style.color = "blue";
    usernameError.innerHTML = "correct!";

    // Checking the password
    if (password == "") {
        passwordError.innerHTML = "password is empty!";
        return;
    }
    if (password.length <10) {
        passwordError.innerHTML = "password is too short!";
        return;
    }
    if (password.length > 15) {
        passwordError.innerHTML = "password is too long!";
        return;
    }
    var lettersArr = new RegExp("[a-zA-Z]");
    var numbersArr = new RegExp("[0-9]");
    var specialcharArr = new RegExp("[!@#$%^&*]");
    if (!lettersArr.test(password)) {
        passwordError.innerHTML = "password must contain letters!";
        return;
    }
    if (!numbersArr.test(password)) {
        passwordError.innerHTML = "password must contain numbers!";
        return;
    }
    if (!specialcharArr.test(password)) {
        passwordError.innerHTML = "password must contain special characters!";
        return;
    }
    passwordError.style.color = "blue";
    passwordError.innerHTML = "correct!";

    // Checking the email
    if (email == "") {
        emailError.innerHTML = "email is empty!";
        return;
    }
    if (!email.endsWith("@gmail.com")) {
        emailError.innerHTML = "email must end with \"@gmail.com\"!";
        return;
    }
    emailError.style.color = "blue";
    emailError.innerHTML = "correct!";

    // Checking the phonenum
    if(phonenum == ""){
        phonenumError.innerHTML="phone number is empty!";
        return;
    }
    if(phonenum.length!=10){
        phonenumError.innerHTML="phone number must be 10 digits long!";
        return;
    }
    phonenumError.style.color="blue";
    phonenumError.innerHTML="correct!";

    // Checking the roleId
    if(roleId == ""){
        roleIdError.innerHTML="roleid is empty!";
        return;
    }
    if(roleId.length!=7){
        roleIdError.innerHTML="roleid must be 7 characters long!";
        return;
    }
    roleIdError.style.color="blue";
    roleIdError.innerHTML="correct!";

    addUserForm.submit();

    //alert("hello3");
}

var addUserbtn = document.getElementById("adduserbtn");
addUserbtn.addEventListener("click", validateAddUserForm);