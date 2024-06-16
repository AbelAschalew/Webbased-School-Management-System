
var loginForm = document.getElementById("login-form");

loginForm.addEventListener("submit", validateLoginForm);
    function validateLoginForm(event){
        event.preventDefault();

        var myForm = document.forms["loginpageForm"];
        var username = myForm[0].value;
        var password = myForm[1].value;

        var usernameError = document.getElementById("username-error");
        var passwordError = document.getElementById("password-error");

        // Checking the username
        if (username == ""){
            usernameError.innerHTML = "username is empty!";
            return;
        }
        if (username.length<7) {
            usernameError.innerHTML = "username is too short!";
            return;
        } 
        if (username.length > 20) {
            usernameError.innerHTML = "username is too long!";
            return;
        }
        if (username.indexOf(' ') !== -1){
            usernameError.innerHTML = "username must not contain space!";
            return;
        }
        if (username.substring(0,3) != "usr") {
            usernameError.innerHTML = "username must start with \"usr\"";
            return;
        }
        if (username != username.toLowerCase()) {
            usernameError.innerHTML = "username must not contain uppercase letters!";
            return;
        }
        usernameError.style.color = "blue";
        usernameError.innerHTML = "correct!";

        // Checking the password
        var lettersArr = new RegExp ("[a-zA-Z]");
        var numbersArr = new RegExp("[0-9]");
        var specialcharArr = new RegExp("[!@#$%^&*]");

        if (password == "") {
            passwordError.innerHTML = "password is empty!";
            return;
        }
        if (password.length < 10) {
            passwordError.innerHTML = "password is too short!";
            return;
        }
        if (password.length > 15) {
            passwordError.innerHTML = "password is too long!";
            return;
        }
        if (!lettersArr.test(password)){
            passwordError.innerHTML = "password must contain letters!";
            //console.log("hi");
            return;
        }
        if (!numbersArr.test(password)) {
            passwordError.innerHTML = "password must contain numbers!";
            //console.log("hi");
            return;
        }
        if (!specialcharArr.test(password)) {
            passwordError.innerHTML = "password must contain special characters!";
            return;
        }
        passwordError.style.color = "blue";
        passwordError.innerHTML = "correct!";

        loginForm.submit();
        //window.location.href = "dashboard.html";
};

var loginbtn = document.getElementById("loginbtn");
loginbtn.addEventListener("click", validateLoginForm);
