
var sendmessageForm = document.getElementById("send-messages-form");

sendmessageForm.addEventListener("submit", validateSendMessageForm);

function validateSendMessageForm (event) {
    event.preventDefault();

    var myForm = document.forms['sendmessageForm'];
    var recipient = myForm[0].value;
    var subject = myForm[1].value;
    var messageBody = myForm[2].value;
}