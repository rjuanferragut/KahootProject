function checkNewPassword(){
    var newPassword = document.getElementById('newPassword').value;
    var confirmNewPassword = document.getElementById('confirmNewPassword').value;
    var alertElement = document.getElementById('textAlert');
    var form = document.getElementById('formEditUser');

    if(newPassword != null && confirmNewPassword != null){

        if(newPassword != confirmNewPassword){
            console.log(newPassword+" ; "+confirmNewPassword);
            // var classNewPassword = newPassword.getAttribute("class")+" is-invalid";
            // newPassword.removeAttribute('class');
            // newPassword.setAttribute("class", classNewPassword);
            alertElement.innerHTML = "Passwords doesn't match";
            alertElement.style.display = "block";
        }else{
            // form.submit();
            alert("enviar Formulario");
        }
    }
    
}

function wrongEmail(){
    var alertElement = document.getElementById('textAlertWrong');
    alertElement.innerHTML = "Invalid Email address";
    alertElement.style.display = "block";
}

function emailSend(){
    var alertElement = document.getElementById('textAlertGood');
    alertElement.innerHTML = "Email send successfully";
    alertElement.style.display = "block";
}

